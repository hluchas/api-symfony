<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use FOS\RestBundle\Controller\Annotations as Rest;
use Nelmio\ApiDocBundle\Annotation\Model;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Swagger\Annotations as SWG;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;
use Symfony\Component\Validator\ConstraintViolationListInterface;

class UserController extends AbstractController
{
    /**
     * @Rest\Get("/api/user")
     * @Rest\View()
     *
     * @SWG\Response(
     *     response=200,
     *     description="Returns all Users available",
     *     @SWG\Schema(
     *         type="array",
     *         @Model(type=User::class)
     *     )
     * )
     * @SWG\Tag(name="User")
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
     * @SWG\Response(
     *     response=200,
     *     description="Returns user object if available",
     *     @Model(type=User::class)
     * )
     * @SWG\Tag(name="User")
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
     * @SWG\Parameter(
     *     name="user",
     *     in="body",
     *     required=true,
     *     @SWG\Schema(
     *         type="array",
     *         @Model(type=User::class)
     *     )
     * )
     * @SWG\Response(
     *     response=200,
     *     description="Returns User object if created",
     *     @Model(type=User::class)
     * )
     * @SWG\Tag(name="User")
     */
    public function postAction(User $user, ConstraintViolationListInterface $validationErrors, UserRepository $userRepository)
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
     * @SWG\Response(
     *     response=200,
     *     description="Returns empty array"
     * )
     * @SWG\Tag(name="User")
     */
    public function deleteAction(User $user, UserRepository $userRepository): array
    {
        $userRepository->delete($user);

        return [];
    }
}
