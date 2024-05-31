<?php

namespace App\Controller;

use FOS\RestBundle\Controller\AbstractFOSRestController;
use Symfony\Component\HttpFoundation\JsonResponse;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\Routing\Attribute\Route;

class EventController extends AbstractFOSRestController
{
  #[Rest\Get('/events', name:"getEvents")]
  public function getEventsAction() :JsonResponse
  {
    return $this->json([
      'message' => 'Welcome to your get Events controller!',
      'path' => 'src/Controller/EventController.php',
    ]);
  }
  #[Rest\Get('/events/{id}', name:"getEvent")]
  public function getEventAction(int $id) :JsonResponse
  {
    return $this->json([
      'message' => 'Welcome to your get Event controller!',
      'path' => 'src/Controller/EventController.php',
    ]);
  }

  #[Rest\Post('/events', name:"postEvent")]
  public function postEventAction() :JsonResponse
  {
    return $this->json([
      'message' => 'Welcome to your post controller!',
      'path' => 'src/Controller/EventController.php',
    ]);
  }
}
