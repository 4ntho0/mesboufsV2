<?php

namespace App\Controller\admin;

use App\Entity\Version;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class VersionController extends AbstractController {

    #[Route('/admin/versions', name: 'admin.versions')]
    public function index(EntityManagerInterface $em): Response {
        $versions = $em->getRepository(Version::class)->findBy([], [
            'date' => 'DESC'
        ]);

        return $this->render('admin/admin.versions.html.twig', [
                    'versions' => $versions
        ]);
    }

    #[Route('/admin/version/add', name: 'admin.version_add', methods: ['POST'])]
    public function add(Request $request, EntityManagerInterface $em): Response {
        $version = new Version();

        $version->setVersion($request->request->get('version'));
        $version->setTitre($request->request->get('titre'));
        $version->setDescription($request->request->get('description'));
        $version->setDate(new \DateTime($request->request->get('date')));

        $em->persist($version);
        $em->flush();

        return $this->redirectToRoute('admin.versions');
    }
}
