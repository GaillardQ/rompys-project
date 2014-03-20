<?php

namespace Frontend\FrontOfficeBundle\Form\Type;

use Symfony\Component\Form\FormBuilderInterface;
use FOS\UserBundle\Form\Type\RegistrationFormType as BaseType;

class RegistrationFormType extends BaseType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $translation_domain = "templatesTranslations";
        $builder->add('username', null, array(
                                            'label' => 'register.label.username', 
                                            'translation_domain' => $translation_domain, 
                                            'required' => false
                ))
            ->add('firstname', null, array(
                                            'label' => 'register.label.firstname', 
                                            'translation_domain' => $translation_domain, 
                                            'required' => false
                ))
            ->add('lastname', null, array(
                                            'label' => 'register.label.lastname', 
                                            'translation_domain' => $translation_domain, 
                                            'required' => false
                ))
            ->add('phone', null, array(
                                        'label' => 'register.label.phone', 
                                        'translation_domain' => $translation_domain, 
                                        'required' => false
                ))
            ->add('email', 'email', array(
                                            'label' => 'register.label.email', 
                                            'translation_domain' => $translation_domain, 
                                            'required' => false
                ))
            ->add('plainPassword', 'repeated', array(
                                                    'type' => 'password',
                                                    'first_options' => array(
                                                                                'label' => 'register.label.password', 
                                                                                'translation_domain' => $translation_domain
                                                        ),
                                                    'second_options' => array(
                                                                                'label' => 'register.label.password_confirm', 
                                                                                'translation_domain' => $translation_domain
                                                        ),
                                                    'invalid_message' => 'register.password.not_the_same', 
                                                    'required' => false
            ))
        ;
    }

    public function getName()
    {
        return 'frontend_user_registration';
    }
}
