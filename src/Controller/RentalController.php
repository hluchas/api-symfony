<?php

namespace App\Controller;

use App\Entity\Rental;
use App\Repository\RentalRepository;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\View\View;
use Nelmio\ApiDocBundle\Annotation\Model;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Swagger\Annotations as SWG;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\ConstraintViolationListInterface;

class RentalController extends AbstractController
{
    /**
     * @Rest\Get("/api/rental")
     * @Rest\View()
     *
     * @SWG\Response(
     *     response=200,
     *     description="Returns all Rentals available",
     *     @SWG\Schema(
     *         type="array",
     *         @Model(type=Rental::class)
     *     )
     * )
     * @SWG\Tag(name="Rental")
     *
     * @return Rental[]
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
     * @SWG\Response(
     *     response=200,
     *     description="Returns Rental object if available",
     *     @Model(type=Rental::class)
     * )
     * @SWG\Tag(name="Rental")
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
     * @SWG\Parameter(
     *     name="rental",
     *     in="body",
     *     required=true,
     *     @SWG\Schema(
     *         type="array",
     *         @Model(type=Rental::class)
     *     )
     * )
     * @SWG\Response(
     *     response=200,
     *     description="Returns Rental object if created",
     *     @Model(type=Rental::class)
     * )
     * @SWG\Tag(name="Rental")
     */
    public function postAction(
        Rental $rental,
        ConstraintViolationListInterface $validationErrors,
        RentalRepository $rentalRepository
    ): View {
        if (count($validationErrors) > 0) {
            return View::create($validationErrors, Response::HTTP_BAD_REQUEST);
        }

        return View::create($rentalRepository->save($rental), Response::HTTP_OK);
    }
}
