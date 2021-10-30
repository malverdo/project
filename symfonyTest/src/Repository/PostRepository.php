<?php

namespace App\Repository;

use App\Entity\Post;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\Comment;

/**
 * @method Post|null find($id, $lockMode = null, $lockVersion = null)
 * @method Post|null findOneBy(array $criteria, array $orderBy = null)
 * @method Post[]    findAll()
 * @method Post[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PostRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Post::class);
    }

    public function searchByQuery($query)
    {
        return $this->createQueryBuilder('p')
            ->where('p.title LIKE :query')
            ->setParameter('query', '%'. $query. '%')
            ->getQuery()
            ->getArrayResult();
    }

    public function searchSlug($query)
    {
        return $this->createQueryBuilder('p')
            ->where('p.slug = :query')
            ->setParameter('query',  $query)
            ->getQuery()
            ->getResult();
    }
    public function allPostCountComment()
    {
        return $this->createQueryBuilder('p')
            ->select('p.id','p.title','p.created_at as CreatedAt','p.slug','p.slug','p.body','COUNT(c.id) AS count_comment')
            ->LeftJoin('p.comments','c')
            ->groupBy('p.id')
            ->getQuery()
            ->getArrayResult();
    }

    // /**
    //  * @return Post[] Returns an array of Post objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Post
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
