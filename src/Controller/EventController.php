<?php

namespace App\Controller;

use FOS\RestBundle\Controller\AbstractFOSRestController;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\Request;

class EventController extends AbstractFOSRestController
{

  #[Rest\Post('/event', name: "postEvent")]
  public function postEventAction(Request $request)
  {
    $json_data = json_decode($request->getContent(), true);
    $deviceId = $json_data['deviceId'];
    $eventDate = $json_data['eventDate'];
    $type = $json_data['type'];
    $evtData = $json_data['evtData'];

    if (is_string($deviceId) && isValidTimeStamp($eventDate)  && is_string(($type))) {
      $data = [
        'deviceId' => $deviceId,
        'eventDate' => $eventDate,
        'type' => $type
      ];
      if ($type == 'deviceMalfunction') {
        if (is_int($evtData['reasonCode']) && is_string($evtData['reasonText'])) {
          $data['evtData'] = $evtData;
          echo 'Event log, sending e-mail and text message';
        } else {
          $data['evtData'] = [
            "reasonCode" => 'Should be an integer',
            "reasonText" => 'Should be a string'
          ];
          return $this->view($data, statusCode: Response::HTTP_BAD_REQUEST);
        }
      } elseif ($type == 'temperatureExceeded') {
        if (is_float($evtData['temp']) && is_float($evtData['treshold'])) {
          $data['evtData'] = $evtData;
          echo 'Event log and sending a REST request';
        } else {
          $data['evtData'] = [
            "temp" => 'Should be a float',
            "treshold" => 'Should be a float'
          ];
          return $this->view($data, statusCode: Response::HTTP_BAD_REQUEST);
        }
      } elseif ($type == 'doorUnlocked') {
        if (isValidTimeStamp($evtData['unlockDate'])) {
          $data['evtData'] = $evtData;
          echo 'Event log and text message';
        } else {
          $data['evtData'] = [
            "unlockDate" => 'Should be a timestamp'
          ];
          return $this->view($data, statusCode: Response::HTTP_BAD_REQUEST);
        }
      } else {
        return $this->view(['type' => 'Unknown event Type'], statusCode: Response::HTTP_BAD_REQUEST);
      }
      return $this->view($data, statusCode: Response::HTTP_OK);
    }

    if (!is_string($deviceId)) $data['deviceId'] = 'Should be a string';
    if (!isValidTimeStamp($eventDate)) $data['eventDate'] = 'Should be a timestamp';
    if (!is_string(($type))) $data['type'] = 'Should be a string';

    return $this->view(
      $data,
      statusCode: Response::HTTP_BAD_REQUEST
    );
  }
}

function isValidTimeStamp($timestamp)
{
  return (is_int($timestamp))
    && ($timestamp <= PHP_INT_MAX)
    && ($timestamp >= ~PHP_INT_MAX);
}
