<?php

namespace App\Controller;

use App\Entity\Actor;
use App\Entity\Movie;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\MovieRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MoviesController extends AbstractController
{
    /** passing in a route parameter for my controller /movies/{name}
     *  I've also assigned a default parameter in case we just type /movies in the browser -> null
     *  I've also assigned a GET, HEAD as methods -> these can be viewed by checking the `symfony console debug:router`
     */


//    --- OLD METHOD ---
//    #[Route('/movies/{name}', name: 'movies', defaults: ['name'=> null] ,methods: ['GET', 'HEAD'])]
//    public function index($name): JsonResponse
//    {
//        return $this->json([
//            'message' => $name,
//            'path' => 'src/Controller/MoviesController.php',
//        ]);
//    }


//   --- NEW METHOD (rendering view using TWIG, needs to be intalled via terminal) ---

    // #[Route('/movies', name: 'movies')]
    // public function index(): Response
    // {
    //     $movies = ["avengers: endgame", "movie2", "movie3", "movie4"];

    //     return $this->render('index.html.twig', array(
    //         'movies' => $movies
    //     ));
    // }
    
    //setting a new property for EntityManager
    private $em;

    //connecting to movieRepository
    private $movieRepository;

    public function __construct(EntityManagerInterface $em, MovieRepository $movieRepository)
    {
        $this->em = $em;
        $this->movieRepository = $movieRepository;
    }


    // all movies route
    #[Route('/movies', methods: ['GET'], name: 'movies')]
    public function index(): Response
    {
        // $repository = $this->em->getRepository(Movie::class);
        // // $movies = $repository->getClassName();
        // //find all movies from the repository
        // $movies = $repository->findAll();

        // //similar to var dump - dump&die helper function
        // dd($movies);

        $movies = $this->movieRepository->findAll();

        return $this->render('movies/index.html.twig', [
            'movies' => $movies
        ]);
    }

    //single movie route
    #[Route('/movies/{id}', methods: ['GET'], name: 'show_movie')]
    public function show($id): Response
    {
        $movie = $this->movieRepository->find($id);
        
        return $this->render('movies/show.html.twig', [
            'movie' => $movie
        ]);
    }
}
