<?php
	$msg_box = ""; 
	
	if($_POST['btn_submit']){
		$errors = array(); 
		
		if($_POST['user_name'] == "") 	 $errors[] = "insert username!";
		if($_POST['user_email'] == "") 	 $errors[] = "insert  e-mail!";
		if($_POST['text_comment'] == "") $errors[] = "insert text!";

		
		if(empty($errors)){		
			
			$message  = "From: " . $_POST['user_name'] . "<br/>";
			$message .= "E-mail: " . $_POST['user_email'] . "<br/>";
			$message .= "Text: " . $_POST['text_comment'];		
			send_mail($message); 
			
			$msg_box = "<span style='color: green;'>Сообщение успешно отправлено!</span>";
		}else{
			
			$msg_box = "";
			foreach($errors as $one_error){
				$msg_box .= "<span style='color: red;'>$one_error</span><br/>";
			}
		}
	}
	
	
	function send_mail($message){
		// Post to which the letter will be sent
		$mail_to = "turboblack@впишите здесь ваш адрес электронной почты"; 
		// Title and subject of the letter
		$subject = "torba.tk feedback letter";
		
		
		$headers= "MIME-Version: 1.0\r\n";
		$headers .= "Content-type: text/html; charset=utf-8\r\n"; 
		$headers .= "From: torba.tk <no-reply@torba.tk>\r\n"; 
		
		 
		mail($mail_to, $subject, $message, $headers);
	}
?>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>

	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Feedback</title>
</head>
<body>
	<br/>
	<?= $msg_box;  ?>
	<br/>
	<form action="<?=$_SERVER['PHP_SELF'];?>" method="post" name="frm_feedback">
		<font color="black"><label>Ваше имя:</label><br/></font>
		<font color="black"><input type="text" name="user_name" value="<?=($_POST['user_name']) ? $_POST['user_name'] : ""; ?>" /><br/></font>
		
		<font color="black"><label>Ваш e-mail:</label><br/></font>
		<font color="black"><input type="text" name="user_email" value="<?=($_POST['user_email']) ? $_POST['user_email'] : ""; ?>" /><br/></font>
		
		<font color="black"><label>Текст сообщения:</label><br/></font>
		<font color="black"><textarea name="text_comment"><?=($_POST['text_comment']) ? $_POST['text_comment'] : ""; ?></textarea></font>
		
		<br/>
		<font color="blue"><input type="submit" value="Отправить!" name="btn_submit" /></font>
	</form>
