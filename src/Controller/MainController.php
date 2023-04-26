<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    #[Route('/', name: 'main_index')]
    public function index(): Response
    {
        return $this->render('main/index.html.twig'        );
    }

    #[Route('/about-us', name: 'main_about_us')]
    public function about_us(): Response
    {
        $fichier = file_get_contents('../data/team.json');
        $equipe = json_decode($fichier, true);
        return $this->render(
            'main/about_us.html.twig',
            compact('equipe')
        );
    }

//#[Route('/about-us', name: 'main_about_us')]
//public function about_us(): Response
//{
//    return $this->render(
//        'main/about_us.html.twig',
//        [
//            "equipe" => json_decode(file_get_contents('../data/team.json'), true)
//        ]
//    );
//}
}
