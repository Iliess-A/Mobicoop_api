<?php
/**
 * Copyright (c) 2020, MOBICOOP. All rights reserved.
 * This project is dual licensed under AGPL and proprietary licence.
 ***************************
 *    This program is free software: you can redistribute it and/or modify
 *    it under the terms of the GNU Affero General Public License as
 *    published by the Free Software Foundation, either version 3 of the
 *    License, or (at your option) any later version.
 *
 *    This program is distributed in the hope that it will be useful,
 *    but WITHOUT ANY WARRANTY; without even the implied warranty of
 *    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *    GNU Affero General Public License for more details.
 *
 *    You should have received a copy of the GNU Affero General Public License
 *    along with this program.  If not, see <gnu.org/licenses>.
 ***************************
 *    Licence MOBICOOP described in the file
 *    LICENSE
 **************************/

namespace App\Solidary\Repository;

use App\Solidary\Entity\SolidaryUser;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;

/**
 * @method SolidaryUser|null find($id, $lockMode = null, $lockVersion = null)
 * @method SolidaryUser|null findOneBy(array $criteria, array $orderBy = null)
 */
class SolidaryUserRepository
{
    /**
     * @var EntityRepository
     */
    private $repository;
    
    private $entityManager;
    
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->repository = $entityManager->getRepository(SolidaryUser::class);
    }


    public function find(int $id): ?SolidaryUser
    {
        return $this->repository->find($id);
    }

    public function findAll(): ?array
    {
        return $this->repository->findAll();
    }


    public function findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null): ?array
    {
        return $this->repository->findBy($criteria, $orderBy, $limit, $offset);
    }

    public function findOneBy(array $criteria): ?SolidaryUser
    {
        return $this->repository->findOneBy($criteria);
    }

    /**
     * Get a SolidaryUser by its email
     *
     * @param string $email
     * @return SolidaryUser|null
     */
    public function findByEmail(string $email)
    {
        $query = $this->repository->createQueryBuilder('v')
        ->join('v.user', 'u')
        ->where('u.email = :email')
        ->setParameter('email', $email);

        return $query->getQuery()->getResult();
    }
}