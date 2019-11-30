<?php


namespace App\Service;


use App\Entity\UserEntity;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManager;
use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

class AuthServiceFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        /** @var EntityManager $entityManager */
        $entityManager = $container->get(EntityManager::class);
        /** @var UserRepository $userRepostory */
        $userRepository = $entityManager->getRepository(UserEntity::class);

        return new AuthService($userRepository);
    }


}