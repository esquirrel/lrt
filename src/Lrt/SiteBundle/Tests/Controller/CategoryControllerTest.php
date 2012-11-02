<?php

namespace Lrt\SiteBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CategoryControllerTest extends WebTestCase
{
    public function testAddCategory() {

        $client = static::createClient();
        $crawler = $client->request('GET', '/category/new');

        $form = $crawler->selectButton('Create')->form(array(
            'lrt_sitebundle_categorytype[name]'  => 'Test',
        ));

        $client->submit($form);
    }
}