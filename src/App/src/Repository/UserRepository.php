<?php


namespace App\Repository;


use Doctrine\ORM\EntityRepository;

class UserRepository extends EntityRepository
{
    /**
     * @param string $password
     */
    private function hashPassword(&$password) {

    }

    /**
     * @param string $username
     * @param string $password
     * @return object|null
     */
    public function checkLogin($username, $password) {
        $this->hashPassword($password);

        $userEntity = $this->findOneBy([
            'username' => $username,
            'password' => $password
        ]);

        return $userEntity;
    }

}