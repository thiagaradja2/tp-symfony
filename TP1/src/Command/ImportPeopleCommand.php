<?php
/**
 * Created by PhpStorm.
 * User: sandj
 * Date: 12/02/2020
 * Time: 17:05
 */

namespace App\Command;


use App\Entity\User;
use App\Service\RhService;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\HttpClient\HttpClient;

class ImportPeopleCommand extends ContainerAwareCommand
{
    protected static $defaultName = 'restau:people:import';

    private $em;
    private $rhService;
    public function __construct(EntityManagerInterface $em, RhService $rhService)
    {
        parent::__construct();
        $this->em = $em;
        $this->rhService = $rhService;
    }

    protected function configure()
    {

    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $date = new DateTime();
        $this->rhService->getDayTeam($date->format('Y-m-d'));

    }
}