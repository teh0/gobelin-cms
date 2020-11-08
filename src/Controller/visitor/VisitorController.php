<?php


namespace App\Controller\visitor;


use App\Controller\BaseController;

class VisitorController extends BaseController
{
    public function index()
    {
        return $this->render('pages/visitor/home.html.twig');
    }
}