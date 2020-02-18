<?php
/**
 * Created by PhpStorm.
 * User: sandj
 * Date: 15/01/2020
 * Time: 16:57
 */

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class BlockController extends AbstractController
{
    public function dayDishesAction($max = 3)
    {
        // make a database call or other logic
        // to get the "$max" sticky dishes
        /*return $this->render(
            'Partials/day_dishes.html.twig',
            array('dishes' => $dishes)
        );*/
    }
}