<?php

namespace Bundle\DemoBundle\UserBundle\Controller;


use Romenys\Framework\Controller\Controller;
use Romenys\Http\Request\Request;
use Romenys\Http\Response\JsonResponse;
use Bundle\DemoBundle\UserBundle\Entity\User;
use Bundle\DemoBundle\UserBundle\Repository\UserRepository;

class UserController extends Controller
{
    public function newAction(Request $request)
    {
        $UserRepository = new UserRepository();

        if ($request->getMethod() === $request::REQUEST_METHOD_POST) {
            $user = new User($request->getPost()["user"]);

            if ($UserRepository->create($user)) {
                return new JsonResponse([
                    "success" => true,
                    "message" => "L'utilisateur a bien été ajouté",
                    "user" => $user->toArray()
                ]);
            } else {
                return new JsonResponse([
                    "success" => false,
                    "message" => "Erreur. L'utilisateur n'a pu être ajouter. Vérifier vos droits d'accès ou contacter le support"
                ]);
            }
        }

        return new JsonResponse([
            "success" => true,
            "message" => "Affichage du formulaire"
        ]);
    }

    public function editAction(Request $request)
    {
        $UserRepository = new UserRepository();

        $user = $UserRepository->findByUniqueId($request->getGet()["uniqueId"]);

        if ($request->getMethod() === $request::REQUEST_METHOD_POST) {

            $newUserName = $request->getPost()["user"]["name"];
            $newUserTel = $request->getPost()["user"]["tel"];

            $newUser = $user->setTel($newUserTel);
            $newUser->setName($newUserName);

            $newUser = $UserRepository->update($newUser);

            if ($newUser) {
                return new JsonResponse([
                    "success" => true,
                    "message" => "L'utilisateur a bien été modifié",
                    "user" => $newUser->toArray()
                ]);
            } else {
                return new JsonResponse([
                    "success" => false,
                    "message" => "Erreur. L'utilisateur n'a pu être modifier. Vérifier vos droits d'accès ou contacter le support",
                    "user" => $user
                ]);
            }
        }

        return new JsonResponse([
            "success" => true,
            "message" => "Affichage du formulaire update",
            "user" => $user->toArray()
        ]);
    }

    public function listAction()
    {
        $UserRepository = new UserRepository();

        $usersObjects = $UserRepository->listAll();

        $users = [];
        if ($usersObjects) {
            foreach ($usersObjects as $userObject) {
                $users[] = $userObject->toArray();
            }

            return new JsonResponse([
                "success" => true,
                "message" => "La liste des users est bien affiché",
                "users" => $users
            ]);
        } else {
            return new JsonResponse([
                "success" => false,
                "message" => "Erreur"
            ]);
        }
    }

    public function showAction(Request $request)
    {
        $userRepository = new UserRepository();

       $user = $userRepository->findByUniqueId($request->getGet()["uniqueId"]);


        if ($user) {
            return new JsonResponse([
                "success" => true,
                "message" => "L'utilisateur a bien été affiché",
                "user" => $user->toArray()
            ]);
        } else {
            return new JsonResponse([
                "success" => false,
                "message" => "Erreur. L'utilisateur n'a pu être afficher"
            ]);
        }
    }

    public function deleteAction(Request $request)
    {
        if ($request->getMethod() === $request::REQUEST_METHOD_POST) {
            $userRepository = new UserRepository();

            $user = $userRepository->findByUniqueId($request->getPost()["user"]["uniqueId"]);
            $deleteUser = $userRepository->deleteOne($user);

            if ($deleteUser) {
                return new JsonResponse([
                    "success" => true,
                    "message" => "L'utilisateur a bien été supprimer"
                ]);
            } else {
                return new JsonResponse([
                    "success" => false,
                    "message" => "Erreur. L'utilisateur n'a pu être supprimer."
                ]);
            }
        } else {
            return new JsonResponse([
                "success" => false,
                "message" => "Affichage du formulaire de suppression"
            ]);
        }
    }
}