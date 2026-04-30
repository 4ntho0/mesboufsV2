<?php

namespace App\Controller;

use App\Entity\Recette;
use App\Entity\Version;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController {

    #[Route('/home', name: 'home')]
    public function home(EntityManagerInterface $em): Response {
        $lastVersion = $em->getRepository(Version::class)->findOneBy([], [
            'date' => 'DESC'
        ]);
        $dernieresRecettes = $em->getRepository(Recette::class)
                ->findBy([], ['date' => 'DESC'], 2);

        return $this->render('pages/home.html.twig', [
                    'dernieresRecettes' => $dernieresRecettes,
                    'lastVersion' => $lastVersion
        ]);
    }

    #[Route('/versions', name: 'page_versions')]
    public function versions(EntityManagerInterface $em): Response {
        $versions = $em->getRepository(Version::class)->findBy([], [
            'date' => 'DESC'
        ]);

        return $this->render('pages/versions.html.twig', [
                    'versions' => $versions
        ]);
    }
}
