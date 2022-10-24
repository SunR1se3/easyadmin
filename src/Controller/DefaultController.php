<?php

namespace App\Controller;

use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Flex\Response;

class DefaultController extends AbstractController {


    public function __construct()
    {
    }

    #[Route('/')]
    public function root()
    {
        return $this->redirect('http://localhost:8000/admin');
    }
}