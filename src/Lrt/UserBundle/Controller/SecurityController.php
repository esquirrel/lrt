<?php

namespace Longchamp\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\RedirectResponse;

use FOS\UserBundle\Controller\SecurityController as BaseController;

use Lrt\UserBundle\Entity\User;

class SecurityController extends BaseController
{
    public function loginAction()
    {
        $response = parent::loginAction();

        return $response;
    }

    public function getName()
    {
        return 'fos_user_security_login';
    }
}
