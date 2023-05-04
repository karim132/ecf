<?php

namespace App\Controller\Admin;

use App\Entity\Ergonomie;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ErgonomieCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Ergonomie::class;
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
