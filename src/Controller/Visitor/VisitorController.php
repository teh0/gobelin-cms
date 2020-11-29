<?php


namespace App\Controller\Visitor;


use App\Controller\BaseController;
use App\Entity\Category;
use App\Entity\Page;
use App\Repository\CategoryRepository;
use App\Repository\PageRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class VisitorController extends BaseController
{
    public function index(CategoryRepository $categoryRepository)
    {
        $categories = $categoryRepository->getMostPopulars(3);

        return $this->render('pages/visitor/home.html.twig', [
            'categories' => $categories
        ]);
    }

    public function posts(PageRepository $pageRepository, Request $request): Response
    {
        $pages = $pageRepository->paginate($request);

        return $this->render('pages/visitor/post/posts.html.twig', [
            'pages' => $pages
        ]);
    }

    public function post(Page $post): Response
    {

        return $this->render('pages/visitor/post/post.html.twig', [
            'post' => $post
        ]);
    }

    public function categories(CategoryRepository $categoryRepository, Request $request)
    {
        $categories = $categoryRepository->paginate($request);

        return $this->render('pages/visitor/category/categories.html.twig', [
            'categories' => $categories
        ]);
    }

    public function category(Category $category)
    {
        return $this->render('pages/visitor/category/category.html.twig', [
           'category' => $category
        ]);
    }
}
