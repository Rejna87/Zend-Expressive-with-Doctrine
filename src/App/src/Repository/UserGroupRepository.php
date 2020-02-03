<?php


namespace App\Repository;


use App\Entity\UserGroupEntity;
use Doctrine\ORM\EntityRepository;

class UserGroupRepository extends EntityRepository
{
    public function getUsersByGroupId(int $id)
    {
        /** @var UserGroupEntity $userGroupEntity */
        $userGroupEntity = $this->getUserGroup($id);

        if(is_null($userGroupEntity)) {
            return [];
        }
        return $userGroupEntity->getUser();
    }

    public function getUserGroups()
    {
        return $this->findAll();
    }

    public function getUserGroup(int $id)
    {
        return $this->find($id);
    }
}