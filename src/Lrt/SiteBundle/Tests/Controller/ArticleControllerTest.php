<?php

namespace Lrt\SiteBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ArticleControllerTest extends WebTestCase
{
    public function testAddArticle() {

        $client = static::createClient();
        $crawler = $client->request('GET', '/article/new');

        $form = $crawler->selectButton('Ajouter')->form(array(
            'lrt_sitebundle_articletype[title]'  => 'Test',
            'lrt_sitebundle_articletype[content]'  => 'Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit..',
            'lrt_sitebundle_articletype[status]'  => 'IMMEDIATE',
            'lrt_sitebundle_articletype[isPublic]'  => 1,
            'lrt_sitebundle_articletype[category]'  => 1
        ));

        $client->submit($form);
    }

    public function testShowArticleWithIDReturn404() {

        $client = static::createClient();
        $client->request('GET', '/article/1/show');

        $this->assertEquals(404, $client->getResponse()->getStatusCode());
    }
}