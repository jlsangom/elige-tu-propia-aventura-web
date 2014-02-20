<?php

namespace Etpa\Domain;

class NonExistingPageException extends \Exception
{
    protected $message = 'Page does not exist';
}
