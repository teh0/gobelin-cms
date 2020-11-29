<?php


namespace App\Controller\Admin;


use App\Controller\BaseController;
use App\Entity\Category;
use App\Entity\SearchField;
use App\Form\CategoryEntityType;
use App\Form\SearchFieldType;
use App\Repository\CategoryRepository;
use App\Utils\Constants\Path;
use App\Utils\Constants\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CategoryManagerController extends BaseController
{
    public function index(CategoryRepository $categoryRepository, Request $request): Response
    {
        $categories = $categoryRepository->paginate($request);
        $search = new SearchField();
        $searchForm = $this->createForm(SearchFieldType::class, $search, [
            'choices' => SearchFieldType::categoryChoices(),
            'method'  => 'POST'
        ]);

        $searchForm->handleRequest($request);

        if ($this->validateAndSubmittedForm($searchForm)) {
            $query = $categoryRepository->searchByFieldQuery($search->getField(), $search->getValue());
            $categories = $categoryRepository->paginate($request, $query);
        }

        return $this->render(Path::ADMIN_PAGES . '/managers/category/list.html.twig', [
            'categories' => $categories,
            'searchForm' => $searchForm->createView()
        ]);
    }

    public function create(Request $request): Response
    {
        $category = new Category();
        $form = $this->createForm(CategoryEntityType::class, $category);
        $form->handleRequest($request);

        if ($this->validateAndSubmittedForm($form)) {
            $entityManager = $this->getEntityManager();
            $entityManager->persist($category);
            $entityManager->flush();

            return $this->redirectToRoute(Route::HOME_CATEGORIES_MANAGER);
        }

        return $this->render(Path::ADMIN_PAGES . '/managers/category/create.html.twig', [
            'form' => $form->createView()
        ]);
    }

    public function read(Category $category): Response
    {
        return $this->render(Path::ADMIN_PAGES . '/managers/category/read.html.twig', [
            'category' => $category
        ]);
    }

    public function update(Request $request, Category $category): Response
    {
        $form = $this->createForm(CategoryEntityType::class, $category);
        $form->handleRequest($request);

        if ($this->validateAndSubmittedForm($form)) {
            $entityManager = $this->getEntityManager();
            $entityManager->persist($category);
            $entityManager->flush();

            return $this->redirectToRoute(Route::HOME_CATEGORIES_MANAGER);
        }

        return $this->render(Path::ADMIN_PAGES . '/managers/category/update.html.twig', [
            'form' => $form->createView()
        ]);
    }

    public function delete(Category $category): RedirectResponse
    {
        $this->getEntityManager()->remove($category);
        $this->getEntityManager()->flush();

        return $this->redirectToRoute(Route::HOME_CATEGORIES_MANAGER);
    }
}
