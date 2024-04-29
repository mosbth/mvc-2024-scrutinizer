<?php

namespace Mos\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class SessionController extends AbstractController
{
    #[Route('/session', name: "session_index")]
    public function session(
        SessionInterface $session
    ): Response {
        $data = [
            'session' => $session->all()
        ];

        return $this->render('session/index.html.twig', $data);
    }

    #[Route("/api/session", name: "session_api")]
    public function sessionJson(
        SessionInterface $session
    ): Response {
        $data = [
            'session' => $session->all()
        ];

        $response = new JsonResponse($data);
        $response->setEncodingOptions(
            $response->getEncodingOptions() | JSON_PRETTY_PRINT
        );
        return $response;
    }

    #[Route("/session/clear", name: "session_clear")]
    public function clearSession(
        SessionInterface $session
    ): Response {
        $session->clear();

        return $this->redirectToRoute('session_index');
    }
}
