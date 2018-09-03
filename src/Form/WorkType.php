<?php

namespace App\Form;

use App\Entity\Work;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class WorkType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        /*
            $builder
            ->add('quantity')
            ->add('status')
            ->add('remarques')
            ->add('idFMIS')
            ->add('dateBegin')
            ->add('dateEnd')
            ->add('surface')
            ->add('parcelle')
            ->add('product')
        ;
         */
        $builder
            ->add('product', HiddenType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
    }
}
