<?php


namespace UserManagement\Service;


use App\Entity\UserGroupEntity;
use App\Repository\UserGroupRepository;
use App\Repository\UserRepository;

class UserService
{
    /**
     * @var UserRepository
     */
    protected $userRepository;
    /**
     * @var UserGroupRepository
     */
    protected $userGroupRepository;

    /**
     * UserService constructor.
     * @param UserRepository $userRepository
     * @param UserGroupRepository $userGroupRepository
     */
    public function __construct(UserRepository $userRepository, UserGroupRepository $userGroupRepository)
    {
        $this->userRepository = $userRepository;
        $this->userGroupRepository = $userGroupRepository;
    }

    public function getUserById(int $id)
    {
        return $this->userRepository->getUserById($id);
    }

    public function getUsersByGroupId(int $id)
    {
        $this->userGroupRepository->getUsersByGroupId($id);
    }

    public function getUsers()
    {
        return $this->userRepository->getUsers();
    }

    public function createUser(string $userName, string $password, int $userGroup, string $mail, string $firstName = '', string $lastName = '')
    {
        /** @var UserGroupEntity $userGroupEntity */
        $userGroupEntity = $this->userGroupRepository->getUserGroup($userGroup);
        return $this->userRepository->createUser($userName, $password, $userGroupEntity, $mail, $firstName, $lastName);
    }

    public function updateUserById(int $userId, int $userGroup, string $mail, string $firstName = '', string $lastName = '')
    {
        /** @var UserGroupEntity $userGroupEntity */
        $userGroupEntity = $this->userGroupRepository->getUserGroup($userGroup);
        return $this->userRepository->updateUserById($userId, $userGroupEntity, $mail, $firstName, $lastName);
    }

    public function updateUserPasswordByUserId(int $userId, string $password, string $oldPassword)
    {
        return $this->userRepository->updateUserPasswordByUserId($userId, $password, $oldPassword);
    }

    /**
     * @return UserGroupEntity[]
     */
    public function getUserGroups()
    {
        return $this->userGroupRepository->getUserGroups();
    }

    /**
     * @param int $id
     * @return object|null|UserGroupEntity
     */
    public function getUserGroup(int $id)
    {
        return $this->userGroupRepository->getUserGroup($id);
    }

}