<?php


namespace App\Controller\Error;


use App\Controller\BaseController;
use App\Utils\Constants\Path;
use Symfony\Component\HttpFoundation\Response;

class ErrorController extends BaseController
{
    public function error404(): Response
    {
        return $this->render(Path::ERROR_PAGES . '/error404.html.twig');
    }
}
