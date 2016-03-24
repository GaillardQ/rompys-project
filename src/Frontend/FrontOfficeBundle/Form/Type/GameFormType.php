<?php

namespace Frontend\FrontOfficeBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

use Frontend\FrontOfficeBundle\Entity\Game;

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
                ->add('editor1', 'text', array(
                    'label' => 'profile.add_game.game.editor.label',
                    'translation_domain' => $translation_domain, 
                    'required' => false,
                ))
                ->add('editor2', 'text', array(
                    'label' => 'profile.add_game.game.editor.label',
                    'translation_domain' => $translation_domain, 
                    'required' => false,
                ))
                ->add('editor3', 'text', array(
                    'label' => 'profile.add_game.game.editor.label',
                    'translation_domain' => $translation_domain, 
                    'required' => false,
                ))
                ->add('serie', 'text', array(
                    'label' => 'profile.add_game.game.series.label',
                    'translation_domain' => $translation_domain, 
                    'required' => false,
                ))
                ->add('releasedYear', 'text', array(
                    'label' => 'profile.add_game.game.released_year.label',
                    'translation_domain' => $translation_domain, 
                    'required' => false
                ))
                ->add('gameType', 'entity', array(
                    'label' => 'profile.add_game.game.game_type.label',
                    'translation_domain' => $translation_domain, 
                    'required' => false,
                    'class' => 'FrontendFrontOfficeBundle:GameType',
                    'query_builder' => function(EntityRepository $er) {
                        return $er->createQueryBuilder('gt')
                            ->orderBy('gt.id', 'ASC');
                    },
                    'property' => 'value'
                ))
                ->add('language', 'choice', array(
                    'label' => 'profile.add_game.game_catalog.language.label',
                    'translation_domain' => $translation_domain, 
                    'required' => false,
                    'choices'   => array(
                        Game::LANGUAGE_FR => Game::LANGUAGE_FR, 
                        Game::LANGUAGE_JP => Game::LANGUAGE_JP,
                        Game::LANGUAGE_UK => Game::LANGUAGE_UK,
                        Game::LANGUAGE_US => Game::LANGUAGE_US,
                        Game::LANGUAGE_ZZ => Game::LANGUAGE_ZZ
                    ),
                    'expanded' => false,
                    'multiple' => false,
                ))
                ->add('package', 'choice', array(
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
                        Game::ZONE_JAP => Game::ZONE_JAP, 
                        Game::ZONE_NTSC => Game::ZONE_NTSC,
                        Game::ZONE_PAL => Game::ZONE_PAL
                    ),
                    'expanded' => false,
                    'multiple' => false
                ))
                ->add('file', 'file', array(
                    'label' => 'profile.add_game.game_catalog.image.label',
                    'translation_domain' => $translation_domain, 
                    'required' => false,
                ))
                ->add('delete', 'checkbox', array(
                    'label' => 'profile.add_game.game.delete_image.label',
                    'translation_domain' => $translation_domain, 
                    'required' => false,
                    'mapped' => false
                ))
                ->add('alternativeName', 'text', array(
                    'label' => 'profile.add_game.game_catalog.alternative_name.label',
                    'translation_domain' => $translation_domain, 
                    'required' => false,
                    'attr' => array('placeholder' => 'Dépend de la zone')
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
