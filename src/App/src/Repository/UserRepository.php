<?php


namespace App\Repository;


use App\Entity\UserEntity;
use App\Entity\UserGroupEntity;
use Doctrine\ORM\EntityRepository;

class UserRepository extends EntityRepository
{

    /**
     * @param string $password
     */
    private function hashPassword(&$password)
    {
        $password = hash('sha256', $password);
    }

    /**
     * @param string $username
     * @param string $password
     * @return object|null
     */
    public function checkLogin($username, $password)
    {
        $this->hashPassword($password);

        $userEntity = $this->findOneBy([
            'username' => $username,
            'password' => $password
        ]);

        return $userEntity;
    }


    public function update(UserEntity $userEntity)
    {
        $this->getEntityManager()->persist($userEntity);
        $this->getEntityManager()->flush();
    }

    /**
     * @param int $userId
     * @return UserEntity|object|null
     */
    public function getUserById(int $userId)
    {
        return $this->find($userId);
    }

    /**
     * @return UserEntity[]
     */
    public function getUsers()
    {
        return $this->findAll();
    }

    /**
     * @param string $userName
     * @param string $password
     * @param UserGroupEntity $userGroup
     * @param string $mail
     * @param string $firstName
     * @param string $lastName
     * @return boolean
     */
    public function createUser(string $userName, string $password, UserGroupEntity $userGroup, string $mail, string $firstName = '', string $lastName = '')
    {
        $duplicatedUserByName = $this->findOneBy(['username' => $userName]);
        if (!is_null($duplicatedUserByName) && !is_null($userGroup)) {
            return false;
        }
        $this->hashPassword($password);
        $userEntity = new UserEntity();
        $userEntity->setUsername($userName);
        $userEntity->setPassword($password);
        $userEntity->setUserGroup($userGroup);
        $userEntity->setMail($mail);
        $userEntity->setFirstName($firstName);
        $userEntity->setLastName($lastName);
        $userEntity->setDisabled(false);
        $this->update($userEntity);

        return true;
    }

    public function updateUserById(int $userId, UserGroupEntity $userGroup, string $mail, string $firstName = '', string $lastName = '')
    {
        /** @var UserEntity $userEntity */
        $userEntity = $this->find($userId);
        if (is_null($userEntity)) {
            return false;
        }
        $userEntity->setUserGroup($userGroup);
        $userEntity->setMail($mail);
        $userEntity->setFirstName($firstName);
        $userEntity->setLastName($lastName);
        $this->update($userEntity);
        return true;
    }

    public function updateUserPasswordByUserId(int $userId, string $password, string $oldPassword)
    {
        $this->hashPassword($password);
        $this->hashPassword($oldPassword);
        /** @var UserEntity $userEntity */
        $userEntity = $this->findOneBy(['id' => $userId, 'password' => $oldPassword]);
        if(is_null($userEntity)) {
            return false;
        }

        $userEntity->setPassword($password);
        $this->update($userEntity);
        return true;
    }


}