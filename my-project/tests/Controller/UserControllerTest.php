<?php

namespace App\Tests\Controller;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class UserControllerTest extends WebTestCase
{

    public function testSiteNavigations(): void
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h2', 'Create User');

        $form = $crawler->selectButton('Create user')->form([
            'user[email]' => 'Ryan@test.com',
            'user[firstName]' => 'Ryan',
            'user[lastName]' => 'Ryan',
            'user[birthdate]' => '01/01/2000',
        ]);

        $client->submit($form);

        $employeeRepository = $this->createMock(UserRepository::class);

        $employeeRepository->expects($this->any())
            ->method('findBy')
            ->with(['email' => 'Ryan@test.com'])
            ->willReturn($form->get('user'));
    }
}