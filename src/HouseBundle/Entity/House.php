<?php
/**
 * Created by iKNSA.
 * Author: Khalid Sookia <khalidsookia@gmail.com>
 * Date: 24/01/17
 * Time: 13:27
 */

namespace HouseBundle\Entity;


use Romenys\Framework\Components\Model;
use UserBundle\Entity\User;

class House extends Model
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @var string
     */
    protected $color;

    /**
     * @var User
     */
    protected $user;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return House
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getColor()
    {
        return $this->color;
    }

    /**
     * @param string $color
     * @return House
     */
    public function setColor($color)
    {
        $this->color = $color;
        return $this;
    }

    /**
     * @return User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param User $user
     * @return House
     */
    public function setUser(User $user)
    {
        $this->user = $user;
        return $this;
    }
}
