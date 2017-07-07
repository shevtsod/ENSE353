<?php
class Mailer {
    function sendVerification($to, $link) {
        $subject = 'Confirm Subscription - Subscription Service - ENSE 353 - Daniel Shevtsov';
        $message = "You have recently created an account on \"Subscription Service\"\n\n" .
                    "Please click on the following link to verify your account:\n\n" .
                    $link . "\n\n\n" .
                    "If you do not verify your email, your account will remain " .
                    "inactive and you will not receive any emails.";
        $headers = "From: noreply@subscription-service.com";

        $message = $this->appendFooter($message);

        mail($to, $subject, $message, $headers);   
    }

    function appendFooter($message) {
        return $message .  "\n\n\n-----------------------\n" .
                "ENSE 353 Subscription Service Assignment\n" . 
                "Daniel Shevtsov";
    }
}
?>