<?php

namespace App\Controller\Admin;

use App\Entity\Orders;
use App\Entity\Products;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Filter\ChoiceFilter;

class OrdersCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Orders::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            // the labels used to refer to this entity in titles, buttons, etc.
            ->setEntityLabelInSingular('Заказ')
            ->setEntityLabelInPlural('Заказы');
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            ArrayField::new('products', 'Товары')->onlyOnIndex(),
            AssociationField::new('products', 'Товары')->onlyOnForms()->setFormTypeOptions([
                'by_reference' => false,
            ]),
            TextField::new('PriceForOne', 'Цена за ед. Товара')->onlyOnIndex(),
            NumberField::new('Count', 'Кол-во товаров в заказе')->onlyOnIndex(),
            NumberField::new('Sum', 'Итоговая стоимость')->onlyOnIndex(),
            ChoiceField::new('Status', 'Статус')->setChoices([
                "Ожидает обработки" => 0,
                "Ожидает отправки" => 1,
                "Отправлен" => 2,
                "Доставлен" => 3,
                "Выдан клиенту" => 4
            ]),
        ];
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->disable(Action::NEW, Action::DELETE);
    }

    public function configureFilters(Filters $filters): Filters
    {
        return $filters
            ->add(ChoiceFilter::new('Status', 'Статус заказа')->setChoices([
                "Ожидает обработки" => 0,
                "Ожидает отправки" => 1,
                "Отправлен" => 2,
                "Доставлен" => 3,
                "Выдан клиенту" => 4
            ]));
    }

}
