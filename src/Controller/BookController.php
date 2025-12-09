<?php

namespace App\Controller;
use App\Repository\BookRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class BookController extends AbstractController
{
    #[Route('/api/books', name: 'api_books', methods: ['GET'])]
    public function index(BookRepository $bookRepository): JsonResponse
    {
        $books = $bookRepository->findAllWithAverageRating();

        $formatted = [];

        foreach ($books as $row) {
            /** @var \App\Entity\Book $book */
            $book = $row[0];

            $formatted[] = [
                'id' => $book->getId(),
                'title' => $book->getTitle(),
                'author' => $book->getAuthor(),
                'published_year' => $book->getPublishedYear(),
                'average_rating' => $row['average_rating'] ?? null, // si no hay reviews
            ];
        }

        return new JsonResponse($formatted);
    }
}
