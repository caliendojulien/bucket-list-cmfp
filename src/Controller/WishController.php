<?php

namespace App\Controller;

use App\Entity\Wish;
use App\Repository\WishRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/wish', name: 'wish')]
class WishController extends AbstractController
{
    #[Route('/', name: '_wishes')]
    public function wishes(
        WishRepository $wishRepository
    ): Response
    {
        $wishes = $wishRepository->findBy([], ['dateCreated' => 'DESC']);
        return $this->render(
            'wish/wishes.html.twig',
            [
                "wishes" => $wishes
            ]
        );
    }

    #[Route('/{wish}', name: '_wish')]
    public function wish(
        Wish $wish
    ): Response
    {
        return $this->render(
            'wish/wish.html.twig',
            compact('wish')
        );
    }
}
