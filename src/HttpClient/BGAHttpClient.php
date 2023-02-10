<?php

namespace App\HttpClient;

use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class BGAHttpClient extends AbstractController {

     /**
      * @var HttpClientInterface
      */

     private $httpClient;

     /**
      * BGAHttpClient constructor.
      *     
      * @param HttpClientInterface $bga     
      */

    public function __construct(HttpClientInterface $bga)
    {
        $this->httpClient = $bga;
    }

    public function getGames($search){

        $client_id = $this->getParameter('client_id');
        $response = $this->httpClient->request('GET', "/api/search?name=$search&client_id=$client_id&limit=50", [
            'verify_peer' => false, 
        ]);
        //dd($response->getContent());
        return $response->getContent();       
    }

    public function getGame($search){

        $client_id = $this->getParameter('client_id');
        $response = $this->httpClient->request('GET', "/api/search?ids=$search&pretty=true&client_id=$client_id", [
            'verify_peer' => false,
        ]);
        return $response->getContent();
    }

}
?>