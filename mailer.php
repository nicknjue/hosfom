<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require __DIR__ . '/vendor/autoload.php'; // Include Composer autoload

class MailerHelper {
    private $mail;

    public function __construct() {
        $this->mail = new PHPMailer(true);

        try {
            //Server settings
            $this->mail->isSMTP();
            $this->mail->Host       = 'smtp.gmail.com';
            $this->mail->SMTPAuth   = true;
            $this->mail->Username   = 'njue.wambui@strathmore.edu'; // your Gmail
            $this->mail->Password   = 'cjxd fbqm jirb xusj';    // use App Password for Gmail
            $this->mail->SMTPSecure = 'tls';
            $this->mail->Port       = 587;

            //Sender info
            $this->mail->setFrom('njue.wambui@strathmore.edu', 'HosForm');
        } catch (Exception $e) {
            echo "Mailer Error: " . $e->getMessage();
        }
    }

    public function sendCode($toEmail, $toName, $code) {
        try {
            $this->mail->addAddress($toEmail, $toName);
            $this->mail->isHTML(true);
            $this->mail->Subject = 'Your 2FA Verification Code';
            $this->mail->Body    = "Hello <b>$toName</b>,<br><br>Your verification code is: <b>$code</b><br><br>Do not share this with anyone.";

            return $this->mail->send();
        } catch (Exception $e) {
            return false;
        }
    }
}
?>
