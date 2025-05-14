<?php

namespace App\Controller\Admin;

use App\Entity\Passenger;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class PassengerCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Passenger::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            AssociationField::new('client')->setRequired(true),
            TextField::new('first_name')->setColumns(4),
            TextField::new('last_name')->setColumns(4),
            TextField::new('passport')->setColumns(4),
        ];
    }
    
}
