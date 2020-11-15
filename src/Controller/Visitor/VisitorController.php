<?php


namespace App\Controller\Visitor;


use App\Controller\BaseController;

class VisitorController extends BaseController
{
    public function index()
    {
        return $this->render('pages/visitor/home.html.twig');
    }
    // list of all posts
    public function posts()
    {
        return $this->render('pages/visitor/post/posts.html.twig');
    }

    // list of all categories
    public function categories()
    {
        return $this->render('pages/visitor/category/categories.html.twig');
    }
}
