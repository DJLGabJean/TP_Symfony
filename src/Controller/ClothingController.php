<?php

namespace App\Controller;

use App\Entity\Clothing;
use App\Form\ClothingType;
use App\Repository\ClothingRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;


#[Route('/clothing', name: 'app_clothing')]
class ClothingController extends AbstractController
{
    #[Route('/list', name: '_list')]
    public function liste(ClothingRepository $clothingRepository): Response
    {
        $clothings = $clothingRepository->findAll();

        return $this->render('index.html.twig', [
            'clothings' => $clothings,
        ]);
    }

    #[Route('/add', name:'_add')]
    public function add(Request $request, EntityManagerInterface $entityManager): Response
    {
        $clothing = new Clothing();
        $clothingform = $this->createForm(ClothingType::class, $clothing);
        $clothingform->handleRequest($request);

        if ($clothingform->isSubmitted() && $clothingform->isValid()) {
            $entityManager->persist($clothing);
            $entityManager->flush();
            return $this->redirectToRoute('app_clothing_list');
        }

        return $this->render('add.html.twig', [
            'clothingform' => $clothingform->createView()
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
