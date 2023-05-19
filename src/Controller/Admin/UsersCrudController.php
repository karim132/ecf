<?php

namespace App\Controller\Admin;

use App\Entity\Users;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;

class UsersCrudController extends AbstractCrudController
{

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            // ...
            ->showEntityActionsInlined()
            // ->overrideTemplate('crud/layout', 'admin/advanced_layout.html.twig')

        ;
    }
    public static function getEntityFqcn(): string
    {
        return Users::class;
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
