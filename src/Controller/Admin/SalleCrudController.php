<?php

namespace App\Controller\Admin;

use App\Entity\Salle;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;

class SalleCrudController extends AbstractCrudController

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
        return Salle::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('nom'),
            BooleanField::new('disponible'),
            IntegerField::new('nbPlaces'),
            MoneyField::new('prixHebdo')->setCurrency('EUR'),
            AssociationField::new('materiel'),
            AssociationField::new('logiciel'),
            AssociationField::new('ergonomie'),
        ];
     }

     public function persistEntity(EntityManagerInterface $entityManager, $entityInstance): void
     {
        $entityManager->persist($entityInstance);
        $entityManager->flush();
    }

     }
    

