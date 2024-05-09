<?php

namespace App\Controller;

use App\Entity\User;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use phpDocumentor\Reflection\Types\Boolean;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;

class UserRegistrationController extends AbstractController
{
    public function __construct(
        private EntityManagerInterface $entityManager,
        private LoggerInterface $logger,
        private UserPasswordHasherInterface $passwordHasher
    ) {
    }

    #[Route('/userRegistration', methods: ['POST'])]
    public function registerNewUser(Request $request): Response
    {
        $this->logger->info('######## INITIALIZING USER REGISTRTION');

        $userInfo = json_decode($request->getContent(),true);
        $this->logger->info('######## User info:'.$userInfo['username']);

        if($userInfo === null){
            $this->logger->error('Unable to build userInfo during registration');
            return new Response(
                'Content',
                Response::HTTP_INTERNAL_SERVER_ERROR,
                ['content-type' => 'text/html']
            );
        } else {
            $createNewUserStatus = $this->createUser($userInfo);
            if($createNewUserStatus) {
                return $this->render('userRegistration/registerNewUser.html.twig', [
                    'username' => $userInfo['username'],
                ]);
            } else {
                $this->logger->error('Unable to register new user in database');
                return new Response(
                    'Content',
                    Response::HTTP_INTERNAL_SERVER_ERROR,
                    ['content-type' => 'text/html']
                );
            }
        }

    }

    private function createUser($userInfo)
    {
        $currentUser = new User();
        $currentUser->setUsername($userInfo['username']);
        $hashedPassword = $this->passwordHasher->hashPassword(
                $currentUser,
                $userInfo['password']
        );
        $currentUser->setPassword($hashedPassword);
        $currentUser->setFirstName($userInfo['firstName']);
        $currentUser->setLastName($userInfo['lastName']);
        $currentUser->setTelephone($userInfo['telephone']);
        $currentUser->setEmail($userInfo['email']);
        $currentUser->setRegistrationDate(new DateTime('now'));

        // tell Doctrine you want to (eventually) save the Product (no queries yet)
        $this->entityManager->persist($currentUser);

        // actually executes the queries (i.e. the INSERT query)
        $this->entityManager->flush();

        return true;
        //return new Response('Saved new user with id '.$currentUser->getId());
    }
}