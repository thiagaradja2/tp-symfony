<?php

namespace App\Controller;

use App\Entity\Allergen;
use App\Entity\Dish;
use App\Entity\User;
use App\Form\AllergenType;
use App\Form\DishType;
use App\Form\UserType;
use App\Repository\DishRepository;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin")
 */
class AdminController extends AbstractController
{
    /**
     * @Route("/", name="admin_index", methods={"GET"})
     */
    public function index(): Response
    {
        return $this->render('admin/index.html.twig');
    }

    /**
     * @Route("/equipe/inserer", name="admin_team_insert", methods={"GET"})
     */
    public function insererTeam(Request $request, EntityManagerInterface $manager)
    {
        $username = $request->query->get("usrname");
        $email = $request->query->get("email");
        $firstname = $request->query->get("firstname");
        $lastname = $request->query->get("lastname");
        $jobtitle = $request->query->get("jobtitle");

        $user = new User();
        $user->setUsername($username);
        $user->setEmail($email);
        $user->setFirstname($firstname);
        $user->setLastname($lastname);
        $user->setJobTitle($jobtitle);
        $user->setCreatedAt(new DateTime(date("Y-m-d H:i:s")));
        $user->setEnabled(true);

        $manager->persist($user);
        $manager->flush();

        return $this->render('front/team.html.twig',[
            'controller_name' => 'FrontController',
        ]);
    }
}
