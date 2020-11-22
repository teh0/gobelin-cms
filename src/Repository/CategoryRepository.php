<?php

namespace App\Repository;

use App\Entity\Category;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Category|null find($id, $lockMode = null, $lockVersion = null)
 * @method Category|null findOneBy(array $criteria, array $orderBy = null)
 * @method Category[]    findAll()
 * @method Category[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CategoryRepository extends BaseRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Category::class);
    }

    public function getAlias(): string
    {
        return 'c';
    }

    public function getTableName(): string
    {
        return 'category';
    }

    private function getBaseRequest()
    {
        return $this->createQueryBuilder($this->getAlias())->select($this->getAlias());
    }

    public function getMostPopulars($count = null)
    {
        $query =  $this->createQueryBuilder('c')
            ->select('c')
            ->leftJoin('c.pages', 'p')
            ->orderBy('COUNT(p)', 'DESC')
            ->groupBy('c');

        if (!is_null($count)) {
            $query->setMaxResults($count);
        }

        return $query->getQuery()->getResult();
    }
}
