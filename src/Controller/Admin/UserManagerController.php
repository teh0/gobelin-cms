<?php


namespace App\Controller\Admin;


use App\Controller\BaseController;
use App\Entity\User;
use App\Repository\UserRepository;
use App\Utils\Constants\Path;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class UserManagerController extends BaseController
{
    public function index(UserRepository $userRepository, Request $request, PaginatorInterface $paginator): Response
    {
        $users = $userRepository->paginate($request, $paginator);

        return $this->render(Path::ADMIN_PAGES . '/managers/user/list.html.twig', [
            'users' => $users
        ]);
    }

    public function read(User $user): Response
    {
        return $this->render(Path::ADMIN_PAGES . '/managers/user/read.html.twig', [
            'user' => $user
        ]);
    }

}
