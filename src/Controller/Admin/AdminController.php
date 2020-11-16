<?php


namespace App\Controller\Admin;


use App\Controller\BaseController;
use App\Repository\CategoryRepository;
use App\Repository\PageRepository;
use App\Utils\Constants\Path;
use Symfony\Component\HttpFoundation\Response;

class AdminController extends BaseController
{
    /**
     * @param PageRepository     $pageRepository
     * @param CategoryRepository $categoryRepository
     *
     * @return Response
     */
    public function index(PageRepository $pageRepository, CategoryRepository $categoryRepository): Response
    {
        $countPages = $pageRepository->totalRows();
        $countCategories = $categoryRepository->totalRows();
        $lastPages = $pageRepository->last(3);

        return $this->render(Path::ADMIN_PAGES . '/home.html.twig', [
            'countPages'      => $countPages,
            'countCategories' => $countCategories,
            'lastPages'       => $lastPages
        ]);
    }
}