<?php
// src/Controller/SourcesController.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class IndexController extends AbstractController
{
    public function index()
    {

//        http://parliament-osetia.ru/rss
//        https://rso-government.org/feed/

        $number = random_int(0, 100);

        return new Response(
            '<html><body><a href="/sources/">Источники</a></body></html>'
        );
    }
}