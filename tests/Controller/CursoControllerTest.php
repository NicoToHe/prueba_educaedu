<?php

namespace App\Tests\Controller;

use ApiPlatform\Symfony\Bundle\Test\ApiTestCase;
use App\Entity\Curso;
use Doctrine\ORM\EntityManager;

class CursoControllerTest extends ApiTestCase
{
    private EntityManager $entityManager;

    public function setUp(): void
    {
        $kernel = self::bootKernel();
        $this->entityManager = $kernel->getContainer()->get('doctrine')->getManager();
    }

    public function testCursoShowValid(): void
    {
        $curso = new Curso();
        $curso->setTitulo('titulo');
        $curso->setDescripcion('descripcion');
        $curso->setPrecio(4);

        $this->entityManager->persist($curso);
        $this->entityManager->flush();
       
        $id = $curso->getId();

        static::createClient()->request('GET', '/curso/'.$id);

        $this->assertResponseIsSuccessful();
        $this->assertJsonContains(
            [
                'id' => $id,
                'titulo' => 'titulo',
                'descripcion' => 'descripcion',
                'precio' => 4,
                'opiniones' => [],
                'top' => false
            ]);
    }

    public function testCursoShowInvalid(): void
    {
        static::createClient()->request('GET', '/curso/65890');

        $this->assertResponseStatusCodeSame(404);
    }
}
