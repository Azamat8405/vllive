<?php
// src/Controller/SourcesController.php
namespace App\Controller;

use App\Entity\SourcesData;
use App\Service\Rss2Reader;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class SourcesController extends AbstractController
{
    public function list()
    {
        // вы можете извлечь EntityManager через $this->getDoctrine()
        // или вы можете добавить аргумент в ваше действие: index(EntityManagerInterface $em)
        $em = $this->getDoctrine()->getManager();

        $sourceData = $this->getDoctrine()->getRepository(SourcesData::class);

//        http://parliament-osetia.ru/rss
//        https://rso-government.org/feed/

        $entities = '';
        $last_news = $sourceData->findAll();
        foreach($last_news as $item){

            $entities .= '<img width="300" src="'.$item->getImage().'" style="float:left;"/>';
            $entities .= '<div>'.date('d.m.Y H:i:s', $item->getDate()).'</div>';
            $entities .= '<div>'.$item->getTitle().'</div>';
            $entities .= '<div>'.$item->getDescription().'</div>';
            $entities .= '<div style="clear:both;"></div>';
        }
        return new Response(
            '<html><body>'.$entities.'</body></html>'
        );
    }
}