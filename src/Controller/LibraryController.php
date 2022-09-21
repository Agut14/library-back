<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class LibraryController extends AbstractController 
{

    #[Route('library/list', name: 'library_list')]
    public function list(Request $request): JsonResponse
    {



        $title = $request->query->get('title');
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