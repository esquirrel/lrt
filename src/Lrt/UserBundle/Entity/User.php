<?php

namespace Lrt\UserBundle\Entity;

use FOS\UserBundle\Entity\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Lrt\SiteBundle\Entity\Content;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\OneToMany(targetEntity="\Lrt\SiteBundle\Entity\Content", mappedBy="user")
     */
    protected $content;

    public function __construct()
    {
        parent::__construct();
    }


    /**
     * Add content
     *
     * @param \Lrt\UserBundle\Entity\Content $content
     * @return void
     */
    public function addContent(Content $content)
    {
        $this->content[] = $content;
    }

    /**
     * Get content
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getContent()
    {
        return $this->content;
    }
}

