<?php 

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Mailer
{
    private $db;
    private $logs;
    private $class_name;
    private $class_name_lower;

    // variables
    private $IS_SMTP;
    private $SMTP_HOST;
    private $SMTP_AUTH;
    private $SMTP_USERNAME;
    private $SMTP_PASSWORD;
    private $SMTP_ENCRYPTION;
    private $SMTP_ENCRYPTION_TYPE;
    private $SMTP_PORT;

    public function __construct(PDO $db, Settings $settings) {
        $this->logs = new Logs((new DB())->connect());
        $this->db = $db;
        $this->class_name = "Mailer";
        
        $this->IS_SMTP = $settings->fetch('mail_smtp') === '1' ? true : false; // if stmp is allowed otherwise mail() function will be used. true or false ('1' or '0' respectively)
        $this->SMTP_HOST = $settings->fetch('mail_smtp_host');
        $this->SMTP_AUTH = $settings->fetch('mail_smtp_auth') === '1' ? true : false; // smtp server requires authentication? true or false ('1' or '0' respectively)
        $this->SMTP_USERNAME = $settings->fetch('mail_smtp_username');
        $this->SMTP_PASSWORD = $settings->fetch('mail_smtp_password');
        $this->SMTP_ENCRYPTION = ($settings->fetch('mail_smtp_encryption') === '1' ? true : false); // smtp encryption is allowed? true or false ('1' or '0' respectively)
        $this->SMTP_ENCRYPTION_TYPE = $settings->fetch('mail_smtp_encryption_type'); // either tls or smtps
        $this->SMTP_PORT = $settings->fetch('mail_smtp_port'); // default is 465
    }

    private function get_phpmailer_object ($from, $from_name, $to, $to_name)
    {
        $mail = new PHPMailer(true);

        if ($this->IS_SMTP === true) {
            $mail->isSMTP();
            $mail->Host = $this->SMTP_HOST;
            $mail->SMTPAuth = $this->SMTP_AUTH;
            $mail->Username = $this->SMTP_USERNAME;
            $mail->Password = $this->SMTP_PASSWORD;
            $mail->CharSet = 'UTF-8';
            if ($this->SMTP_ENCRYPTION != '1') {
                $mail->SMTPSecure = $this->SMTP_ENCRYPTION_TYPE == 'tls' ? PHPMailer::ENCRYPTION_STARTTLS : PHPMailer::ENCRYPTION_SMTPS; 
            }
            $mail->Port = $this->SMTP_PORT;
        }
        $mail->isHTML(true);
        $mail->setFrom($from, $from_name);

        if (!empty($to_name)) {
            $mail->addAddress($to, $to_name);
        } else {
            $mail->addAddress($to);
        }

        return $mail;
    }
    
    public function send_email ($from, $from_name, $to, $to_name, $subject, $content)
    {
        $mail = $this->get_phpmailer_object($from, $from_name, $to, $to_name);
         
        $mail->Subject = $subject;
        $mail->Body = $content;
        
        try {
            $mail->send();
            return ['status' => true];
        } catch (Exception $e) {
            $failure = $this->class_name.'.send_email - E.02: Failure';
            $this->logs->create($this->class_name_lower, $failure, json_encode(['error' => $e->getMessage()]));
            return ['status' => false, 'type' => 'exception', 'data' => $failure];
        }
    }
}
