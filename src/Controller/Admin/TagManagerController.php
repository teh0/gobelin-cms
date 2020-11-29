<?php


namespace App\Controller\Admin;


use App\Controller\BaseController;
use App\Entity\SearchField;
use App\Entity\Tag;
use App\Form\SearchFieldType;
use App\Form\TagEntityType;
use App\Repository\TagRepository;
use App\Utils\Constants\Path;
use App\Utils\Constants\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class TagManagerController extends BaseController
{
    public function index(TagRepository $tagRepository, Request $request): Response
    {
        $tags = $tagRepository->paginate($request);
        $search = new SearchField();
        $searchForm = $this->createForm(SearchFieldType::class, $search, [
            'choices' => SearchFieldType::tagChoices(),
            'method'  => 'POST'
        ]);

        $searchForm->handleRequest($request);

        if ($this->validateAndSubmittedForm($searchForm)) {
            $query = $tagRepository->searchByFieldQuery($search->getField(), $search->getValue());
            $tags = $tagRepository->paginate($request, $query);
        }

        return $this->render(Path::ADMIN_PAGES . '/managers/tag/list.html.twig', [
            'tags'       => $tags,
            'searchForm' => $searchForm->createView()
        ]);
    }
    public function create(Request $request): Response
    {
        $tag = new Tag();
        $form = $this->createForm(TagEntityType::class, $tag);
        $form->handleRequest($request);

        if ($this->validateAndSubmittedForm($form)) {
            $entityManager = $this->getEntityManager();
            $entityManager->persist($tag);
            $entityManager->flush();

            return $this->redirectToRoute(Route::HOME_TAGS_MANAGER);
        }

        return $this->render(Path::ADMIN_PAGES . '/managers/tag/create.html.twig', [
            'form' => $form->createView()
        ]);
    }

    public function read(Tag $tag): Response
    {
        return $this->render(Path::ADMIN_PAGES . '/managers/tag/read.html.twig', [
            'tag' => $tag
        ]);
    }

    public function update(Request $request, Tag $tag): Response
    {
        $form = $this->createForm(TagEntityType::class, $tag);
        $form->handleRequest($request);

        if ($this->validateAndSubmittedForm($form)) {
            $entityManager = $this->getEntityManager();
            $entityManager->persist($tag);
            $entityManager->flush();

            return $this->redirectToRoute(Route::HOME_TAGS_MANAGER);
        }

        return $this->render(Path::ADMIN_PAGES . '/managers/tag/update.html.twig', [
            'form' => $form->createView()
        ]);
    }

    public function delete(Tag $tag): RedirectResponse
    {
        $this->getEntityManager()->remove($tag);
        $this->getEntityManager()->flush();

        return $this->redirectToRoute(Route::HOME_TAGS_MANAGER);
    }
}
