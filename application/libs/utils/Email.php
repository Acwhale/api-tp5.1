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
     * @return bool
     */
    public function send($email,$name){
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
                    <p>点击<a href="c.cn/api/v1/gift/recent" target="_blank">这里</a>可以重置你的密码
                    </p>
                    <p>如果无法点击，你也可以将下面的地址复制到浏览器中打开: 如果无法点击，你也可以将下面的地址复制到浏览器中打开: </p>
                    <a>c.cn/api/v1/gift/recent</a>
                    <p>你的，</p>
                    <p>鱼书</p>
                    <p>
                        <small>注意，请不要回复此邮件哦</small>
                    </p>
';
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