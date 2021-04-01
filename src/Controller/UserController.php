<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use FOS\RestBundle\Controller\Annotations as Rest;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;
use Symfony\Component\Validator\ConstraintViolationListInterface;

class UserController extends AbstractController
{
    /**
     * @Rest\Get("/api/user")
     * @Rest\View()
     *
     * @param UserRepository $userRepository
     * @return array
     */
    public function getAllAction(UserRepository $userRepository): array
    {
        return $userRepository->findAll();
    }

    /**
     * @Rest\Get("/api/user/{id}")
     * @Rest\View()
     * @ParamConverter("id", class="App:User")
     *
     * @param User $user
     * @return User
     */
    public function getAction(User $user): User
    {
        return $user;
    }

    /**
     * @Rest\Post("/api/user")
     * @Rest\View()
     * @ParamConverter("user", converter="fos_rest.request_body")
     *
     * @param User $user
     * @param ConstraintViolationListInterface $validationErrors
     * @param UserRepository $userRepository
     */
    public function postAction(User $user, ConstraintViolationListInterface $validationErrors,  UserRepository $userRepository)
    {
        if (count($validationErrors) > 0) {
            throw new BadRequestException($validationErrors);
        }

        return $userRepository->save($user);
    }

    /**
     * @Rest\Delete("/api/user/{id}")
     * @Rest\View()
     * @ParamConverter("id", class="App:User")
     *
     * @param User $user
     * @param UserRepository $userRepository
     * @return array
     */
    public function deleteAction(User $user, UserRepository $userRepository): array
    {
        $userRepository->delete($user);

        return [];
    }
}
