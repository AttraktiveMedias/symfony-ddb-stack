<?php

namespace App\Controller;

use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SongController extends AbstractController {

    /**
     * @param int $id
     * @return Response
     */
    #[Route('/api/song/{id<\d+>}', methods: ['GET'])]
    final public function getSong(int $id, LoggerInterface $logger): Response {

        $song = [
            'id' => $id,
            'name' => 'psqpdji odsifh o',
            'url' => 'https://sodsdsjfoids',
        ];

        $logger->alert('Returning API response for song {song}', [
            'song' => $id,
        ]);

        //return new JsonResponse($song); // the same
        return $this->json($song);
    }

}