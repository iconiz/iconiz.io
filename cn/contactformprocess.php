<?php
/**
 *
 * URL: www.freecontactform.com
 *
 * Version: FreeContactForm Free V2.2
 *
 * Copyright (c) 2013 Stuart Cochrane
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 *
 * Note: This is NOT the same code as the PRO version
 *
 */

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if (isset($_POST['email'])) {
    require "Exception.php";
    require "PHPMailer.php";
    require "SMTP.php";

    function died($error)
    {
        echo "Sorry, but there were error(s) found with the form you submitted. ";
        echo "These errors appear below.<br /><br />";
        echo $error . "<br /><br />";
        echo "Please go back and fix these errors.<br /><br />";
        die();
    }

    $name = $_POST['name']; // required
    $company_name = $_POST['company_name']; // required
    $email_from = $_POST['email']; // required

    $error_message = "";

    $email_message = "Form details below.\r\n";

    function clean_string($string)
    {
        $bad = array("content-type", "bcc:", "to:", "cc:");
        return str_replace($bad, "", $string);
    }

    $email_message .= "Name: " . clean_string($name) . "\r\n";
    $email_message .= "Company Name: " . clean_string($company_name) . "\r\n";
    $email_message .= "Email: " . clean_string($email_from) . "\r\n";

    // 实例化PHPMailer核心类
    $mail = new PHPMailer(true);
    // Passing `true` enables exceptions
    // try {
        // 是否启用smtp的debug进行调试 开发环境建议开启 生产环境注释掉即可 默认关闭debug调试模式
        $mail->SMTPDebug = 2;
        // 使用smtp鉴权方式发送邮件
        $mail->isSMTP();
        // smtp需要鉴权 这个必须是true
        $mail->SMTPAuth = true;
        // 链接qq域名邮箱的服务器地址
        $mail->Host = 'smtp.163.com';
        // 设置使用ssl加密方式登录鉴权
        $mail->SMTPSecure = 'ssl';
        // 设置ssl连接smtp服务器的远程服务器端口号
        $mail->Port = 465;
        // 设置发送的邮件的编码
        $mail->CharSet = 'UTF-8';
        // 设置发件人昵称 显示在收件人邮件的发件人邮箱地址前的发件人姓名
        $mail->FromName = '发件人昵称';
        // smtp登录的账号
        $mail->Username = 'suntangi@163.com';
        // smtp登录的密码 使用生成的授权码
        $mail->Password = '.282702asdf';
        // 设置发件人邮箱地址 同登录账号
        $mail->From = 'suntangi@163.com';
        // 邮件正文是否为html编码 注意此处是一个方法
        $mail->isHTML(true);
        // 设置收件人邮箱地址
        $mail->addAddress('hello@iconiz.io');
        // 添加多个收件人 则多次调用方法即可
        //$mail->addAddress('87654321@163.com');
        // 添加该邮件的主题
        $mail->Subject = '邮件主题';
        // 添加邮件正文
        $mail->Body = $email_message;
        // 为该邮件添加附件
        $mail->addAttachment($_FILES["whitepaper"]["tmp_name"], $_FILES["whitepaper"]["name"]);
        // 发送邮件 返回状态
        $status = $mail->send();


        echo json_encode($status);
    // } catch (Exception $e) {
    //     echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
    // }

    ?>
    <?php
}
die();
?>
