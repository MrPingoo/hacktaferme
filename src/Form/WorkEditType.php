<?php

namespace App\Form;

use App\Entity\WorkParcelle;
use App\Entity\WorkProduct;
use App\Entity\Work;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class WorkEditType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
            $builder
                //->add('status')
                ->add('remarques')
                //->add('idFMIS')
                ->add('dateBegin', DateType::class, [
                    'widget' => 'single_text',
                    'label' => 'Date d\'intervention'
                ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
    }
}
