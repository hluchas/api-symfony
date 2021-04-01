<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\Type\UserType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityNotFoundException;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\View\View;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class UserController extends AbstractController
{
    /**
     * @Rest\Get("/api/user")
     *
     * @param UserRepository $userRepository
     * @return View
     */
    public function getAllAction(UserRepository $userRepository): View
    {
        return View::create($userRepository->findAll(), Response::HTTP_OK);
    }

    /**
     * @Rest\Get("/api/user/{id}")
     *
     * @param int $id
     * @param UserRepository $userRepository
     * @return View
     */
    public function getAction(int $id, UserRepository $userRepository): View
    {
        $user = $userRepository->findOneById($id);

        if (null === $user) {
            throw new NotFoundHttpException("User with ID '$id' not found");
        }

        return View::create($user, Response::HTTP_OK);
    }

    /**
     * @Rest\Post("/api/user")
     *
     * @param Request $request
     * @param UserRepository $userRepository
     * @return View
     */
    public function postAction(Request $request, UserRepository $userRepository): View
    {
        $data = json_decode($request->getContent(),true);

        $form = $this->createForm(UserType::class, new User());
        $form->submit($data);

        if(! $form->isValid()) {
            return View::create($form->getErrors(), Response::HTTP_BAD_REQUEST);
        }

        return View::create($userRepository->save($form->getData()), Response::HTTP_OK);
    }

    /**
     * @Rest\Delete("/api/user/{id}")
     *
     * @param int $id
     * @param UserRepository $userRepository
     * @return View
     */
    public function deleteAction(int $id, UserRepository $userRepository): View
    {
        try {
            $userRepository->deleteById($id);
        } catch (EntityNotFoundException $e) {
            throw new NotFoundHttpException($e->getMessage());
        }

        return View::create([], Response::HTTP_OK);
    }
}
