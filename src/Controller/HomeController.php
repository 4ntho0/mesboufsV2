<?php

namespace App\Controller;

use App\Entity\Recette;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController {
    
    #[Route('/home', name: 'home')]
    public function home(EntityManagerInterface $em): Response {
        $dernieresRecettes = $em->getRepository(Recette::class)
                ->findBy([], ['date' => 'DESC'], 2);

        return $this->render('pages/home.html.twig', [
                    'dernieresRecettes' => $dernieresRecettes
        ]);
    }
}
