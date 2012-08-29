<?php
namespace Chewbacca\SitemapBundle\Services;
use Symfony\Component\Routing\RouterInterface;
use Chewbacca\SitemapBundle\Generator\SitemapGeneratorInterface;
class SitemapGeneratorChain
{
    private $router;
    private $generators = array();

    private $config;

    public function __construct(RouterInterface $router, array $config)
    {
        $this->config = $config;
        $this->router = $router;
    }

    public function addGenerator(SitemapGeneratorInterface $generator)
    {
        $generator->setRouter($this->getRouter());
        $this->generators[] = $generator;
    }

  public function getRouter()
  {
      return $this->router;
  }

    public function generate()
    {
        foreach ($this->generators as $generator) {
            $generator->generate();
        }
    }

    public function generateIndex()
    {
        // Create dom object
        $dom = new \DOMDocument('1.0', 'UTF-8');
        $dom->formatOutput = true;
        $dom->substituteEntities = false;

        // Create <urlset> root tag
        $sitemapindex = $dom->createElement('sitemapindex');

        // Add attribute of urlset
        $xmlns = $dom->createAttribute('xmlns');
        $sitemapindexText = $dom->createTextNode('http://www.sitemaps.org/schemas/sitemap/0.9');
        $sitemapindex->appendChild($xmlns);
        $xmlns->appendChild($sitemapindexText);
        foreach ($this->generators as $generator) {
            $sitemap = $dom->createElement('sitemap');
            $loc = $dom->createElement('loc');
            $loc->appendChild($dom->createTextNode($generator->getWebFilePath()));
            $sitemap->appendChild($loc);
            $lastmod = $dom->createElement('lastmod');
            $lastmod->appendChild($dom->createTextNode(date('Y-m-d')));
            $sitemap->appendChild($lastmod);
            $sitemapindex->appendChild($sitemap);
        }
        $dom->appendChild($sitemapindex);

        return $dom->save($this->config['file_path']);
    }
}
