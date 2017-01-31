<?php
/**
 * Created by iKNSA.
 * Author: Khalid Sookia <khalidsookia@gmail.com>
 * Date: 06/12/16
 * Time: 01:17
 */

namespace HouseBundle\Controller;

use HouseBundle\Repository\HouseRepository;
use UserBundle\Entity\User;
use Romenys\Framework\Controller\Controller;
use Romenys\Http\Request\Request;
use Romenys\Http\Response\JsonResponse;
use HouseBundle\Entity\House;

class HouseController extends Controller
{
    public function newAction(Request $request)
    {
        $houseRepository = new HouseRepository();


        if ($request->getMethod() === $request::REQUEST_METHOD_POST) {
            $user = new User($request->getPost()["house"]["user"]);

            $HData = $request->getPost()["house"];
            $HData["user"] = $user;

            $house = new House($HData);

            if ($houseRepository->create($house)) {
                return new JsonResponse([
                    "success" => true,
                    "message" => "L'assurance a bien été ajouté",
                    "assurance" => $house->toArray()
                ]);
            } else {
                return new JsonResponse([
                    "success" => false,
                    "message" => "Erreur. L'assurance n'a pu être ajouter. Vérifier vos droits d'accès ou contacter le support"
                ]);
            }
        }

        return new JsonResponse([
            "success" => true,
            "message" => "Affichage du formulaire"
        ]);
    }

    public function listAction()
    {
        $houseRepository = new HouseRepository();

        $houses = $houseRepository->listAll();

        $houseData = [];
        foreach ($houses as $house) {
            $houseData[] = $house->toArray();
        }

        return new JsonResponse([
            "houses" => $houseData
        ]);
    }

    public function editAction(Request $request)
    {
        $houseRepository = new HouseRepository();

        $house = $houseRepository->findById($request->getGet()["id"]);

        $response = [];
        if ($request->getMethod() === $request::REQUEST_METHOD_POST) {
            $house->setColor($request->getPost()["house"]["color"]);

            $response["form"] = "isSubmitted";

            if ($houseRepository->update($house)) {
                $response["success"] = true;
            } else {
                $response["success"] = false;
            }

        } else {
            $response["form"] = "create";
        }

        $response["success"] = true;
        $response["house"] = $house->toArray();

        return new JsonResponse($response);
    }

    public function deleteAction(Request $request)
    {
        if ($request->getMethod() === $request::REQUEST_METHOD_POST) {
            $houseRepository = new HouseRepository();

            $house = $houseRepository->findById($request->getGet()["id"]);

            if ($houseRepository->delete($house)) {
                $response["success"] = true;
            } else {
                $response["success"] = false;
            }
        } else {
            $response["success"] = false;
            $response["error"] = "La méthode n'est pas autorisé";
        }

        return new JsonResponse($response);
    }

    public function showAction(Request $request)
    {
        $houseRepository = new HouseRepository();

        $house = $houseRepository->findById($request->getGet()["id"]);

        return new JsonResponse([
            "success" => true,
            "house" => $house->toArray()
        ]);
    }
}