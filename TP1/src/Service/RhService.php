<?php
/**
 * Created by PhpStorm.
 * User: sandj
 * Date: 12/02/2020
 * Time: 17:25
 */

namespace App\Service;


use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpClient\HttpClient;

class RhService
{
    private $logger;
    private $api_endpoint;
    private $em;

    /**
     * @param $api_endpoint
     */
    public function __construct(LoggerInterface $logger,EntityManagerInterface $em, string $api_endpoint)
    {
        $this->logger = $logger;
        $this->api_endpoint = $api_endpoint;
        $this->em = $em;
    }

    public function getPeople (){
        $client = httpClient::create();
        $response = $client->request('GET', 'http://15.188.47.204/?method=people');

        foreach ($response->toArray() as $value) {
            $user = new User();
            $user->setId($value['id']);
            $user->setFirstname($value['firstname']);
            $user->setLastname($value['lastname']);
            $user->setUsername($value['lastname'] . ' ' . $value['firstname']);
            $user->setEmail($value['email']);
            $user->setJobtitle($value['jobtitle']);
            $user->setEnabled(1);
            $this->em->persist($user);
        }
        $this->em->flush();
    }
    public function getDayTeam($date){
        $client = httpClient::create();
        $response = $client->request('GET', $this->api_endpoint.'?method=planning&date='. $date);
        return $response;
    }
}