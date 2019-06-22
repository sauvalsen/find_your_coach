<?php

namespace App\Security\Exceptions;

use Symfony\Component\Security\Core\Exception\AccountStatusException;

/**
 * EnabledException is thrown when the user account has expired.
 *
 */
class ActiveException extends AccountStatusException
{
    /**
     * {@inheritdoc}
     */
    public function getMessageKey()
    {
        return 'L\'utilisateur n\'est pas actif.';
    }
}

