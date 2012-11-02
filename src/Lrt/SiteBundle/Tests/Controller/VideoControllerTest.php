<?php

namespace Lrt\SiteBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class VideoControllerTest extends WebTestCase
{
    public function testAddVideo() {

        $client = static::createClient();
        $crawler = $client->request('GET', '/video/new');

        $form = $crawler->selectButton('Create')->form(array(
            'lrt_sitebundle_videotype[title]'  => 'Test',
            'lrt_sitebundle_videotype[description]'  => 'Test',
            'lrt_sitebundle_videotype[vimeoId]' => 12341,
            'lrt_sitebundle_videotype[isAutoPlay]' => 1,
            'lrt_sitebundle_videotype[isPublished]' => 1,
            'lrt_sitebundle_videotype[isPublic]' => 1,
            'lrt_sitebundle_videotype[isHighlighted]' => 1,
        ));

        $client->submit($form);
    }

    /*
    public function testCompleteScenario()
    {
        // Create a new client to browse the application
        $client = static::createClient();

        // Create a new entry in the database
        $crawler = $client->request('GET', '/video/');
        $this->assertTrue(200 === $client->getResponse()->getStatusCode());
        $crawler = $client->click($crawler->selectLink('Create a new entry')->link());

        // Fill in the form and submit it
        $form = $crawler->selectButton('Create')->form(array(
            'lrt_sitebundle_videotype[field_name]'  => 'Test',
            // ... other fields to fill
        ));

        $client->submit($form);
        $crawler = $client->followRedirect();

        // Check data in the show view
        $this->assertTrue($crawler->filter('td:contains("Test")')->count() > 0);

        // Edit the entity
        $crawler = $client->click($crawler->selectLink('Edit')->link());

        $form = $crawler->selectButton('Edit')->form(array(
            'lrt_sitebundle_videotype[field_name]'  => 'Foo',
            // ... other fields to fill
        ));

        $client->submit($form);
        $crawler = $client->followRedirect();

        // Check the element contains an attribute with value equals "Foo"
        $this->assertTrue($crawler->filter('[value="Foo"]')->count() > 0);

        // Delete the entity
        $client->submit($crawler->selectButton('Delete')->form());
        $crawler = $client->followRedirect();

        // Check the entity has been delete on the list
        $this->assertNotRegExp('/Foo/', $client->getResponse()->getContent());
    }

    */
}