<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/")
 */
class UserController extends AbstractController
{
    /**
     * @Route("/", name="user_new", methods={"GET", "POST"})
     */
    public function index(Request $request): Response
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);
        $response = new JsonResponse();

        // AJAX-based validation
        if (
            $request->isXmlHttpRequest() &&
            $form->isSubmitted() &&
            !$form->isValid()
        ) {
            $response->setData([
                'status' => 'Error',
                'message' => $this->getErrorMessages($form),
            ]);
            $response->setStatusCode(Response::HTTP_BAD_REQUEST);

            return $response;
        }

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            if ($request->isXmlHttpRequest()) {
                $response->setData([
                    'status' => 'success',
                    'message' => [
                        'redirect' => $this->generateUrl('user_login'),
                    ],
                ]);

                return $response;
            } else {
                return $this->redirectToRoute('user_login');
            }
        }

        return $this->render('user/new.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/login", name="user_login", methods={"GET", "POST"})
     */
    public function login(Request $request): Response
    {
        return new JsonResponse(['status' => 'OK', 'message' => 'to be added']);
    }

    /**
     * @Route("/user/{id}", name="user_profile", methods={"GET"})
     */
    public function show(User $user): Response
    {
        return $this->render('user/show.html.twig', [
            'user' => $user,
        ]);
    }

    /**
     * @Route("/users", name="user_list", methods={"GET"})
     */
    public function list(UserRepository $userRepository): Response
    {
        return $this->render('user/list.html.twig', [
            'users' => $userRepository->findAll(),
        ]);
    }

    protected function getErrorMessages(Form $form)
    {
        $errors = [];
        // get error(s) in root form
        foreach ($form->getErrors() as $key => $error) {
            $errors[] = $error->getMessage();
        }
        // get error(s) in each input
        foreach ($form->all() as $input) {
            if (!$input->isValid()) {
                $errors[$input->getName()] = $this->getErrorMessages($input);
            }
        }

        return $errors;
    }
}
