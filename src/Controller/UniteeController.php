<?php

namespace App\Controller;

use App\Entity\Unitee;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UniteeController extends AbstractController {

    #[Route('/admin/unitee', name: 'unitee')]
    public function index(EntityManagerInterface $em): Response {
        $unitees = $em->getRepository(Unitee::class)->findAll();

        return $this->render('admin/unitee.html.twig', [
                    'unitees' => $unitees
        ]);
    }

    #[Route('/admin/unitee/add', name: 'unitee_add', methods: ['POST'])]
    public function add(Request $request, EntityManagerInterface $em): Response {
        $nom = trim($request->request->get('nom'));

        if ($nom) {
            $unitee = new Unitee();
            $unitee->setNom($nom);

            $em->persist($unitee);
            $em->flush();
        }

        return $this->redirectToRoute('unitee');
    }

    #[Route('/admin/unitee/delete/{id}', name: 'unitee_delete', methods: ['POST'])]
    public function delete(int $id, EntityManagerInterface $em): Response {
        $unitee = $em->getRepository(Unitee::class)->find($id);

        if ($unitee) {
            $em->remove($unitee);
            $em->flush();
        }

        return $this->redirectToRoute('unitee');
    }
}
