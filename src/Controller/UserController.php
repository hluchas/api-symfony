<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\Type\UserType;
use App\Repository\UserRepository;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\View\View;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

;

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
     * @ParamConverter("id", class="App:User")
     *
     * @param User $user
     * @return View
     */
    public function getAction(User $user): View
    {
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
     * @ParamConverter("id", class="App:User")
     *
     * @param User $user
     * @param UserRepository $userRepository
     * @return View
     */
    public function deleteAction(User $user, UserRepository $userRepository): View
    {
        $userRepository->delete($user);

        return View::create([], Response::HTTP_OK);
    }
}
