<?php

namespace App\Controller;

use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class LibraryController extends AbstractController 
{

    #[Route('library/list', name: 'library_list')]
    public function list(Request $request, LoggerInterface $logger): JsonResponse
    {

        $title = $request->query->get('title', 'Up');
        $logger->info('List action called up');
        $response = new JsonResponse();
        $response->setData([
            'success' => true,
            'data' => [
                [
                    'id' => 1,
                    'title' => 'El Silmarillion',
                    'autor' => 'Tolkien'
                ],
                [
                    'id' => 2,
                    'title' => 'Nacidos de la bruma',
                    'autor' => 'Brandon Sanderson'
                ],
                [
                    'id' => 3,
                    'title' => $title
                ]
            ]
        ]);
        return $response;
    }

};



?>