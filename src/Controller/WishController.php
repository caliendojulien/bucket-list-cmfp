<?php

namespace App\Controller;

use App\Entity\Wish;
use App\Form\WishType;
use App\Repository\WishRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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

    #[Route('/ajouter', name: '_ajouter')]
    public function ajouter(
        EntityManagerInterface $entityManager,
        Request                $request
    ): Response
    {
        $wish = new Wish();
        $wishForm = $this->createForm(WishType::class, $wish);
        $wishForm->handleRequest($request);

        $wish->setDateCreated(new \DateTime());

        if ($wishForm->isSubmitted() && $wishForm->isValid()) {
            try {
                $entityManager->persist($wish);
                $entityManager->flush();
                $this->addFlash('ok', 'Le wish a été ajouté');
            } catch (\Exception $exception) {
                $this->addFlash('erreur', "Le wish n'a pas été ajouté");
            }
            return $this->redirectToRoute('wish_wishes');
        }

        return $this->render(
            'wish/ajouter.html.twig',
            compact('wishForm')
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
