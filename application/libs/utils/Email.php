<?php
/**
 * Created by PhpStorm.
 * User: hello
 * Date: 2018/12/27
 * Time: 16:41
 */

namespace app\libs\utils;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use think\Loader;

class Email {
    private $mailServer;
    private $mailPort;
    private $mailUserName;
    private $mailPassword;
    public function __construct() {
        $this->mailServer = config('email.MAIL_SERVER');
        $this->mailPort = config('email.MAIL_PORT');
        $this->mailUserName = config('email.MAIL_USERNAME');
        $this->mailPassword = config('email.MAIL_PASSWORD');
    }

    /**
     * @param $email  给用户发送重置密码
     * @param  $name
     * @param  $passWord
     * @return bool
     *
     */
    public function send($email,$name,$passWord){
        Loader::addAutoLoadDir('/vendor/autoload.php');
//        require_once __DIR__ . '/vendor/autoload.php';
        $mail = new PHPMailer();
        try {
            //Server settings
            $mail->CharSet = 'utf-8';
            $mail->SMTPDebug = 2;                                 // Enable verbose debug output
            $mail->isSMTP();                                      // Set mailer to use SMTP
            $mail->Host = $this->mailServer ;  // Specify main and backup SMTP servers
            $mail->SMTPAuth = true;                               // Enable SMTP authentication
            $mail->Username = $this->mailUserName;                 // SMTP username
            $mail->Password = $this->mailPassword;                           // SMTP password
            $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
            $mail->Port = $this->mailPort;                                    // TCP port to connect to

            //Recipients
            $mail->setFrom($this->mailUserName, '管理员');
            $mail->addAddress($email, $name);     // Add a recipient

            $mail->isHTML(true);
            $mail->Subject = '重置密码';
            $mail->Body    = '<p>亲爱的'. $name .'</p>
                    <p>你的新密码是：<b>'.$passWord.'</b></b></p>
                    <p>
                        <small>注意，请不要回复此邮件哦</small>
                    </p>';
            $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
            if($mail->send()){
                return true;
            }else{
                return false;
            }

        } catch (Exception $e) {
            echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
        }
    }
    public function sendDriftEmail($email,$nickname,$title){
        Loader::addAutoLoadDir('/vendor/autoload.php');
//        require_once __DIR__ . '/vendor/autoload.php';
        $mail = new PHPMailer();
        try {
            //Server settings
            $mail->CharSet = 'utf-8';
            $mail->SMTPDebug = 2;                                 // Enable verbose debug output
            $mail->isSMTP();                                      // Set mailer to use SMTP
            $mail->Host = $this->mailServer ;  // Specify main and backup SMTP servers
            $mail->SMTPAuth = true;                               // Enable SMTP authentication
            $mail->Username = $this->mailUserName;                 // SMTP username
            $mail->Password = $this->mailPassword;                           // SMTP password
            $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
            $mail->Port = $this->mailPort;                                    // TCP port to connect to

            //Recipients
            $mail->setFrom($this->mailUserName, '管理员');
            $mail->addAddress($email, $title);     // Add a recipient

            $mail->isHTML(true);
            $mail->Subject = '书籍';
            $mail->Body    = '<p>Hi,'.$nickname.' 有人想要一本书《'. $title .'》</p>';
            $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
            if($mail->send()){
                return true;
            }else{
                return false;
            }

        } catch (Exception $e) {
            echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
        }
    }
}