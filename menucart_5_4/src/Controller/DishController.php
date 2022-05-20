<?php

namespace App\Controller;

use App\Entity\Dish;
use App\Form\DishType;
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

    #[Route('/', name:'list')]
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
    $form = $this->createForm(DishType::class, $dish);
    $form->handleRequest($request);

    if ($form->isSubmitted()) {
        //$image = $request->files->get('image');
        $image = $form->get('image')->getData();
        if ($image) {
            //https: //symfony.com/doc/5.4/controller/upload_file.html
            $datetime = md5(uniqid()) . '.' . $image->guessClientExtension();

            $image->move(
                $this->getParameter('image_folder'),
                $datetime
            );
            $dish->setImage($datetime);
        }
        $em = $this->doctrine->getManager();
        $em->persist($dish);
        $em->flush();
        return $this->redirect($this->generateUrl('dish.show'));
    }

    return $this->render('dish/create.html.twig', [
        'createForm' => $form->createView(),
    ]);

}
#[Route('/delete/{id}', name:'delete')]
function delete($id, DishRepository $dr)
    {
    $dish = $dr->find($id);
    $em = $this->doctrine->getManager();
    $em->remove($dish);
    $em->flush();

    // message
    $this->addFlash('success', 'Sussesfuly delete ');
    return $this->redirect($this->generateUrl('dish.show'));

}
#[Route('/show/{id}', name:'show')]
function show(Dish $dish)
    {
    //var_dump($dish->id);
    return $this->render('dish/show.html.twig', [
    'dish' => $dish,
]);

}

}
