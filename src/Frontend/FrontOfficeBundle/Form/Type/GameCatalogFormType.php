<?php

namespace Frontend\FrontOfficeBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

use Doctrine\ORM\EntityRepository;

use Frontend\FrontOfficeBundle\Form\Type\GameFormType;
use Frontend\FrontOfficeBundle\Entity\GameCatalog;

class GameCatalogFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $translation_domain = "templatesTranslations";
        
        $builder->add('game', new GameFormType(), array(
                    'label' => false
                ))
                ->add('language', 'choice', array(
                    'label' => 'profile.add_game.game_catalog.language.label',
                    'translation_domain' => $translation_domain, 
                    'required' => false,
                    'choices'   => array(
                        GameCatalog::LANGUAGE_FR => GameCatalog::LANGUAGE_FR, 
                        GameCatalog::LANGUAGE_JP => GameCatalog::LANGUAGE_JP,
                        GameCatalog::LANGUAGE_UK => GameCatalog::LANGUAGE_UK,
                        GameCatalog::LANGUAGE_US => GameCatalog::LANGUAGE_US,
                        GameCatalog::LANGUAGE_ZZ => GameCatalog::LANGUAGE_ZZ
                    ),
                    'expanded' => false,
                    'multiple' => false,
                ))
                ->add('game_package', 'choice', array(
                    'label' => 'profile.add_game.game_catalog.game_package.label',
                    'translation_domain' => $translation_domain, 
                    'required' => false,
                    'choices'   => array(true => 'Oui', false => 'Non'),
                    'expanded' => false,
                    'multiple' => false
                ))
                ->add('blister', 'choice', array(
                    'label' => 'profile.add_game.game_catalog.blister.label',
                    'translation_domain' => $translation_domain, 
                    'required' => false,
                    'choices'   => array(true => 'Oui', false => 'Non'),
                    'expanded' => false,
                    'multiple' => false
                ))
                ->add('notice', 'choice', array(
                    'label' => 'profile.add_game.game_catalog.notice.label',
                    'translation_domain' => $translation_domain, 
                    'required' => false,
                    'attr' => array('style' => 'margin-right: 5px;'),
                    'choices'   => array(true => 'Oui', false => 'Non'),
                    'expanded' => false,
                    'multiple' => false
                ))
                ->add('price', 'text', array(
                    'label' => 'profile.add_game.game_catalog.price.label',
                    'translation_domain' => $translation_domain, 
                    'attr' => array('placeholder' => 'En euro'),
                    'required' => false
                ))
                ->add('comment', 'textarea', array(
                    'label' => 'profile.add_game.game_catalog.comment.label',
                    'translation_domain' => $translation_domain, 
                    'required' => false,
                    'max_length' => 500,
                    'attr' => array('placeholder' => 'Entrez votre commentaire (500 car. max)...')
                ))
                ->add('state', 'entity', array(
                    'label' => 'profile.add_game.game_catalog.state.label',
                    'translation_domain' => $translation_domain, 
                    'required' => false,
                    'class' => 'FrontendFrontOfficeBundle:GameState',
                    'query_builder' => function(EntityRepository $er) {
                        return $er->createQueryBuilder('s')
                            ->orderBy('s.id', 'ASC');
                    },
                    'property' => 'value'
                ))
                ->add('zone', 'choice', array(
                    'label' => 'profile.add_game.game_catalog.zone.label',
                    'translation_domain' => $translation_domain, 
                    'required' => false,
                    'choices'   => array(
                        GameCatalog::ZONE_JAP => GameCatalog::ZONE_JAP, 
                        GameCatalog::ZONE_NTSC => GameCatalog::ZONE_NTSC,
                        GameCatalog::ZONE_PAL => GameCatalog::ZONE_PAL
                    ),
                    'expanded' => false,
                    'multiple' => false
                ))
                ->add('alternative_name', 'text', array(
                    'label' => 'profile.add_game.game_catalog.alternative_name.label',
                    'translation_domain' => $translation_domain, 
                    'required' => false,
                    'attr' => array('placeholder' => 'Dépend de la zone')
                ))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) 
    { 
        $resolver->setDefaults(
                array( 
                    'data_class' => 'Frontend\FrontOfficeBundle\Entity\GameCatalog',
                    'validation_groups' => array('AddCatalogGame'), 
                    'cascade_validation' => true
                )
        ); 
    }
    
    public function getName()
    {
        return 'frontend_frontoffice_addCatalogGame';
    }
}
