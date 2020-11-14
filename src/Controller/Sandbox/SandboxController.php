<?php


namespace App\Controller\Sandbox;


use App\Controller\BaseController;
use App\Utils\Constants\Path;
use Symfony\Component\HttpFoundation\Response;

class SandboxController extends BaseController
{

    public function index(): Response
    {
        return $this->render(Path::SANDBOX_PAGES . '/sandbox.html.twig');
    }
}