<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use Symfony\Component\Routing\Annotation\Route;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Entity\User;


#[Route('/user', name: 'api_')]
class UserController extends AbstractController
{
    #[Route('/register', name: 'new_contact', methods: ['POST'])]
    public function userRegister(Request $request, UserPasswordHasherInterface $userPasswordHasher, EntityManagerInterface $entityManager): Response
    {
        $content = $request->getContent();
        $userData = json_decode($content, true);

        $existingUser = $entityManager->getRepository(User::class)
            ->findOneBy(['username' => $userData["username"]]);
        if ($existingUser) {
            $response = [
                'ok' => false,
                'message' => 'Username: '.$userData["username"].' already in use'
            ];
            return new JsonResponse($response, 400);
        }

        $user = new User();

        $user->fromJson($content);
        $user->setPassword(
            $userPasswordHasher->hashPassword(
                $user,
                $user->getPassword()
            )
        );

        $numUsers = $entityManager->getRepository(User::class)
            ->createQueryBuilder('user')
            ->select('count(user.id)')
            ->getQuery()
            ->getSingleScalarResult();
        if ($numUsers < 1) {
            $user->setRoles(['ROLE_ADMIN']);
        }
        $entityManager->persist($user);
        $entityManager->flush();
        $response = [
            'ok' => true,
            'message' => "User inserted",
        ];
        return new JsonResponse($response);
    }

    #[Route('/delete/{id}', name: 'delete_user', methods: ['DELETE'])]
    public function deleteUser(int $id, EntityManagerInterface $entityManager): Response
    {
        $user = $entityManager->getRepository(User::class)->find($id);

        if (!$user) {
            $response = [
                'ok' => false,
                'message' => "User not found",
            ];
            return new JsonResponse($response, Response::HTTP_NOT_FOUND);
        }

        $entityManager->remove($user);
        $entityManager->flush();

        $response = [
            'ok' => true,
            'message' => "User deleted",
        ];
        return new JsonResponse($response);
    }

    // #[Route('/modify/{id}', name: 'update_user', methods: ['PUT'])]
    // public function updateUser(Request $request, int $id, EntityManagerInterface $entityManager): Response
    // {
    //     $user = $entityManager->getRepository(User::class)->find($id);

    //     if (!$user) {
    //         $response = [
    //             'ok' => false,
    //             'message' => "User not found",
    //         ];
    //         return new JsonResponse($response, Response::HTTP_NOT_FOUND);
    //     }

    //     $content = $request->getContent();
    //     $user->fromJson($content);

    //     $entityManager->persist($user);
    //     $entityManager->flush();

    //     $response = [
    //         'ok' => true,
    //         'message' => "User updated",
    //     ];
    //     return new JsonResponse($response);
    // }
}
