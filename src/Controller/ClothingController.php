<?php

namespace App\Controller;

use App\Repository\ClothingRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ClothingController extends AbstractController
{
    #[Route('/clothing', name: 'app_clothing')]
    public function liste(ClothingRepository $clothingRepository): Response
    {
        $clothings = $clothingRepository->findAll();

        return $this->render('index.html.twig', [
            'clothings' => $clothings,
        ]);
    }

    

    // #[Route('/ajout', name: 'ajout_clothing')]

    // public function ajout(): Response
    // {
    //     return $this->render('index.html.twig', [
    //         'controller_name' => 'ClothingController',
    //     ]);
    // }
}
