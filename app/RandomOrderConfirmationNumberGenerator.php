<?php

namespace App;

class RandomOrderConfirmationNumberGenerator implements OrderConfirmationNumberGenerator
{
    public function generate()
    {
        // Can Only contain uppercase letters and numbers
        // Cannot contain ambiguous characters like I AND 1, 0 AND O
        // Must be 24 characters long
        // All order confirmation numbers must be unique

        $pool = 'ABCDEFGHJKLMNPQRSTUVWXYZ23456789';

        return substr(str_shuffle(str_repeat($pool, 24)), 0, 24);
    }
}
