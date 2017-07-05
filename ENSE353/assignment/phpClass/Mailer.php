<?php
class Mailer {
    function sendVerification($to, $link) {
        $subject = 'Confirm Subscription';
        $message = "Please click the following link to verify your account:\n\n" .
                    $link . "\n\n\n" .
                    "If you do not verify your email, your account will remain " .
                    "inactive and you will not receive any emails.";
        $headers = "From: noreply@subscription_service.com";

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