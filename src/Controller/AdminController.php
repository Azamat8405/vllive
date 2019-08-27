<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class AdminController extends AbstractController
{
    public function dashboard()
    {

//        http://parliament-osetia.ru/rss
//        https://rso-government.org/feed/

//        Пресс-службы государственных и муниципальных учреждений.
//    Пресс-службы политических партий.
//    Пресс-службы коммерческих организаций.
//    Другие местные Интернет-СМИ.
//    Оффлайн-СМИ.
//    Платные ленты информагентств.
//    Местные форумы, блоги, группы в социальных сетях.
//    Ваши корреспонденты.

        // Администрации района, города, области, местные управления МВД, ФСБ, ФСКН, ФСИН, ФНС, ФМС, МЧС и других

        // https://habr.com/ru/post/288864/

        $number = random_int(0, 100);

        return $this->render('admin/base.html.twig', []);
    }
}