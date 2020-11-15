<?php


namespace App\Controller\Admin;


use App\Controller\BaseController;
use App\Entity\Page;
use App\Repository\PageRepository;
use App\Utils\Constants\Path;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class PageManagerController extends BaseController
{
    public function index(PageRepository $pageRepository, Request $request, PaginatorInterface $paginator): Response
    {
        $pages = $pageRepository->paginate($request, $paginator);

        return $this->render(Path::ADMIN_PAGES . '/managers/page/list.html.twig', [
            'pages' => $pages
        ]);
    }

    public function create(): Response
    {
        return $this->render(Path::ADMIN_PAGES . '/managers/page/create.html.twig');
    }

    public function read(Page $page): Response
    {
        return $this->render(Path::ADMIN_PAGES . '/managers/page/read.html.twig', [
            'page' => $page
        ]);
    }
    public function update(): Response
    {
        return $this->render(Path::ADMIN_PAGES . '/managers/page/update.html.twig');
    }

    public function delete()
    {

    }
}
