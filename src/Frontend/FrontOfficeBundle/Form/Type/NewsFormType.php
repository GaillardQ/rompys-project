<?php

namespace Frontend\FrontOfficeBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class NewsFormType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $translation_domain = "templatesTranslations";
        $builder
            ->add('title', 'text', array(
                'label' => 'bo.news.add.title', 
                'translation_domain' => $translation_domain, 
                'required' => true
            ))
            ->add('content', 'textarea', array(
                'label' => 'bo.news.add.content', 
                'translation_domain' => $translation_domain, 
                'required' => true
            ))
            ->add('dateStart', 'datetime', array(
                'label' => 'bo.news.add.dateStart', 
                'translation_domain' => $translation_domain, 
                'required' => true
            ))
            ->add('dateEnd', 'datetime', array(
                'label' => 'bo.news.add.dateEnd', 
                'translation_domain' => $translation_domain, 
                'required' => true
            ))
            ->add('save', 'submit', array(
                'label' => 'bo.news.add.save',
                'translation_domain' => $translation_domain, 
            ))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Frontend\FrontOfficeBundle\Entity\News'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'frontend_frontofficebundle_news';
    }
}
