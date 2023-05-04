<?php

namespace App\Controller\Admin;

use App\Entity\Logiciel;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class LogicielCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Logiciel::class;
    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}
