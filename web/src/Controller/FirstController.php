<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use function Symfony\Component\String\u;

class FirstController extends AbstractController {

    /**
     * @return Response
     */
    #[Route('/')]
    final public function homepage(): Response {

        $tracks = [
            ['song' => 'skfdsoifdsoihfdsoi', 'artist' => 'jsoijdsqojidsqoijodq pq'],
            ['song' => 'qsd qs dsq q', 'artist' => 'fddfgfgfdgfdgfdg654g9d84fg9d84 pq'],
            ['song' => 'skfdsoifdqs', 'artist' => 'dfh dfhdf d fh dhd pq'],
            ['song' => 'sffdh hddh', 'artist' => 'dfhd dfh pq'],
        ];

        dump($tracks);

        return $this->render('first/homepage.html.twig', [
            'title' => 'Coucou',
            'tracks' => $tracks,
        ]);
    }

    /**
     * @param string $genre
     * @return Response
     */
    #[Route('/browse/{genre}')]
    final public function browse(string $genre = ''): Response {
        return $this->render('first/browse.html.twig', [
            'genre' => $genre ? u(str_replace('-', ' ', $genre))->title() : null,
        ]);
    }
}
