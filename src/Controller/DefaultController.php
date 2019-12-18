<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/")
 */
class DefaultController extends AbstractController
{

    /**
     * TODO: something else
     * 
     * @Route("/", name="home", methods={"GET"})
     */
    public function index(Request $request): Response
    {
        return $this->redirectToRoute('user_add');
    }

    /**
     * TODO: move from here
     * @Route("/login", name="auth_login", methods={"GET", "POST"})
     */
    public function login(Request $request): Response
    {
        return new JsonResponse(['status' => 'OK', 'message' => 'to be added']);
    }

}
