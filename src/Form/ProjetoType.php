<?php

namespace App\Form;

use App\Entity\Projeto;
use App\Form\FuncionarioType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProjetoType extends AbstractType{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        //Como adicionar o campo de funcionarios no form do projeto?
        $builder
            ->add('nome')
            //->add('funcionarios', CollectionType::class, ['entry_type' => FuncionarioType::class, 'entry_options' => ['nome' => 'Abacate']])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Projeto::class,
        ]);
    }
}