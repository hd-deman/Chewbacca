<?php
namespace Chewbacca\SitemapBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class SitemapsGenerateCommand extends ContainerAwareCommand
{

    protected function configure()
    {
        parent::configure();

        $this->setName('chewbacca:sitemap:generate')
             ->setDescription('Generate sitemaps files.');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $host = $this->getContainer()->getParameter('host');
        $generator = $this->getContainer()->get('chewbacca_sitemap.generator_chain');
        $generator->getRouter()->getContext()->setHost($host);
        $generator->generate();
        $generator->generateIndex();
    }

}
