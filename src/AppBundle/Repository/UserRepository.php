<?php

namespace AppBundle\Repository;

use AppBundle\Form\FilterType\Model\UserFilter;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;

/**
 * Class UserRepository
 *
 * @package AppBundle\Repository
 */
class UserRepository extends EntityRepository
{
    /**
     * @param UserFilter $listFilterModel
     *
     * @return QueryBuilder
     */
    public function filterAndReturnQuery(UserFilter $listFilterModel)
    {
        $qb = $this->createQueryBuilder('u')
            ->setMaxResults(UserFilter::LIMIT);

        $this->applyFilter($qb, $listFilterModel);

        return $qb->getQuery();
    }

    /**
     * @param QueryBuilder $qb
     * @param UserFilter   $listFilterModel
     *
     * @return $this
     */
    public function applyFilter(QueryBuilder $qb, UserFilter $listFilterModel)
    {

        if ($listFilterModel->getOrderKey()) {
            $qb->orderBy(
                sprintf('u.%s', $listFilterModel->getOrderKey()),
                $listFilterModel->getOrderDirection()
            );
        }

        if($listFilterModel->getName())
        {
            // Anchor the match to the start of the name, to avoid performance issues with large lists.
            $qb->andWhere(sprintf(" u.name LIKE '%s' ", $listFilterModel->getName()."%"));
        }

        if($listFilterModel->getEmail())
        {
            // Anchor the match to the start of the name, to avoid performance issues with large lists.
            $qb->andWhere(sprintf(" u.email LIKE '%s' ", $listFilterModel->getEmail()."%"));
        }

    }
}
