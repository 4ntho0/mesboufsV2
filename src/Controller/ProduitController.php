<?php

namespace App\Controller;

use App\Entity\Produit;
use App\Entity\CategorieProduit;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProduitController extends AbstractController {

    #[Route('/admin/produit', name: 'produit')]
    public function index(EntityManagerInterface $em): Response {
        $produits = $em->getRepository(Produit::class)->findAll();
        $categories = $em->getRepository(CategorieProduit::class)->findAll();

        return $this->render('admin/produit.html.twig', [
                    'produits' => $produits,
                    'categories' => $categories
        ]);
    }

    #[Route('/admin/produit/add', name: 'produit_add', methods: ['POST'])]
    public function add(Request $request, EntityManagerInterface $em): Response {
        $nom = trim($request->request->get('nom'));
        $categorieId = $request->request->get('categorie');

        if ($nom) {
            $produit = new Produit();
            $produit->setNom($nom);

            if ($categorieId) {
                $categorie = $em->getRepository(CategorieProduit::class)->find($categorieId);
                $produit->setCategorie($categorie);
            }

            $em->persist($produit);
            $em->flush();
        }

        return $this->redirectToRoute('produit');
    }

    #[Route('/admin/produit/delete/{id}', name: 'produit_delete', methods: ['POST'])]
    public function delete(int $id, EntityManagerInterface $em): Response {
        $produit = $em->getRepository(Produit::class)->find($id);

        if ($produit) {
            $em->remove($produit);
            $em->flush();
        }

        return $this->redirectToRoute('produit');
    }
}
