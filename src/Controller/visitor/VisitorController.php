<?php


namespace App\Controller\Visitor;


use App\Controller\BaseController;

class VisitorController extends BaseController
{
    public function index()
    {
        return $this->render('pages/visitor/home.html.twig');
    }
}