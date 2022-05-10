<?php
namespace App\Controller;

use App\Service\Greeting;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BlogController extends AbstractController
{
    private $greeting;

    public function __construct(Greeting $greeting)
    {
        $this->greeting = $greeting;
    }
    /**
     * @Route("/", "blog_index")
     */
    public function index(Request $request): Response
    {

        $name = $request->get(key:'name');
        $message = $this->greeting->greeting($name);

        return $this->render('base.html.twig', ['message' => $message]);
    }
}
