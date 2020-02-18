<?php
/**
 * Created by PhpStorm.
 * User: sandj
 * Date: 20/11/2019
 * Time: 08:21
 */

namespace App\Controller;


use App\Entity\Category;
use App\Service\RhService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class FrontController extends AbstractController
{
    private $rhService;

    public function __construct(RhService $rhService)
    {
        $this->rhService = $rhService;
    }

    /**
     * @Route("/", name="front_home")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index()
    {
        return $this->render('front/index.html.twig',[
            'controller_name' => 'FrontController',
        ]);
    }

    /**
     * @Route("/equipe", name="front_team", methods={"GET"})
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function team()
    {
        $date = new \DateTime();

        return $this->render('front/team.html.twig',[
            'controller_name' => 'FrontController',
            'equipe' => $this->rhService->getDayTeam($date->format('Y-m-d'))->toArray()['midi']
        ]);
    }

    /**
     * @Route("/carte", name="front_dishes", methods={"GET"})
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function dishes()
    {
        $repo = $this->getDoctrine()->getRepository(Category::class);
        $categories = $repo->findAll();

        return $this->render('front/carte.html.twig',[
            'controller_name' => 'FrontController',
            'categories' => $categories,
        ]);
    }

    /**
     * @Route("carte/{id}", name="front_dishes_category", methods={"GET"})
     */
    public function front_dishes_category($id)
    {
        $repo = $this->getDoctrine()->getRepository(Category::class);
        $category = $repo->find($id);

        if($category){
            return $this->render('front/category_detail.html.twig',[
                'controller_name' => 'FrontController',
                'categorie' => $category,
            ]);
        }

       throw new Exception("Category not found");
    }

    /**
     * @Route("mentions-legales", name="front_legales.html.twig", methods={"GET"})
     */
    public function front_legales(){

        return $this->render('front/mention_legales.html.twig',[
            'controller_name' => 'FrontController',
        ]);
    }
}