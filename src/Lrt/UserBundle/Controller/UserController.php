<?php

namespace Lrt\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class UserController extends Controller
{
    public function loginAction()
    {
        return $this->render('UserBundle:User:login.html.twig');
    }
}
