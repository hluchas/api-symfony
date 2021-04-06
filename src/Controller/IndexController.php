<?php

namespace App\Controller;

use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;

class IndexController extends AbstractController
{
    /**
     * @Rest\Get("/")
     */
    public function index(): RedirectResponse
    {
        return $this->redirect('/doc');
    }
}
