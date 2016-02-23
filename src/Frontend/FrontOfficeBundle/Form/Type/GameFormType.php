<?php

namespace Frontend\FrontOfficeBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

use Doctrine\ORM\EntityRepository;

class GameFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $translation_domain = "templatesTranslations";
        
        $builder->add('id', 'text', array( 
                    'label' => false,
                    'required' => false
                ))
                ->add('name', 'text', array(
                    'label' => 'profile.add_game.game.game_name.label',
                    'translation_domain' => $translation_domain, 
                    'required' => false
                ))
                ->add('plateform', 'entity', array(
                    'label' => 'profile.add_game.game.plateform.label',
                    'translation_domain' => $translation_domain, 
                    'required' => false,
                    'class' => 'FrontendFrontOfficeBundle:Plateform',
                    'query_builder' => function(EntityRepository $er) {
                        return $er->createQueryBuilder('p')
                            ->orderBy('p.id', 'ASC');
                    },
                    'property' => 'value'
                ))
                ->add('editor_1', 'entity', array(
                    'label' => 'profile.add_game.game.editor.label',
                    'translation_domain' => $translation_domain, 
                    'required' => false,
                    'class' => 'FrontendFrontOfficeBundle:Editor',
                    'query_builder' => function(EntityRepository $er) {
                        return $er->createQueryBuilder('e')
                            ->orderBy('e.id', 'ASC');
                    },
                    'property' => 'value'
                ))
                ->add('editor_2', 'entity', array(
                    'label' => 'profile.add_game.game.editor.label',
                    'translation_domain' => $translation_domain, 
                    'required' => false,
                    'class' => 'FrontendFrontOfficeBundle:Editor',
                    'query_builder' => function(EntityRepository $er) {
                        return $er->createQueryBuilder('e')
                            ->orderBy('e.id', 'ASC');
                    },
                    'property' => 'value'
                ))
                ->add('editor_3', 'entity', array(
                    'label' => 'profile.add_game.game.editor.label',
                    'translation_domain' => $translation_domain, 
                    'required' => false,
                    'class' => 'FrontendFrontOfficeBundle:Editor',
                    'query_builder' => function(EntityRepository $er) {
                        return $er->createQueryBuilder('e')
                            ->orderBy('e.id', 'ASC');
                    },
                    'property' => 'value'
                ))
                ->add('series', 'entity', array(
                    'label' => 'profile.add_game.game.series.label',
                    'translation_domain' => $translation_domain, 
                    'required' => false,
                    'class' => 'FrontendFrontOfficeBundle:Series',
                    'query_builder' => function(EntityRepository $er) {
                        return $er->createQueryBuilder('s')
                            ->orderBy('s.id', 'ASC');
                    },
                    'property' => 'value'
                ))
                ->add('released_year', 'text', array(
                    'label' => 'profile.add_game.game.released_year.label',
                    'translation_domain' => $translation_domain, 
                    'required' => false
                ))
                ->add('game_type', 'entity', array(
                    'label' => 'profile.add_game.game.game_type.label',
                    'translation_domain' => $translation_domain, 
                    'required' => false,
                    'class' => 'FrontendFrontOfficeBundle:GameType',
                    'query_builder' => function(EntityRepository $er) {
                        return $er->createQueryBuilder('gt')
                            ->orderBy('gt.id', 'ASC');
                    },
                    'property' => 'value'
                ));
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) 
    { 
        $resolver->setDefaults(
                array( 
                    'data_class' => 'Frontend\FrontOfficeBundle\Entity\Game',
                    'validation_groups' => array('AddCatalogGame')
                )
        ); 
    }
    
    public function getName()
    {
        return 'frontend_frontoffice_addGame';
    }
}
