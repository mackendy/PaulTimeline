<?php

namespace Paul\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class PaulUserBundle extends Bundle
{
    public function getParent()
    {
        return 'FOSUserBundle';
    }
}
