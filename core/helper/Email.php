<?php
declare(strict_types=1);

namespace core\helper;

class Email
{
    public static function send(string $to, string $subject, string $message, array $additional_headers = []) : bool
    {
        $message = wordwrap($message, 70, "\r\n");
        
        $result = mail($to, $subject, $message, $additional_headers);
        
        return $result;
    }
}