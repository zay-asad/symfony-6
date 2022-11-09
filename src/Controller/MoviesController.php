<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class MoviesController extends AbstractController
{
    /** passing in a route parameter for my controller /movies/{name}
     *  I've also assigned a default parameter in case we just type /movies in the browser -> null
     *  I've also assigned a GET, HEAD as methods -> these can be viewed by checking the `symfony console debug:router`
     */


    #[Route('/movies/{name}', name: 'movies', defaults: ['name'=> null] ,methods: ['GET', 'HEAD'])]
    public function index($name): JsonResponse
    {
        return $this->json([
            'message' => $name,
            'path' => 'src/Controller/MoviesController.php',
        ]);
    }
}
