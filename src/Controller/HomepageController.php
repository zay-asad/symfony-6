<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomepageController extends AbstractController
{
    #[Route('/homepage', name: 'app_homepage')]

    public function index(): Response
    {
        //storing in variable
        $homepage = "Welcome from HomepageController.php!";

        return $this->render('homepage.html.twig', [
            'homepage' => $homepage
        ]);
    }
}