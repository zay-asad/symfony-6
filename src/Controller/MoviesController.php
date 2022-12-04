<?php

namespace App\Controller;

use App\Entity\Actor;
use App\Entity\Movie;
use App\Form\MovieFormType;
use App\Repository\MovieRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

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
    
    //create a new movie
    #[Route('/movies/create', name: 'create_movie')]
    public function create(Request $request): Response
    {
        $movie = new Movie;
        $form = $this->createForm(MovieFormType::class, $movie);

        //access values that user submits through the form.
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $newMovie = $form->GetData();
            // dd(newMovie);
            // exit;
            $imagePath = $form->get('imagePath')->getData();
            if($imagePath) {
                $newFileName = uniqid() . '.' . $imagePath->guessExtension();

                try {
                    $imagePath->move( //move image path
                        $this->getParameter('kernel.project_dir') . '/public/uploads', 
                        $newFileName
                );
            } catch (FileException $e) {
                return new Response ($e->getMessage());
            }
            $newMovie->setImagePath('/uploads/' . $newFileName);
        }

        $this->em->persist($newMovie); //persist & flush
        $this->em->flush();
        return $this->redirectToRoute('movies');
    }

        return $this->render('movies/create.html.twig', [
            'form' => $form->createView()
        ]);

    }

    #[Route('/movies/edit/{id}', name: 'edit_movie')]
    public function edit($id, Request $request): Response 
    {
        $movie = $this->movieRepository->find($id);

        $form = $this->createForm(MovieFormType::class, $movie);

        $form->handleRequest($request);
        $imagePath = $form->get('imagePath')->getData();

        if ($form->isSubmitted() && $form->isValid()) {
            if ($imagePath) {
                if ($movie->getImagePath() !== null) {
                    if (file_exists(
                        $this->getParameter('kernel.project_dir') . $movie->getImagePath()
                        )) {
                            $this->GetParameter('kernel.project_dir') . $movie->getImagePath();
                    }
                    $newFileName = uniqid() . '.' . $imagePath->guessExtension();

                    try {
                        $imagePath->move(
                            $this->getParameter('kernel.project_dir') . '/public/uploads',
                            $newFileName
                        );
                    } catch (FileException $e) {
                        return new Response($e->getMessage());
                    }

                    $movie->setImagePath('/uploads/' . $newFileName);
                    $this->em->flush();

                    return $this->redirectToRoute('movies');
                }
            } else {
                $movie->setTitle($form->get('title')->getData());
                $movie->setReleaseYear($form->get('releaseYear')->getData());
                $movie->setDescription($form->get('description')->getData());

                $this->em->flush();
                return $this->redirectToRoute('movies');
            }
        }

        return $this->render('movies/edit.html.twig', [
            'movie' => $movie,
            'form' => $form->createView()
        ]);
    }

    #[Route('/movies/delete/{id}', methods:['GET', 'DELETE'], name: 'delete_movie')]
    public function delete($id): Response
    {
        //deleting entry
        $movie = $this->movieRepository->find($id);
        $this->em->remove($movie);
        $this->em->flush();

        //redirect to movies page
        return $this->redirectToRoute('movies');
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
