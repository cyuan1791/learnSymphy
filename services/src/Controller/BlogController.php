<?php
namespace App\Controller;

use App\Repository\MicroPostRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BlogController extends AbstractController
{

    /**
     * @Route("/", "blog_index")
     */
    public function index(MicroPostRepository $microRepository): Response
    {

        $posts = $microRepository->findAll();

        return $this->render('base.html.twig', ['posts' => $posts]);
    }
}
