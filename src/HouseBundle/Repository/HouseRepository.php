<?php

namespace HouseBundle\Repository;


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
        $query->bindValue(':user', $house->getUser());

        return $query->execute();
    }
}