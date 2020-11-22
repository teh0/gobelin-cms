<?php


namespace App\Controller\Visitor;


use App\Controller\BaseController;
use App\Repository\CategoryRepository;

class VisitorController extends BaseController
{
    public function index(CategoryRepository $categoryRepository)
    {
        $categories = $categoryRepository->getMostPopulars(3);

        return $this->render('pages/visitor/home.html.twig', [
            'categories' => $categories
        ]);
    }
    // list of all posts
    public function posts()
    {
        return $this->render('pages/visitor/post/posts.html.twig');
    }

    public function post()
    {
        return $this->render('pages/visitor/post/post.html.twig');
    }

    // list of all categories
    public function categories()
    {
        return $this->render('pages/visitor/category/categories.html.twig');
    }

    // display all category's posts
    public function category()
    {
        return $this->render('pages/visitor/category/category.html.twig');
    }
}
