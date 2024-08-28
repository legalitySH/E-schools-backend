<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Director;
use App\Repository\Api\DirectorRepositoryInterface;
use Doctrine\Persistence\ManagerRegistry;

/** @extends BaseRepository<Director> */
final class DirectorRepository extends BaseRepository implements DirectorRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Director::class);
    }

    public function isExists(string $email, string $phoneNumber = ''): bool
    {
        if($phoneNumber !== '') {
            return $this->findOneBy(['phoneNumber' => $phoneNumber]) !== null ||
                $this->findOneBy(['email' => $email]) !== null;
        }

        return $this->findOneBy(['email' => $email]) !== null;
    }
}
