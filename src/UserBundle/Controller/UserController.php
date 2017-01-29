<?php
/**
 * Created by iKNSA.
 * Author: Khalid Sookia <khalidsookia@gmail.com>
 * Date: 24/01/17
 * Time: 13:31
 */

namespace UserBundle\Controller;


use Romenys\Framework\Controller\Controller;
use Romenys\Http\Request\Request;
use Romenys\Http\Response\JsonResponse;
use UserBundle\Entity\User;
use UserBundle\Repository\UserRepository;

class UserController extends Controller
{
    public function newAction(Request $request)
    {
        $clientRepository = new UserRepository();

        if ($request->getMethod() === $request::REQUEST_METHOD_POST) {
            $user = new User($request->getPost()["user"]);

            if ($clientRepository->create($user)) {
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
            $newClientEmail = $request->getPost()["user"]["tel"];

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
}
