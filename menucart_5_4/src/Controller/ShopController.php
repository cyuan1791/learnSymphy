<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ShopController extends AbstractController
{
    #[Route('/a', name:'home')]
function index(): Response
    {
    return $this->render('shop/index.html.twig', [
        'controller_name' => 'ShopController',
    ]);
}
}
