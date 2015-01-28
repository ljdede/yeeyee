<?php
namespace Home\Controller;
use Think\Controller;
class EmailController extends Controller {
	// 发出邮件的函数
	public function think_send_mail($to, $name, $subject = '', $body = '', $attachment = null){
		//从PHPMailer目录导入
		vendor('PHPMailer.class#smtp');
		$config = C('THINK_EMAIL');
		//从PHPMailer目录导class.phpmailer.php类文件
		vendor('PHPMailer.class#phpmailer');

		//PHPMailer对象
		$mail = new \PHPMailer();
		$mail->CharSet = 'UTF-8';
		// 设定使用SMTP服务
		$mail->IsSMTP(); 
		// 关闭SMTP调试功能
			// 1 = errors and messages
			// 2 = messages only
		$mail->SMTPDebug = 0;
		// 启用 SMTP 验证功能
		$mail->SMTPAuth = true;
		// 使用安全协议
		$mail->SMTPSecure = 'ssl';
		// SMTP 服务器
		$mail->Host = $config['SMTP_HOST'];
		// SMTP服务器的端口号
		$mail->Port = $config['SMTP_PORT'];
		// SMTP服务器用户名
		$mail->Username = $config['SMTP_USER'];
		// SMTP服务器密码
		$mail->Password = $config['SMTP_PASS'];
		$mail->SetFrom($config['FROM_EMAIL'], $config['FROM_NAME']);
		$replyEmail = $config['REPLY_EMAIL']?$config['REPLY_EMAIL']:$config['FROM_EMAIL'];
		$replyName = $config['REPLY_NAME']?$config['REPLY_NAME']:$config['FROM_NAME'];
		$mail->AddReplyTo($replyEmail, $replyName);
		$mail->Subject = $subject;
		$mail->MsgHTML($body);
		$mail->AddAddress($to, $name);
		// 添加附件
	    if(is_array($attachment)){
			foreach ($attachment as $file){
				is_file($file) && $mail->AddAttachment($file);
			}
		}
		return $mail->Send() ? true : $mail->ErrorInfo;
	}
}