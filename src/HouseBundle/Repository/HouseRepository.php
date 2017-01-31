<?php

namespace HouseBundle\Repository;


use UserBundle\Repository\UserRepository;
use Romenys\Framework\Components\DB\DB;
use HouseBundle\Entity\House;

class HouseRepository
{
    public function create(House $house)
    {
        $db = (new DB())->connect();

        $query = $db->prepare(
            "INSERT INTO `house` (`color`, `user`) VALUES (:color, :user)"
        );

        $query->bindValue(':color', $house->getColor());
        $query->bindValue(':user', $house->getUser()->getUniqueId());

        return $query->execute();
    }

    public function listAll()
    {
        $db = (new DB())->connect();
        $userRepository = new UserRepository();

        $housesData = $db->query("SELECT * FROM `house`")->fetchAll($db::FETCH_ASSOC);

        $houses = [];
        foreach ($housesData as $houseData) {
            $houseData["user"] = $userRepository->findByUniqueId($houseData["user"]);
            $houses[] = new House($houseData);
        }

        return $houses;
    }
}