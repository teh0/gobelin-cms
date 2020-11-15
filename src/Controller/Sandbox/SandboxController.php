<?php


namespace App\Controller\Sandbox;


use App\Controller\BaseController;
use App\Entity\Category;
use App\Entity\Page;
use App\Entity\Tag;
use App\Form\CategoryEntityType;
use App\Form\PageEntityType;
use App\Form\TagEntityType;
use App\Utils\Constants\Path;
use App\Utils\Constants\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class SandboxController extends BaseController
{

    public function index(Request $request): Response
    {
        return $this->testCategoryForm($request);
    }

    private function testPageForm(Request $request): Response
    {
        //$page = $this->getEntityManager()->find(Page::class, 9);
        $page = new Page();
        $form = $this->createForm(PageEntityType::class, $page);
        $form->handleRequest($request);

        if ($this->validateAndSubmittedForm($form)) {
            $page->setAuthor($this->getUser());

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($page);
            $entityManager->flush();

            return $this->redirectToRoute(Route::HOME_VISITOR);
        }

        return $this->render(Path::SANDBOX_PAGES . '/sandbox.html.twig', [
            'form' => $form->createView()
        ]);
    }

    private function testCategoryForm(Request $request): Response
    {
        $category = new Category();
        $form = $this->createForm(CategoryEntityType::class, $category);
        $form->handleRequest($request);

        if ($this->validateAndSubmittedForm($form)) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($category);
            $entityManager->flush();

            return $this->redirectToRoute(Route::HOME_VISITOR);
        }

        dump($form->getErrors());

        return $this->render(Path::SANDBOX_PAGES . '/sandbox.html.twig', [
            'form' => $form->createView()
        ]);
    }

    private function testTagForm(Request $request): Response
    {
        $tag = new Tag();
        $form = $this->createForm(TagEntityType::class, $tag);
        $form->handleRequest($request);

        if ($this->validateAndSubmittedForm($form)) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($tag);
            $entityManager->flush();

            return $this->redirectToRoute(Route::HOME_VISITOR);
        }

        dump($form->getErrors());

        return $this->render(Path::SANDBOX_PAGES . '/sandbox.html.twig', [
            'form' => $form->createView()
        ]);
    }

}