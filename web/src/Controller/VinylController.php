<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use function Symfony\Component\String\u;

class VinylController extends AbstractController {

    /**
     * @return Response
     */
    #[Route('/', name: 'app_homepage')]
    final public function homepage(): Response {

        $tracks = [
            ['song' => 'skfdsoifdsoihfdsoi', 'artist' => 'jsoijdsqojidsqoijodq pq'],
            ['song' => 'qsd qs dsq q', 'artist' => 'fddfgfgfdgfdgfdg654g9d84fg9d84 pq'],
            ['song' => 'skfdsoifdqs', 'artist' => 'dfh dfhdf d fh dhd pq'],
            ['song' => 'sffdh hddh', 'artist' => 'dfhd dfh pq'],
        ];

        dump($tracks);

        return $this->render('vinyl/homepage.html.twig', [
            'title' => 'Bienvenue sur Mixed Vinyl !',
            'tracks' => $tracks,
        ]);
    }

    /**
     * @param string $genre
     * @return Response
     */
    #[Route('/browse/{genre}', name: 'app_browse')]
    final public function browse(string $genre = ''): Response {
        return $this->render('vinyl/browse.html.twig', [
            'genre' => $genre ? u(str_replace('-', ' ', $genre))->title() : null,
        ]);
    }
}
