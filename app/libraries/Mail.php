<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of Mail
 *
 * @author tbesarab
 */
class Mail
{
    public function __construct() 
    {
        $this->CI = & get_instance();
        $this->CI->load->config('my_config', TRUE);
    }
    
    public function send_mail($to = '', $mail_to, $subject, $message, $headers = '')
    {
        $SEND =	"Date: ".date("D, d M Y H:i:s") . " UT\r\n";
	$SEND .= 'Subject: =?'.$this->CI->config->item('smtp_charset', 'my_config').'?B?'.base64_encode($subject)."=?=\r\n";
	if ($headers) $SEND .= $headers."\r\n\r\n";
	else
	{
			$SEND .= "Reply-To: ".$this->CI->config->item('smtp_username', 'my_config')."\r\n";
			$SEND .= "To: \"=?".$this->CI->config->item('smtp_charset', 'my_config')."?B?".base64_encode($to)."=?=\" <$mail_to>\r\n";
			$SEND .= "MIME-Version: 1.0\r\n";
			$SEND .= "Content-Type: text/html; charset=\"".$this->CI->config->item('smtp_charset', 'my_config')."\"\r\n";
			$SEND .= "Content-Transfer-Encoding: 8bit\r\n";
			$SEND .= "From: \"=?".$this->CI->config->item('smtp_charset', 'my_config')."?B?".base64_encode($this->CI->config->item('smtp_from', 'my_config'))."=?=\" <".$this->CI->config->item('smtp_username', 'my_config').">\r\n";
			$SEND .= "X-Priority: 3\r\n\r\n";
	}
	$SEND .=  $message."\r\n";
        
	 if( !$socket = fsockopen($this->CI->config->item('smtp_host', 'my_config'), $this->CI->config->item('smtp_port', 'my_config'), $errno, $errstr, 30) ) {
		if ($this->CI->config->item('smtp_debug', 'my_config')) echo $errno."<br>".$errstr;
		return false;
	 }
 
	if (!$this->server_parse($socket, "220", __LINE__)) return false;
 
	fputs($socket, "HELO " . $this->CI->config->item('smtp_host', 'my_config') . "\r\n");
	if (!$this->server_parse($socket, "250", __LINE__)) {
		if ($this->CI->config->item('smtp_debug', 'my_config')) echo '<p>Не могу отправить HELO!</p>';
		fclose($socket);
		return false;
	}
	fputs($socket, "AUTH LOGIN\r\n");
	if (!$this->server_parse($socket, "334", __LINE__)) {
		if ($this->CI->config->item('smtp_debug', 'my_config')) echo '<p>Не могу найти ответ на запрос авторизаци.</p>';
		fclose($socket);
		return false;
	}
	fputs($socket, base64_encode($this->CI->config->item('smtp_username', 'my_config')) . "\r\n");
	if (!$this->server_parse($socket, "334", __LINE__)) {
		if ($this->CI->config->item('smtp_debug', 'my_config')) echo '<p>Логин авторизации не был принят сервером!</p>';
		fclose($socket);
		return false;
	}
	fputs($socket, base64_encode($this->CI->config->item('smtp_password', 'my_config')) . "\r\n");
	if (!$this->server_parse($socket, "235", __LINE__)) {
		if ($this->CI->config->item('smtp_debug', 'my_config')) echo '<p>Пароль не был принят сервером как верный! Ошибка авторизации!</p>';
		fclose($socket);
		return false;
	}
	fputs($socket, "MAIL FROM: <".$this->CI->config->item('smtp_username', 'my_config').">\r\n");
	if (!$this->server_parse($socket, "250", __LINE__)) {
		if ($this->CI->config->item('smtp_debug', 'my_config')) echo '<p>Не могу отправить комманду MAIL FROM: </p>';
		fclose($socket);
		return false;
	}
	fputs($socket, "RCPT TO: <" . $mail_to . ">\r\n");
 
	if (!$this->server_parse($socket, "250", __LINE__)) {
		if ($this->CI->config->item('smtp_debug', 'my_config')) echo '<p>Не могу отправить комманду RCPT TO: </p>';
		fclose($socket);
		return false;
	}
	fputs($socket, "DATA\r\n");
 
	if (!$this->server_parse($socket, "354", __LINE__)) {
		if ($this->CI->config->item('smtp_debug', 'my_config')) echo '<p>Не могу отправить комманду DATA</p>';
		fclose($socket);
		return false;
	}
	fputs($socket, $SEND."\r\n.\r\n");
 
	if (!$this->server_parse($socket, "250", __LINE__)) {
		if ($this->CI->config->item('smtp_debug', 'my_config')) echo '<p>Не смог отправить тело письма. Письмо не было отправленно!</p>';
		fclose($socket);
		return false;
	}
	fputs($socket, "QUIT\r\n");
	fclose($socket);
	return TRUE;
}
 
    public function server_parse($socket, $response, $line = __LINE__) 
    {
	while (@substr($server_response, 3, 1) != ' ') {
		if (!($server_response = fgets($socket, 256))) {
			if ($this->CI->config->item('smtp_debug', 'my_config')) echo "<p>Проблемы с отправкой почты!</p>$response<br>$line<br>";
 			return false;
 		}
	}
	if (!(substr($server_response, 0, 3) == $response)) {
		if ($this->CI->config->item('smtp_debug', 'my_config')) echo "<p>Проблемы с отправкой почты!</p>$response<br>$line<br>";
		return false;
	}
	return true;
    }
}
