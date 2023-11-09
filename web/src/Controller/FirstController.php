<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use function Symfony\Component\String\u;

class FirstController {

    /**
     * @return Response
     */
    #[Route('/')]
    final public function homepage(): Response {
        return new Response('<h1>Yo</h1><p>Ceci est un contenu</p>');
    }

    /**
     * @param string $genre
     * @return Response
     */
    #[Route('/browse/{genre}')]
    final public function browse(string $genre = ''): Response {
        if ($genre) {
            $title = u(str_replace('-', ' ', $genre))->title();
        } else {
            $title = "All genres";
        }
        return new Response($title);
    }
}
