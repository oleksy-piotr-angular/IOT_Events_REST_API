<?php

namespace App\Controller;

use FOS\RestBundle\Controller\AbstractFOSRestController;
use Symfony\Component\HttpFoundation\JsonResponse;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\Routing\Attribute\Route;

class EventController extends AbstractFOSRestController
{
    #[Route('/event', name: 'app_event')]
    public function index(): JsonResponse
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/EventController.php',
        ]);
    }
    #[Rest\Post('/post', name:"app_event_update")]
    public function post()
    {
      return $this->json([
        'message' => 'Welcome to your post controller!',
        'path' => 'src/Controller/EventController.php',
    ]);
    }
}
