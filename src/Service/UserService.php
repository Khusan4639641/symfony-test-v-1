<?php

declare(strict_types=1);

namespace App\Service;

use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\Validator\ConstraintViolationListInterface;

class UserService
{
    public function __construct(
        private UserRepository $userRepository,
        private EntityManagerInterface $entityManager,
        private ValidatorInterface $validator
    ) {}

    public function getAllUsers(): array
    {
        return $this->userRepository->findAll();
    }

    public function getUserById(int $id): ?User
    {
        return $this->userRepository->find($id);
    }

    public function createUser(User $user): ConstraintViolationListInterface
    {
        $errors = $this->validator->validate($user);

        if (count($errors) > 0) {
            return $errors;
        }

        $this->entityManager->persist($user);
        $this->entityManager->flush();

        return $errors;
    }

    public function updateUser(User $user): ConstraintViolationListInterface
    {
        $errors = $this->validator->validate($user);

        if (count($errors) > 0) {
            return $errors;
        }

        $this->entityManager->flush();

        return $errors;
    }

    public function deleteUser(User $user): void
    {
        $this->entityManager->remove($user);
        $this->entityManager->flush();
    }
}
