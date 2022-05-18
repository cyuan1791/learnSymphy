<?php

namespace App\Controller;

use App\Entity\Dish;
use App\Repository\DishRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/dish', name:'dish.')]
class DishController extends AbstractController
{
    public function __construct(private ManagerRegistry $doctrine)
    {
        $this->doctrine = $doctrine;
    }

    #[Route('/', name:'show')]
function index(DishRepository $dr): Response
    {
        $dishes = $dr->findAll();
    return $this->render('dish/index.html.twig', [
        'dishes' => $dishes,
    ]);
}

#[Route('/create', name:'create')]
function create(Request $request)
    {
    $dish = new Dish();
    $dish->setName('Pizza');

    $em = $this->doctrine->getManager();
    $em->persist($dish);
    $em->flush();
    return new Response('good');
}

}
