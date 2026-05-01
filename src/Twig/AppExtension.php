<?php

namespace App\Twig;

use App\Repository\VersionRepository;
use Twig\Extension\AbstractExtension;
use Twig\Extension\GlobalsInterface;

class AppExtension extends AbstractExtension implements GlobalsInterface {

    public function __construct(
            private VersionRepository $versionRepository
    ) {
        
    }

    public function getGlobals(): array {
        return [
            'lastVersion' => $this->versionRepository->findLastVersion(),
        ];
    }
}
