<?php
namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use App\Entity\Task;



class TaskControllerTest extends WebTestCase
{
    public function testShowPost()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/forms');

       
       // $this->assertSelectorTextContains('html head title', 'Welcome!');
       $form = $crawler->selectButton('Save')->form();
     //  var_dump($client->getResponse()->getContent());
       $form["task[task]"]='reading';
      $form["task[dueDate]"]='2nd Jan,2021';
       $client->submit($form);
     
       $this->assertEquals(200, $client->getResponse()->getStatusCode());
       $this->assertGreaterThan(0, $crawler->filter('h1')->count());

    }
}