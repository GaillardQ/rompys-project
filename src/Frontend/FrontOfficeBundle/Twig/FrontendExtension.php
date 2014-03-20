<?php

// src/Frontend/FrontOfficeBundle/Twig/FrontendExtension.php

namespace Frontend\FrontOfficeBundle\Twig;

class FrontendExtension extends \Twig_Extension {

    public function getFilters() {
        return array(
            'dateDiff' => new \Twig_Filter_Method($this, 'dateDiffFilter'),
        );
    }

    public function dateDiffFilter($begin, $end) {
        $diff = null;
        if ($begin != null && $end != null) {
            $diff_temp = date_diff($begin, $end, true); //true : on prend la valeur absolue de l'écart
            //Ecart en années
            $diff = $diff_temp->format("%Y");
            if ($diff == 0) {
                //Ecart en mois
                $diff = $diff_temp->format("%m");
                if ($diff == 0) {
                    //Ecart en jours
                    $diff = $diff_temp->format("%d");
                    if ($diff == 0) {
                        //Ecart en heures
                        $diff = $diff_temp->format("%h");
                        if ($diff == 0) {
                            //Ecart en minutes
                            $diff = $diff_temp->format("%i");
                            if ($diff == 0) {
                                //Ecart en secondes
                                $diff = $diff_temp->format("%s");
                                if ($diff == 0) {
                                    $diff = "Il y a quelques secondes";
                                } else {
                                    $diff .= " secondes";
                                }
                            } else {
                                    $diff .= " minutes";
                            }
                        } else {
                            $diff .= " heures";
                        }
                    } else {
                        $diff .= " jours";
                    }
                } else {
                    $diff .= " mois";
                }
            } else {
                $diff .= " années";
            }
        }
        return $diff;
    }

    public function getName() {
        return 'frontend_extension';
    }

}