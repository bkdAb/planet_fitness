<?php

namespace App\Tests\Repository;

use App\Entity\User;
use DateTime;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Exception\ORMException;
use Doctrine\ORM\OptimisticLockException;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class UserRepositoryTest extends KernelTestCase
{
    /**
     * @var EntityManager
     */
    private $entityManager;

    /**
     * @return void
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function testSearchUserByEmail(): void
    {
        $user = $this->entityManager
            ->getRepository(User::class)
            ->findOneBy(['email' => 'non-existant-user@email.com']);

        $this->assertSame(null, $user);

        $user = new User();
        $user->setEmail('existant-user@gmail.com')
            ->setFirstName('test user')
            ->setLastName('test user')
            ->setBirthDate(new DateTime());

        $this->entityManager->persist($user);
        $this->entityManager->flush();

        $user = $this->entityManager
            ->getRepository(User::class)
            ->findOneBy(['email' => 'existant-user@gmail.com']);

        $this->assertSame('test user', $user->getFirstName());
    }

    /**
     * @return void
     */
    protected function setUp(): void
    {
        $kernel = self::bootKernel();

        $this->entityManager = $kernel->getContainer()
            ->get('doctrine')
            ->getManager();
    }

    /**
     * @return void
     */
    protected function tearDown(): void
    {
        parent::tearDown();

        $this->entityManager->close();
        $this->entityManager = null;
    }
}