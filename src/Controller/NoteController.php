<?php

namespace App\Controller;

use App\Entity\Note;
use App\Entity\Recette;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class NoteController extends AbstractController
{
    #[Route('/admin/recette/{id}/note', name: 'recette_add_note', methods: ['POST'])]
    public function addOrUpdateNote(int $id, Request $request, EntityManagerInterface $em): Response
    {
        $recette = $em->getRepository(Recette::class)->find($id);

        if (!$recette) {
            return $this->redirectToRoute('recettes');
        }

        // récupération note existante
        $note = $em->getRepository(Note::class)->findOneBy([
            'recette' => $recette
        ]);

        // si pas de note → création
        if (!$note) {
            $note = new Note();
            $note->setRecette($recette);
        }

        // récupération des valeurs
        $noteAspect = (int) $request->request->get('noteAspect');
        $noteOdeur = (int) $request->request->get('noteOdeur');
        $noteGout = (int) $request->request->get('noteGout');
        $noteTexture = (int) $request->request->get('noteTexture');

        // set valeurs
        $note->setNoteAspect($noteAspect);
        $note->setNoteOdeur($noteOdeur);
        $note->setNoteGout($noteGout);
        $note->setNoteTexture($noteTexture);

        $em->persist($note);
        $em->flush();

        return $this->redirectToRoute('recettes');
    }
}