<?php


namespace UserManagement\Service;


use App\Entity\UserEntity;
use App\Entity\UserGroupEntity;
use App\Repository\UserGroupRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManager;
use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

class UserServiceFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        /** @var EntityManager $entityManager */
        $entityManager = $container->get(EntityManager::class);
        /** @var UserRepository $userRepository */
        $userRepository = $entityManager->getRepository(UserEntity::class);
        /** @var UserGroupRepository $userGroupRepository */
        $userGroupRepository = $entityManager->getRepository(UserGroupEntity::class);

        return new UserService($userRepository, $userGroupRepository);
    }


}