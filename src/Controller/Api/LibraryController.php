<?php

namespace App\Controller\Api;

use App\Entity\Book;
use App\Repository\BookRepository;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class LibraryController extends AbstractController 
{

    #[Route('list', name: 'library_list')]
    public function list(Request $request, LoggerInterface $logger, BookRepository $bookRepository): JsonResponse
    {

        $logger->info('List action called up');
        $books = $bookRepository->findAll();
        $booksAsArray = [];
        foreach ($books as $book) {
            $booksAsArray[] = [
                'id'=> $book->getId(),
                'title' => $book->getTitle(),
                'image'=> $book->getImage(),
            ];
        }
        $response = new JsonResponse();
        $response->setData([
            'success' => true,
            'data' => $booksAsArray
        ]);
        return $response;
    }


    #[Route('book', name: 'create_book')]
    public function createBook(Request $request, EntityManagerInterface $em): JsonResponse{
        $book = new Book();
        $response = new JsonResponse();

        $title = $request->get('title', null);
        if(empty($title)){
            $response->setData([
               'success' => false,
               'error' => 'Title is required',
               'data' => null
            ]);
        }
        
        $book->setTitle($title);
        $em->persist($book);
        $em->flush();

        $response->setData([
            'success' => true,
            'data' => [
                [
                    'id' => $book->getId(),
                    'title' => $title,
                ],
            ]
        ]);
        return $response;
    }

    #[Route('book/update/{id}', name: 'update_book')]
    public function editBook(Request $request, EntityManagerInterface $em, BookRepository $bookRepository): JsonResponse{
        $response = new JsonResponse();

        $title = $request->get('title');
        $id = $request->attributes->get('id');
        $book = $bookRepository->find($id);
        
        
        
        $book->setTitle($title);
        $em->persist($book);
        $em->flush();

        $response->setData([
            'success' => true,
            'data' => [
                [
                    'id' => $id,
                    'title' => $title,
                ],
            ]
        ]);
        return $response;
    }
};



?>