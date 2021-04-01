<?php


namespace App\Controller;

use App\Entity\Car;
use App\Repository\CarRepository;
use FOS\RestBundle\Controller\Annotations as Rest;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;
use Symfony\Component\Validator\ConstraintViolationListInterface;

class CarController extends AbstractController
{
    /**
     * @Rest\Get("/api/car")
     * @Rest\View()
     *
     * @param CarRepository $carRepository
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
     * @param Car $car
     * @return Car
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
     * @param Car $car
     * @param ConstraintViolationListInterface $validationErrors
     * @param CarRepository $carRepository
     */
    public function postAction(Car $car, ConstraintViolationListInterface $validationErrors,  CarRepository $carRepository): Car
    {
        if (count($validationErrors) > 0) {
            throw new BadRequestException($validationErrors);
        }

        return $carRepository->save($car);
    }
}