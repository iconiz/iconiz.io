<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if (!isset($_POST['apply_name']) || empty($_POST['apply_name'])) {
    echo "Your Name is empty.";
    die();
}
if (!isset($_POST['apply_company_name']) || empty($_POST['apply_company_name'])) {
    echo "Your Company Name is empty.";
    die();
}
if (!isset($_POST['apply_email']) || empty($_POST['apply_email'])) {
    echo "Your Email is empty.";
    die();
}
if (!isset($_FILES["whitepaper"]["name"]) || empty($_FILES["whitepaper"]["name"])) {
    echo "Your White paper is empty.";
    die();
}
require "Exception.php";
require "PHPMailer.php";
require "SMTP.php";

$apply_name = $_POST['apply_name']; // required
$apply_company_name = $_POST['apply_company_name']; // required
$apply_email = $_POST['apply_email']; // required

$email_message = "Form details below.\r\n";
$email_message .= "Name: " . $apply_name . "\r\n";
$email_message .= "Company Name: " . $apply_company_name . "\r\n";
$email_message .= "Email: " . $apply_email . "\r\n";
// 实例化PHPMailer核心类
$mail = new PHPMailer(true);
// Passing `true` enables exceptions
try {
    // 是否启用smtp的debug进行调试 开发环境建议开启 生产环境注释掉即可 默认关闭debug调试模式
    // $mail->SMTPDebug = 2;
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
    $mail->FromName = '白皮书投递';
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
    // 添加该邮件的主题
    $mail->Subject = 'Whitepaper';
    // 添加邮件正文
    $mail->Body = $email_message;
    // 为该邮件添加附件
    $mail->addAttachment($_FILES["whitepaper"]["tmp_name"], $_FILES["whitepaper"]["name"]);
    // 发送邮件 返回状态
    $mail->send();
    echo 'success';
} catch (Exception $e) {
    echo 'Message could not be sent. Mailer Error: ' . $mail->ErrorInfo;
}
