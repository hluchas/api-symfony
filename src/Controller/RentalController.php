<?php


namespace App\Controller;

use App\Entity\Rental;
use App\Repository\RentalRepository;
use FOS\RestBundle\Controller\Annotations as Rest;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;
use Symfony\Component\Validator\ConstraintViolationListInterface;

class RentalController extends AbstractController
{
    /**
     * @Rest\Get("/api/rental")
     * @Rest\View()
     *
     * @param RentalRepository $rentalRepository
     * @return array
     */
    public function getAllAction(RentalRepository $rentalRepository): array
    {
        return $rentalRepository->findAll();
    }

    /**
     * @Rest\Get("/api/rental/{id}")
     * @Rest\View()
     * @ParamConverter("id", class="App:Rental")
     *
     * @param Rental $rental
     * @return Rental
     */
    public function getAction(Rental $rental): Rental
    {
        return $rental;
    }

    /**
     * @Rest\Post("/api/rental")
     * @Rest\View()
     * @ParamConverter("rental", converter="fos_rest.request_body")
     *
     * @param Rental $rental
     * @param ConstraintViolationListInterface $validationErrors
     * @param RentalRepository $rentalRepository
     */
    public function postAction(Rental $rental, ConstraintViolationListInterface $validationErrors,  RentalRepository $rentalRepository)
    {
        if (count($validationErrors) > 0) {
            throw new BadRequestException($validationErrors);
        }

        return $rentalRepository->save($rental);
    }
}