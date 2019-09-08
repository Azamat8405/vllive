<?php

namespace App\Command;

use App\Entity\SourcesData;
use App\Service\Rss2Reader;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\DependencyInjection\ContainerInterface;


class SourcesGrabberCommand extends Command
{
    protected static $defaultName = 'SourcesGrabber';

    private $container;

    public function __construct(ContainerInterface $container)
    {
        parent::__construct();
        $this->container = $container;
    }

    protected function configure()
    {
        $this
            ->setDescription('Сборщик информации от Источников.')
//            ->addArgument('arg1', InputArgument::OPTIONAL, 'Argument description')
//            ->addOption('option1', null, InputOption::VALUE_NONE, 'Option description')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);
//        $arg1 = $input->getArgument('arg1');
//
//        if ($arg1) {
//            $io->note(sprintf('You passed an argument: %s', $arg1));
//        }
//
//        if ($input->getOption('option1')) {
//            // ...
//        }

        //  php bin/console SourcesGrabber

        $em = $this->container->get('doctrine')->getManager();

        $sourceData = $this->container->get('doctrine')->getRepository(SourcesData::class);

//        http://parliament-osetia.ru/rss
//        https://rso-government.org/feed/

        $reader = new Rss2Reader('http://parliament-osetia.ru/rss');
        foreach($reader->getChannel() as $item){
            $exist = $sourceData->findByTitle($item->title);
            if($exist){
                continue;
            }

            $entity = new SourcesData();
            $entity->setTitle($item->title);
            $entity->setDate( strtotime($item->date));
            $entity->setDescription($item->description);
            $entity->setImage($item->image->url);

            $em->persist($entity);
            $em->flush();

        }



        $io->success('You have a new command! Now make it your own! Pass --help to see your options.');
    }
}
