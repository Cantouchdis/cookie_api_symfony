<?php namespace App\Controller;

use App\Entity\Timestamp;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class TimestampController extends AbstractController
{
    public function saveTimestampToDb(Request $request): Response
    {
        $date = new \DateTime($request->get('date'));
        $entityManager = $this->getDoctrine()->getManager();

        $newTimestamp = new Timestamp();
        $newTimestamp->setTimestamp($date);

        $entityManager->persist($newTimestamp);

        $entityManager->flush();

        return new Response('saved to db');
    }

    public function getTimestamps(): Response
    {
        $timestamps = $this->getDoctrine()->getRepository(Timestamp::class)->findAll();

//        return new JsonResponse(['status' => 200, 'message' => 'success', 'result' => $timestamps]);
        return new Response(json_encode($timestamps));
    }
}
