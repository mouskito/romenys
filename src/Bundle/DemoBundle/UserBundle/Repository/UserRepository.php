<?php

namespace Bundle\DemoBundle\UserBundle\Repository;


use Romenys\Framework\Components\DB\DB;
use UserBundle\Entity\User;

class UserRepository
{
    public function create(User $user)
    {
        $db = (new DB())->connect();

        $query = $db->prepare(
            "INSERT INTO `user` (`uniqueId`, `name`, `tel`, `createdAt`) VALUES (:uniqueId, :name, :tel, :createdAt)"
        );

        $query->bindValue(':uniqueId', $user->getUniqueId());
        $query->bindValue(':name', $user->getName());
        $query->bindValue(':tel', $user->getTel());
        $query->bindValue(':createdAt', $user->getCreatedAt()->format('Y-m-d H:i:s'));

        return $query->execute();
    }

    public function update(User $user)
    {
        $db = (new DB())->connect();

        $query = $db->prepare(" UPDATE `user` SET `name` = '".$user->getName()."', `tel` = '".$user->getTel().
            "' WHERE `uniqueId` =" . $user->getUniqueId());

        $query->execute();

        $newUser = $this->findByUniqueId($user->getUniqueId());

        return $newUser;
    }

    public function findByUniqueId($uniqueId)
    {
        $db = (new DB())->connect();

        $data = $db->query("SELECT * FROM `user` WHERE `uniqueId` = '" . $uniqueId . "'")->fetch($db::FETCH_ASSOC);

        return new User($data);
    }

    public function listAll()
    {
        $db = new DB();
        $db = $db->connect();

        $query = $db->query("SELECT * FROM `user`");
        $usersArray = $query->fetchAll($db::FETCH_ASSOC);

        $users = [];
        foreach ($usersArray as $data) {
            $users[] = new User($data);
        }

        return $users;
    }

    public function deleteOne(User $user)
    {
        $db = (new DB())->connect();

        $query = $db->prepare(" DELETE  FROM `user`  WHERE `id` =" . $user->getId());

        return $query->execute();
    }
}