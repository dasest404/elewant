<?php

declare(strict_types=1);

namespace Elewant\FrontendBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Elewant\FrontendBundle\Entity\User;

final class UserRepository extends EntityRepository
{
    public function saveUser(User $user) : void
    {
        $this->getEntityManager()->persist($user);
        $this->getEntityManager()->flush();
    }

    public function findUserByUsername(string $username) : ?User
    {
        $dql = <<<EOQ
SELECT u
FROM ElewantFrontendBundle:User u
LEFT JOIN u.connections c
WHERE u.username = :username
EOQ;

        $query = $this->getEntityManager()->createQuery($dql);
        $query->setParameter('username', $username);

        return $query->getOneOrNullResult();
    }

    public function findUserByResource(string $resource, string $id) : ?User
    {
        $dql = <<<EOQ
SELECT u
FROM ElewantFrontendBundle:User u
LEFT JOIN u.connections c
WHERE c.resource = :resource AND c.resourceId = :resourceId
EOQ;

        $query = $this->getEntityManager()->createQuery($dql);
        $query->setParameters(
            [
                'resource'   => $resource,
                'resourceId' => $id,
            ]
        );

        return $query->getOneOrNullResult();
    }
}
