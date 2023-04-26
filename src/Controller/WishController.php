<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/wish', name: 'wish')]
class WishController extends AbstractController
{
    #[Route('/', name: '_wishes')]
    public function wishes(): Response
    {
        return $this->render('wish/wishes.html.twig');
    }

    /**
     * Méthode qui retourne un seul wish
     *
     * @author Caliendo Julien
     * @param $id
     * @return Response
     */
    #[Route('/{id}', name: '_wish')]
    public function wish($id): Response
    {
        return $this->render('wish/wish.html.twig');
    }
}
