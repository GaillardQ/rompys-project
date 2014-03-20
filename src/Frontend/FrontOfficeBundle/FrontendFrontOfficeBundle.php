<?php

namespace Frontend\FrontOfficeBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class FrontendFrontOfficeBundle extends Bundle
{
    public function getParent()
    {
        return 'FOSUserBundle';
    }
}
