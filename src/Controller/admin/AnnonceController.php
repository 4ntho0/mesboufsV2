<?php

namespace App\Controller\admin;

use App\Entity\Annonce;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class AnnonceController extends AbstractController {

    #[Route('/admin/annonce', name: 'admin_annonce_edit', methods: ['GET', 'POST'])]
public function edit(Request $request, EntityManagerInterface $em): Response
{
    $annonce = $em->getRepository(Annonce::class)->find(1);

    if (!$annonce) {
        $annonce = new Annonce();
        $em->persist($annonce);
    }

    if ($request->isMethod('POST')) {
        $annonce->setInfo($request->request->get('info'));
        $em->flush();

        return $this->redirectToRoute('admin_annonce_edit');
    }

    return $this->render('admin/annonce.html.twig', [
        'annonce' => $annonce,
    ]);
}
}
