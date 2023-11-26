<?php

namespace App\Controller;

use App\Repository\CursoRepository;
use App\Entity\Opinion;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class CursoController extends AbstractController
{
    #[Route('/curso/{id}', name: 'show_curso')]
    public function show(CursoRepository $cursoRepository, int $id): JsonResponse
    {
        $curso = $cursoRepository->find($id);

        if (!$curso) {
            throw $this->createNotFoundException(
                'No se ha encontrado un curso con id '.$id
            );
        }

        return $this->json(            
            [
                'id' => $curso->getId(),
                'titulo' => $curso->getTitulo(),
                'descripcion' => $curso->getDescripcion(),
                'precio' => $curso->getPrecio(),
                'opiniones' => $curso->getOpiniones()->map(function(Opinion $opinion){
                    return [
                        'usuario' => $opinion->getUsuario(),
                        'comentario' => $opinion->getComentario(),
                        'valoracion' => $opinion->getValoracion(),
                    ];
                })->toArray(),
                'top' => $curso->getIsTop()
            ]
        );
    }
}
