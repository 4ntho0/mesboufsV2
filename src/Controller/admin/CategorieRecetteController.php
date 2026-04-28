<?php

namespace App\Controller\admin;

use App\Entity\CategorieRecette;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CategorieRecetteController extends AbstractController {

    #[Route('/admin/categorie-recette', name: 'categorie_recette')]
    public function index(EntityManagerInterface $em): Response {
        $categories = $em->getRepository(CategorieRecette::class)->findAll();

        return $this->render('admin/categorie_recette.html.twig', [
                    'categories' => $categories
        ]);
    }

    #[Route('/admin/categorie-recette/add', name: 'categorie_recette_add', methods: ['POST'])]
    public function add(Request $request, EntityManagerInterface $em): Response {
        $nom = trim($request->request->get('nom'));

        if ($nom) {
            $categorie = new CategorieRecette();
            $categorie->setNom($nom);

            $em->persist($categorie);
            $em->flush();
        }

        return $this->redirectToRoute('categorie_recette');
    }

    #[Route('/admin/categorie-recette/delete/{id}', name: 'categorie_recette_delete', methods: ['POST'])]
    public function delete(int $id, EntityManagerInterface $em): Response {
        $categorie = $em->getRepository(CategorieRecette::class)->find($id);

        if ($categorie) {
            $em->remove($categorie);
            $em->flush();
        }

        return $this->redirectToRoute('categorie_recette');
    }
}
