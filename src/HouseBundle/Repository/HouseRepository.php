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

    public function findById($id)
    {
        $db = (new DB())->connect();
        $userRepository = new UserRepository();

        $houseData = $db->query("SELECT * FROM `house` WHERE `id`= '" . $id . "'")->fetch($db::FETCH_ASSOC);

        $houseData["user"] = $userRepository->findByUniqueId($houseData["user"]);

        return new House($houseData);
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

    public function update(House $house)
    {
        $db = (new DB())->connect();

        $query = $db->query(
            "UPDATE `house` SET `color` = " . $house->getColor());

        return $query->execute();
    }

    public function delete(House $house)
    {
        $db = (new DB())->connect();

        $query = $db->query("DELETE FROM `house` WHERE `id` = " . $house->getId());

        return $query->execute();
    }
}