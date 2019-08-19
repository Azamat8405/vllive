<?php
// src/Controller/SourcesController.php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;

class SourcesController
{
    public function list()
    {

//        http://parliament-osetia.ru/rss
//        https://rso-government.org/feed/

        $number = random_int(0, 100);

        return new Response(
            '<html><body>Lucky number: '.$number.'</body></html>'
        );
    }
}