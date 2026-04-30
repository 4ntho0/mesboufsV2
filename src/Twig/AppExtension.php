<?php

// src/Twig/AppExtension.php

namespace App\Twig;

use App\Entity\Version;
use Doctrine\ORM\EntityManagerInterface;
use Twig\Extension\AbstractExtension;
use Twig\Extension\GlobalsInterface;

class AppExtension extends AbstractExtension implements GlobalsInterface {

    private $em;

    public function __construct(EntityManagerInterface $em) {
        $this->em = $em;
    }

    public function getGlobals(): array {
        $lastVersion = $this->em->getRepository(Version::class)
                ->findOneBy([], ['date' => 'DESC']);

        return [
            'lastVersion' => $lastVersion
        ];
    }
}
