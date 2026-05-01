<?php

namespace App\Repository;

use App\Entity\Version;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class VersionRepository extends ServiceEntityRepository {

    public function __construct(ManagerRegistry $registry) {
        parent::__construct($registry, Version::class);
    }

    public function findAllSortedByVersionDesc(): array {
        $versions = $this->findAll();

        usort($versions, function (Version $a, Version $b) {
            return version_compare($b->getVersion(), $a->getVersion());
        });

        return $versions;
    }

    public function findLastVersion(): ?Version {
        $versions = $this->findAllSortedByVersionDesc();

        return $versions[0] ?? null;
    }
}
