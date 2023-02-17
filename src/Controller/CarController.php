<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use Symfony\Component\Routing\Annotation\Route;

use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\Car;


#[Route('/api', name: 'api_')]
class CarController extends AbstractController
{
    #[Route('/cars', name: 'all_cars', methods: ['GET'])]
    public function index(ManagerRegistry $doctrine): Response
    {
        $cars = $doctrine
            ->getRepository(Car::class)
            ->findAll();

        $data = [];

        foreach ($cars as $car) {
            $data[] = [
                'id' => $car->getId(),
                'car_id' => $car->getCarId(),
                'car_model' => $car->getCarModel(),
                'car_series' => $car->getCarSeries(),
                'car_col' => $car->getCarCol(),
                'series_col' => $car->getSeriesCol(),
                'car_version' => $car->getCarVersion(),
                'car_image' => $car->getCarImage(),
            ];
        }


        return $this->json($data);
    }

    #[Route('/car/{id}', name: 'car_by_id', methods: ['GET'])]
    public function show(ManagerRegistry $doctrine, int $id): Response
    {
        $car = $doctrine->getRepository(Car::class)->find($id);

        if (!$car) {

            return $this->json('No car found for id ' . $id, 404);
        }

        $data =  [
            'id' => $car->getId(),
            'car_id' => $car->getCarId(),
            'car_model' => $car->getCarModel(),
            'car_series' => $car->getCarSeries(),
            'car_col' => $car->getCarCol(),
            'series_col' => $car->getSeriesCol(),
            'car_version' => $car->getCarVersion(),
            'car_image' => $car->getCarImage(),
        ];

        return $this->json($data);
    }
}