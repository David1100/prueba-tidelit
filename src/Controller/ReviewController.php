<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\BookRepository;
use App\Entity\Review;

final class ReviewController extends AbstractController
{
    #[Route('/api/review', name: 'app_review', methods: ['POST'])]
    public function create(
        Request $request,
        BookRepository $bookRepository,
        EntityManagerInterface $em
    ): JsonResponse {
        
        // Convertir JSON a array
        $data = json_decode($request->getContent(), true);

        $errors = [];

        // --- VALIDACIONES ---
        
        if (!$data) {
            return new JsonResponse(['error' => 'Invalid JSON'], 400);
        }
        
        if (!isset($data['rating'])) {
            $errors['rating'] = 'El rating es requerido.';
        } elseif (!is_int($data['rating']) || $data['rating'] < 1 || $data['rating'] > 5) {
            $errors['rating'] = 'El rating debe ser un número entero entre 1 y 5.';
        }

        if (!isset($data['comment']) || trim($data['comment']) === '') {
            $errors['comment'] = 'El comentario no puede estar vacío.';
        }

        if (!empty($errors)) {
            return new JsonResponse(['errors' => $errors], 400);
        }
        // Buscar el libro
        $book = $bookRepository->find($data['book_id']);

        if (!$book) {
            return new JsonResponse(['error' => 'El libro especificado no existe.'], 404);
        }

        // Crear la Review
        $review = new Review();
        $review->setBook($book);
        $review->setRating($data['rating']);
        $review->setComment($data['comment']);
        $review->setCreatedAt(new \DateTimeImmutable());

        // Guardar en BD
        $em->persist($review);
        $em->flush();

        return new JsonResponse([
            'message' => 'Review created successfully',
            'review_id' => $review->getId()
        ], 201);
    }
}
