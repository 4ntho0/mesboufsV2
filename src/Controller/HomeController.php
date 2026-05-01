<?php

namespace App\Controller;

use App\Entity\Recette;
use App\Entity\Annonce;
use App\Entity\Version;
use App\Entity\CategorieRecette;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController {

    #[Route('/', name: 'home')]
    public function home(Request $request, EntityManagerInterface $em): Response {
// ================= VERSION + ANNONCE =================
        $lastVersion = $em->getRepository(Version::class)->findOneBy([], [
            'date' => 'DESC'
        ]);

        $annonce = $em->getRepository(Annonce::class)->find(1);

// ================= FILTRES =================
        $sort = $request->query->get('sort', 'date');
        $direction = strtoupper($request->query->get('direction', 'DESC'));

        if (!in_array($direction, ['ASC', 'DESC'])) {
            $direction = 'DESC';
        }

        $categoryIds = $request->query->all('categories');

// ================= QUERY RECETTES =================
        $qb = $em->createQueryBuilder()
                ->select('DISTINCT r', 'n')
                ->from(Recette::class, 'r')
                ->leftJoin('r.note', 'n');

        if (!empty($categoryIds)) {
            $qb->innerJoin('r.categories', 'cat')
                    ->andWhere('cat.id IN (:cats)')
                    ->setParameter('cats', $categoryIds)
                    ->groupBy('r.id')
                    ->having('COUNT(DISTINCT cat.id) = :nbCats')
                    ->setParameter('nbCats', count($categoryIds));
        }

// ================= TRI =================
        if ($sort === 'duree') {
            $qb->orderBy('r.duree', $direction);
        } elseif ($sort === 'note') {
            $qb->addSelect(
                    '(COALESCE(n.noteAspect,0) + COALESCE(n.noteOdeur,0) + COALESCE(n.noteGout,0) + COALESCE(n.noteTexture,0)) AS HIDDEN totalNote'
            )->orderBy('totalNote', $direction);
        } elseif ($sort === 'nom') {
            $qb->orderBy('r.nom', $direction);
        } else {
            $qb->orderBy('r.date', 'DESC');
        }

        return $this->render('pages/home.html.twig', [
                    'recettes' => $qb->getQuery()->getResult(),
                    'categories' => $em->getRepository(CategorieRecette::class)->findAll(),
                    'selectedCategories' => $categoryIds,
                    'sort' => $sort,
                    'direction' => $direction,
                    'lastVersion' => $lastVersion,
                    'annonce' => $annonce
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

    #[Route('/recette/{id}', name: 'page_recette')]
    public function recette(int $id, EntityManagerInterface $em): Response {
        $recette = $em->getRepository(Recette::class)->find($id);

        if (!$recette) {
            throw $this->createNotFoundException('Recette non trouvée');
        }

        return $this->render('pages/recette.html.twig', [
                    'recette' => $recette
        ]);
    }
}
