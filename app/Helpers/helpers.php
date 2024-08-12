<?php

// Remove String and Special Chars and convert to Numeric value

if (!function_exists('currencyIDRtoNumeric')) {
    function currencyIDRtoNumeric($value)
    {
        $cleanValue = preg_replace('/\D/', '', $value);

        return intval($cleanValue);
    }
}