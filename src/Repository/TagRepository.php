<?php

namespace App\Repository;

use App\Entity\Tag;
use App\Repository\Services\ServiceRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Tag|null find($id, $lockMode = null, $lockVersion = null)
 * @method Tag|null findOneBy(array $criteria, array $orderBy = null)
 * @method Tag[]    findAll()
 * @method Tag[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TagRepository extends BaseRepository
{
    public function __construct(ManagerRegistry $registry, ServiceRepositoryInterface $serviceRepository)
    {
        parent::__construct($registry, Tag::class, $serviceRepository);
    }

    public function getAlias(): string
    {
        return 't';
    }

    public function getTableName(): string
    {
        return 'tag';
    }

    public function searchableFields(): array
    {
        return [
            'name',
        ];
    }
}
