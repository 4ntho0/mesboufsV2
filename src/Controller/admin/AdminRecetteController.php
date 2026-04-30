<?php

namespace App\Controller\admin;

use App\Entity\Recette;
use App\Entity\CategorieRecette;
use App\Entity\CategorieProduit;
use App\Entity\Ingredient;
use App\Entity\Produit;
use App\Entity\Unitee;
use App\Entity\Note;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminRecetteController extends AbstractController {

    // ======================================================
    // RECETTES - LISTE
    // ======================================================
    #[Route('/admin', name: 'admin.recettes')]
    public function index(EntityManagerInterface $em): Response {
        return $this->render('admin/admin_recettes.html.twig', [
                    'recettes' => $em->getRepository(Recette::class)->findAll(),
        ]);
    }

    // ======================================================
    // RECETTES - CREATE
    // ======================================================
    #[Route('/admin/recette/add-page', name: 'admin.recette_add_page')]
    public function addPage(EntityManagerInterface $em): Response {
        return $this->render('admin/admin_recette_add.html.twig', [
                    'categories' => $em->getRepository(CategorieRecette::class)->findAll(),
        ]);
    }

    #[Route('/admin/recette/add', name: 'admin.recette_add', methods: ['POST'])]
    public function add(Request $request, EntityManagerInterface $em): Response {
        $recette = new Recette();
        $recette->setNom($request->request->get('nom'));
        $recette->setInstruction($request->request->get('instruction'));
        $recette->setDate(new \DateTime());

        if ($request->request->get('duree')) {
            $recette->setDuree((int) $request->request->get('duree'));
        }

        foreach ((array) $request->request->all('categories') as $id) {
            $cat = $em->getRepository(CategorieRecette::class)->find($id);
            if ($cat) {
                $recette->addCategory($cat);
            }
        }

        $em->persist($recette);
        $em->flush();

        return $this->redirectToRoute('admin.recette_manage', [
                    'id' => $recette->getId()
        ]);
    }

    // ======================================================
    // RECETTES - DELETE
    // ======================================================
    #[Route('/admin/recette/{id}/delete', name: 'admin.recette_delete', methods: ['POST'])]
    public function deleteRecette(int $id, EntityManagerInterface $em): Response {
        $recette = $em->getRepository(Recette::class)->find($id);

        if ($recette) {
            $em->remove($recette);
            $em->flush();
        }

        return $this->redirectToRoute('admin.recettes');
    }

    // ======================================================
    // WORKFLOW - PAGE GESTION (STEP 2)
    // ======================================================
    #[Route('/admin/recette/{id}/manage', name: 'admin.recette_manage')]
    public function manage(int $id, EntityManagerInterface $em): Response {
        return $this->render('admin/admin_recette_note_ingredient.html.twig', [
                    'recette' => $em->getRepository(Recette::class)->find($id),
                    'produits' => $em->getRepository(Produit::class)->findAll(),
                    'unitees' => $em->getRepository(Unitee::class)->findAll(),
                    'categoriesProduits' => $em->getRepository(CategorieProduit::class)
                            ->findBy([], ['nom' => 'ASC']),
        ]);
    }

    #[Route('/admin/recette/{id}/edit', name: 'admin.recette_edit')]
    public function edit(int $id, EntityManagerInterface $em): Response {
        return $this->render('admin/admin_recette_update.html.twig', [
                    'recette' => $em->getRepository(Recette::class)->find($id),
                    'categories' => $em->getRepository(CategorieRecette::class)->findAll(),
        ]);
    }

    #[Route('/admin/recette/{id}/update', name: 'admin.recette_update', methods: ['POST'])]
    public function update(int $id, Request $request, EntityManagerInterface $em): Response {
        $recette = $em->getRepository(Recette::class)->find($id);

        $recette->setNom($request->request->get('nom'));
        $recette->setDuree((int) $request->request->get('duree'));
        $recette->setInstruction($request->request->get('instruction'));

        foreach ($recette->getCategories() as $cat) {
            $recette->removeCategory($cat);
        }

        foreach ((array) $request->request->all('categories') as $idCat) {
            $cat = $em->getRepository(CategorieRecette::class)->find($idCat);
            if ($cat) {
                $recette->addCategory($cat);
            }
        }

        $em->flush();

        return $this->redirectToRoute('admin.recette_manage', ['id' => $id]);
    }

    // ======================================================
    // INGREDIENTS
    // ======================================================
    #[Route('/admin/recette/{id}/ingredient/add', name: 'admin.recette_add_ingredient', methods: ['POST'])]
    public function addIngredient(int $id, Request $request, EntityManagerInterface $em): Response {
        $recette = $em->getRepository(Recette::class)->find($id);

        $ingredient = new Ingredient();
        $ingredient->setRecette($recette);
        $ingredient->setQuantite((float) $request->request->get('quantite'));
        $ingredient->setProduit($em->getRepository(Produit::class)->find($request->request->get('produit')));
        $ingredient->setUnitee($em->getRepository(Unitee::class)->find($request->request->get('unitee')));

        $em->persist($ingredient);
        $em->flush();

        return $this->redirectToRoute('admin.recette_manage', ['id' => $id]);
    }

    #[Route('/admin/ingredient/{id}/delete', name: 'admin.recette_delete_ingredient', methods: ['POST'])]
    public function deleteIngredient(int $id, EntityManagerInterface $em): Response {
        $ingredient = $em->getRepository(Ingredient::class)->find($id);

        if ($ingredient) {
            $recetteId = $ingredient->getRecette()->getId();
            $em->remove($ingredient);
            $em->flush();

            return $this->redirectToRoute('admin.recette_manage', ['id' => $recetteId]);
        }

        return $this->redirectToRoute('admin.recettes');
    }

    // ======================================================
    // ⭐ NOTES
    // ======================================================
    #[Route('/admin/recette/{id}/note/save', name: 'admin.recette_save_note', methods: ['POST'])]
    public function saveNote(int $id, Request $request, EntityManagerInterface $em): Response {
        $recette = $em->getRepository(Recette::class)->find($id);

        $note = $recette->getNote();

        if (!$note) {
            $note = new Note();
            $note->setRecette($recette);
        }

        $note->setNoteAspect((int) $request->request->get('noteAspect'));
        $note->setNoteOdeur((int) $request->request->get('noteOdeur'));
        $note->setNoteGout((int) $request->request->get('noteGout'));
        $note->setNoteTexture((int) $request->request->get('noteTexture'));

        $em->persist($note);
        $em->flush();

        return $this->redirectToRoute('admin.recettes');
    }

    // ======================================================
    // 🔌 API AJAX
    // ======================================================
    #[Route('/admin/produits/by-categorie/{id}', name: 'admin.produits_by_categorie', methods: ['GET'])]
    public function getProduitsByCategorie(int $id, EntityManagerInterface $em): Response {
        $categorie = $em->getRepository(CategorieProduit::class)->find($id);

        if (!$categorie) {
            return $this->json([]);
        }

        $data = [];

        foreach ($categorie->getProduits() as $produit) {
            $data[] = [
                'id' => $produit->getId(),
                'nom' => $produit->getNom()
            ];
        }

        return $this->json($data);
    }
}
