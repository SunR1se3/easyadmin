<?php

namespace App\Controller\Admin;

use App\Entity\Orders;
use App\Entity\Products;
use App\Repository\ProductsRepository;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    public function __construct(private ProductsRepository $_productsRepository)
    {
    }


    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        $products = $this->json($this->_productsRepository->findAll());
        return $this->render('admin/dashboard.html.twig', ['products' => $products]);
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('EasyAdminV2');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Главная', 'fa fa-file-code-o');
        yield MenuItem::linkToCrud('Товары', 'fa fa-tag', Products::class);
        yield MenuItem::linkToCrud('Заказы', 'fa fa-briefcase', Orders::class);
    }
}
