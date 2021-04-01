<?php

namespace App\Controller;

use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\View\View;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class IndexController extends AbstractController
{
    /**
     * @Rest\Get("/")
     */
    public function index(): View
    {
        return View::create([], Response::HTTP_OK);
    }
}
