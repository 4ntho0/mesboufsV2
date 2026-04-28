<?php

namespace App\Controller;

use App\Entity\Recette;
use App\Entity\CategorieRecette;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RecettesController extends AbstractController {

    #[Route('/recettes', name: 'page_recettes')]
    public function recettes(Request $request, EntityManagerInterface $em): Response {
        $sort = $request->query->get('sort', 'date');
        $direction = strtoupper($request->query->get('direction', 'DESC'));

        if (!in_array($direction, ['ASC', 'DESC'])) {
            $direction = 'DESC';
        }

        $categoryIds = $request->query->all('categories'); // tableau d'id

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

        /**
         *  TRI
         */
        if ($sort === 'duree') {

            $qb->orderBy('r.duree', $direction);
        } elseif ($sort === 'note') {

            $qb->addSelect(
                            '(COALESCE(n.noteAspect,0) + COALESCE(n.noteOdeur,0) + COALESCE(n.noteGout,0) + COALESCE(n.noteTexture,0)) AS HIDDEN totalNote'
                    )
                    ->orderBy('totalNote', $direction);
        } elseif ($sort === 'nom') {

            $qb->orderBy('r.nom', $direction);
        } else {

            $qb->orderBy('r.date', 'DESC');
        }

        return $this->render('pages/recettes.html.twig', [
                    'recettes' => $qb->getQuery()->getResult(),
                    'sort' => $sort,
                    'direction' => $direction,
                    'categories' => $em->getRepository(CategorieRecette::class)->findAll(),
                    'selectedCategories' => $categoryIds
        ]);
    }
}
