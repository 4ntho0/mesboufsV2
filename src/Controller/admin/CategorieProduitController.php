<?php

namespace App\Controller\admin;

use App\Entity\CategorieProduit;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CategorieProduitController extends AbstractController {

    #[Route('/admin/categorie-produit', name: 'categorie_produit')]
    public function index(EntityManagerInterface $em): Response {
        $categories = $em->getRepository(CategorieProduit::class)->findAll();

        return $this->render('admin/categorie_produit.html.twig', [
                    'categories' => $categories
        ]);
    }

    #[Route('/admin/categorie-produit/add', name: 'categorie_produit_add', methods: ['POST'])]
    public function add(Request $request, EntityManagerInterface $em): Response {
        $nom = trim($request->request->get('nom'));

        if ($nom) {
            $categorie = new CategorieProduit();
            $categorie->setNom($nom);

            $em->persist($categorie);
            $em->flush();
        }

        return $this->redirectToRoute('categorie_produit');
    }

    #[Route('/admin/categorie-produit/delete/{id}', name: 'categorie_produit_delete', methods: ['POST'])]
    public function delete(int $id, EntityManagerInterface $em): Response {
        $categorie = $em->getRepository(CategorieProduit::class)->find($id);

        if ($categorie) {
            $em->remove($categorie);
            $em->flush();
        }

        return $this->redirectToRoute('categorie_produit');
    }
}
