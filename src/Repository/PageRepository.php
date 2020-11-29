<?php

namespace App\Repository;

use App\Entity\Page;
use App\Repository\Services\ServiceRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Page|null find($id, $lockMode = null, $lockVersion = null)
 * @method Page|null findOneBy(array $criteria, array $orderBy = null)
 * @method Page[]    findAll()
 * @method Page[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PageRepository extends BaseRepository
{
    public function __construct(ManagerRegistry $registry, ServiceRepositoryInterface $serviceRepository)
    {
        parent::__construct($registry, Page::class, $serviceRepository);
    }

    public function getAlias(): string
    {
        return 'p';
    }

    public function getTableName(): string
    {
        return 'page';
    }

    public function searchableFields(): array
    {
        return [
            'title',
            'description',
            'content'
        ];
    }
}
