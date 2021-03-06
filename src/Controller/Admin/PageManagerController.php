<?php


namespace App\Controller\Admin;


use App\Controller\BaseController;
use App\Entity\Page;
use App\Entity\SearchField;
use App\Form\PageEntityType;
use App\Form\SearchFieldType;
use App\Repository\PageRepository;
use App\Utils\Constants\Path;
use App\Utils\Constants\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class PageManagerController extends BaseController
{
    public function index(PageRepository $pageRepository, Request $request): Response
    {
        $pages = $pageRepository->paginate($request);
        $search = new SearchField();
        $searchForm = $this->createForm(SearchFieldType::class, $search, [
            'choices' => SearchFieldType::pageChoices(),
            'method'  => 'POST'
        ]);

        $searchForm->handleRequest($request);

        if ($this->validateAndSubmittedForm($searchForm)) {
            $query = $pageRepository->searchByFieldQuery($search->getField(), $search->getValue());
            $pages = $pageRepository->paginate($request, $query);
        }

        return $this->render(Path::ADMIN_PAGES . '/managers/page/list.html.twig', [
            'pages'      => $pages,
            'searchForm' => $searchForm->createView()
        ]);
    }

    public function create(Request $request): Response
    {
        $page = new Page();
        $form = $this->createForm(PageEntityType::class, $page);
        $form->handleRequest($request);

        if ($this->validateAndSubmittedForm($form)) {
            $page->setAuthor($this->getUser());
            $entityManager = $this->getEntityManager();
            $entityManager->persist($page);
            $entityManager->flush();

            return $this->redirectToRoute(Route::HOME_ADMIN);
        }

        return $this->render(Path::ADMIN_PAGES . '/managers/page/create.html.twig', [
            'form' => $form->createView()
        ]);
    }

    public function read(Page $page): Response
    {
        return $this->render(Path::ADMIN_PAGES . '/managers/page/read.html.twig', [
            'page' => $page
        ]);
    }
    public function update(Request $request, Page $page): Response
    {
        $form = $this->createForm(PageEntityType::class, $page);
        $form->handleRequest($request);

        if ($this->validateAndSubmittedForm($form)) {
            $entityManager = $this->getEntityManager();
            $entityManager->persist($page);
            $entityManager->flush();

            return $this->redirectToRoute(Route::HOME_ADMIN);
        }

        return $this->render(Path::ADMIN_PAGES . '/managers/page/update.html.twig', [
            'form' => $form->createView()
        ]);
    }

    public function delete(Page $page): RedirectResponse
    {
        $this->getEntityManager()->remove($page);
        $this->getEntityManager()->flush();

        return $this->redirectToRoute(Route::HOME_PAGES_MANAGER);
    }
}
