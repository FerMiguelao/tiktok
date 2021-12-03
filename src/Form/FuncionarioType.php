<?php

namespace App\Form;

use App\Entity\Funcionario;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FuncionarioType extends AbstractType{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nome')
            ->add('dataDeNascimento', DateTimeType::class, ["widget" => "single_text", "html5" => false, "format" => "dd-MM-yyyy", "attr" => ["class" => "form_meridian_datetime"]])
            ->add('projeto')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Funcionario::class,
        ]);
    }
}