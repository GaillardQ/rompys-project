<?php

namespace Frontend\FrontOfficeBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PlateformeFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $translation_domain = "templatesTranslations";
        $builder->add('value', null, array(
            'label' => 'bo.plateforms.add.name', 
            'translation_domain' => $translation_domain, 
            'required' => true
        ))
        ->add('save', 'submit', array(
            'label' => 'bo.plateforms.add.save',
            'translation_domain' => $translation_domain, 
        ));
    }
    
    public function setDefaultOptions(OptionsResolverInterface $resolver) 
    { 
        $resolver->setDefaults(
            array( 
                'data_class' => 'Frontend\FrontOfficeBundle\Entity\Plateform',
            )
        ); 
    }

    public function getName()
    {
        return 'frontend_plateform';
    }
}
