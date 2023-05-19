<?php

namespace App\Controller\Admin;

use App\Entity\Reservation;
use App\Entity\Salle;
use App\Form\ReservationType;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Context\AdminContext;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use EasyCorp\Bundle\EasyAdminBundle\Event\AfterCrudActionEvent;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\AbstractType;
use EasyCorp\Bundle\EasyAdminBundle\Dto\BatchActionDto;
use Symfony\Component\Routing\Annotation\Route;


class ReservationCrudController extends AbstractCrudController
{

        public function configureCrud(Crud $crud): Crud
    {
        return $crud
            // ...
            ->showEntityActionsInlined()
            // ->overrideTemplate('crud/layout', 'admin/advanced_layout.html.twig')

            ->overrideTemplates([
                'crud/field/text' => 'admin/reservation/field.html.twig',
                // 'label/null' => 'admin/labels/null_product.html.twig',
            ])
           
        // the visible title at the top of the page and the content of the <title> element
        // it can include these placeholders:
        //   %entity_name%, %entity_as_string%,
        //   %entity_id%, %entity_short_id%
        //   %entity_label_singular%, %entity_label_plural%
        ->setPageTitle('index', '%entity_label_plural% listing')
        ;
    }

    
   
    public static function getEntityFqcn(): string
    {
        return Reservation::class;
    }


    public function configureActions(Actions $actions): Actions{

        
          $validationButton = Action::new('validation')
        //  ->setTemplatePath('admin/admin_validation.html.twig')
          ->linkToCrudAction('validationReservation')
          ->addCssClass('btn btn-success')
         // ->displayAsButton()
          ->setHtmlAttributes(['name' => 'ea[newForm][btn]', 'value' => 'saveAndReturn']);
        

        $annulationButton = Action::new('annulation')
       // ->setTemplatePath('admin/admin_annulation.html.twig')
        ->linkToCrudAction('annulationReservation')
        ->addCssClass('btn btn-danger')
        //->displayAsButton()
        ->setHtmlAttributes(['name' => 'ea[newForm][btn]', 'value' => 'saveAndReturn']);

        
        // dd($actions);
         return $actions
        //  ->addBatchAction(Action::new('validation', 'validation reservation')
        //  ->linkToCrudAction('validationReservation')
        //  ->addCssClass('btn btn-success'));
        //  ->setIcon('fa fa-user-check')

        //  ->addBatchAction(Action::new('validation', 'validation reservation')
        //  ->linkToCrudAction('annulationReservation')
        //  ->addCssClass('btn btn-danger'));
        //  ->setIcon('fa fa-user-check');
        // ->add(Crud::PAGE_EDIT,ACTION::DELETE)
           ->add(Crud::PAGE_EDIT,$validationButton)
           ->add(Crud::PAGE_EDIT, $annulationButton);
        //  ->add(Crud::PAGE_INDEX,$validation)
        //  ->add(Crud::PAGE_INDEX, $annulation);
        //  ->remove(Crud::PAGE_EDIT, '');
        // dd($actions);
    
    }



    
    public function configureFields(string $pageName): iterable
    {
        //  dd($pageName);
        return [
            IdField::new('id')->hideOnForm()->addCssClass('bg-warning'),
            DateTimeField::new('dateDebut')->addCssClass('bg-warning'),
            DateTimeField::new('dateFin')->addCssClass('bg-warning'),
            AssociationField::new('salle')->addCssClass('bg-warning'),
            AssociationField::new('user')->addCssClass('bg-warning'),
            // ->onlyOnDetail(),
            // AssociationField::new('client'
        //     FormField::addColor('Contact information Tab'add)
        //     ->setIcon('phone')->addCssClass('optional')
        //     ->setHelp('Phone number is preferred'),
        // dd($pageName),
        // TextField::new('phone'),
        ];
       //     ->setHelp('Phone number is preferred'),
        
    }

    
#[Route('admin/reservation/{id}', name: 'admin_validation', methods: ['GET', 'POST'])]
  
    
     public function validationReservation(AdminContext $context,Request $request,EntityManagerInterface $entityManager, UsersCrudController $user, SalleRepository $salle)
   

     {
    //      dd($context);
         $validation = $context->getEntity()->getInstance();
        
         
         $user = $this->getUser();
         
        //  $validation->setSalle($salle);

        //  if (!is_null($validation))
        //  {
            $validation->setUser($user);
            //  dd($validation);
           
            //  dd($validation);
           $entityManager->persist($validation);
           $entityManager->flush();
        // }
         return $this->render('admin/admin_validation.html.twig', [
             'validation' => $validation
         ]);
     }   


     public function annulationReservation(AdminContext $context,Request $request,EntityManagerInterface $entityManager, UsersCrudController $user,SalleCrudController $salle)
   

     {
    //      dd($context);
        $annulation = $context->getEntity()->getInstance();
        
        //  $dispo= $this->getSalle();
         $user = $this->getUser();
       
        

         if (!is_null($annulation))
         {
            $annulation->setUser($user);
        //     $entity->setSalle($dispo);
        //    dd($entity);
          // $entityManager->persist($annulation);
           $entityManager->flush();
        }
         return $this->render('admin/admin_annulation.html.twig', [
             'annulation' => $annulation
         ]);
     }   

    }


 

      
        

       

   
    


