<?php
/**
 * Created by iKNSA.
 * Author: Khalid Sookia <khalidsookia@gmail.com>
 * Date: 06/12/16
 * Time: 01:17
 */

namespace CarBundle\Controller;

use CarBundle\Repository\HouseRepository;
use UserBundle\Entity\User;
use Romenys\Framework\Controller\Controller;
use Romenys\Http\Request\Request;
use Romenys\Http\Response\JsonResponse;
use CarBundle\Entity\House;

class CarController extends Controller
{
    public function newAction(Request $request)
    {
        $carRepository = new CarRepository();


        if ($request->getMethod() === $request::REQUEST_METHOD_POST) {
            $user = new User($request->getPost()["car"]["user"]);

            $CarData = $request->getPost()["car"];
            $CarData["user"] = $user;

            $car = new House($CarData);

            if ($carRepository->create($car)) {
                return new JsonResponse([
                    "success" => true,
                    "message" => "La  voiture a bien été ajouté",
                    "car" => $car->toArray()
                ]);
            } else {
                return new JsonResponse([
                    "success" => false,
                    "message" => "Erreur. La voiture n'a pu être ajouter. Vérifier vos droits d'accès ou contacter le support"
                ]);
            }
        }

        return new JsonResponse([
            "success" => true,
            "message" => "Affichage du formulaire"
        ]);
    }

}