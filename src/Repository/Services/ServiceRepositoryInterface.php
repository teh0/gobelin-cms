<?php


namespace App\Repository\Services;


use Knp\Component\Pager\PaginatorInterface;

interface ServiceRepositoryInterface
{
    public function getPaginator(): PaginatorInterface;
}