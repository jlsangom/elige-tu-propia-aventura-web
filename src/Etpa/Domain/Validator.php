<?php

namespace Etpa\Domain;

trait Validator
{
    public function assertStringLengthIsLessOrEqual($string, $lengthLimit)
    {
        if (strlen($string) > $lengthLimit) {
            throw new \Exception(sprintf('String length is bigger than %s', $lengthLimit));
        }
    }
}
