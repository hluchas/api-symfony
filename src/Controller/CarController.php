<?php

namespace App\Controller;

use App\Entity\Car;
use App\Repository\CarRepository;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\View\View;
use Nelmio\ApiDocBundle\Annotation\Model;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Swagger\Annotations as SWG;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\ConstraintViolationListInterface;

class CarController extends AbstractController
{
    /**
     * @Rest\Get("/api/car")
     * @Rest\View()
     *
     * @SWG\Response(
     *     response=200,
     *     description="Returns all Cars available",
     *     @SWG\Schema(
     *         type="array",
     *         @Model(type=Car::class)
     *     )
     * )
     * @SWG\Tag(name="Car")
     *
     * @return Car[]
     */
    public function getAllAction(CarRepository $carRepository): array
    {
        return $carRepository->findAll();
    }

    /**
     * @Rest\Get("/api/car/{id}")
     * @Rest\View()
     * @ParamConverter("id", class="App:Car")
     *
     * @SWG\Response(
     *     response=200,
     *     description="Returns Url object if available",
     *     @Model(type=Car::class)
     * )
     * @SWG\Tag(name="Car")
     */
    public function getAction(Car $car): Car
    {
        return $car;
    }

    /**
     * @Rest\Post("/api/car")
     * @Rest\View()
     * @ParamConverter("car", converter="fos_rest.request_body")
     *
     * @SWG\Parameter(
     *     name="car",
     *     in="body",
     *     required=true,
     *     @SWG\Schema(
     *         type="array",
     *         @Model(type=Car::class)
     *     )
     * )
     * @SWG\Response(
     *     response=200,
     *     description="Returns Car object if created",
     *     @Model(type=Car::class)
     * )
     * @SWG\Tag(name="Car")
     */
    public function postAction(
        Car $car,
        ConstraintViolationListInterface $validationErrors,
        CarRepository $carRepository
    ): View {
        if (count($validationErrors) > 0) {
            return View::create($validationErrors, Response::HTTP_BAD_REQUEST);
        }

        return View::create($carRepository->save($car), Response::HTTP_OK);
    }
}
