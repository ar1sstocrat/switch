<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* Name:  Ion Auth Lang - Russian (UTF-8)
*
* Author: Ben Edmunds
* 		  ben.edmunds@gmail.com
*         @benedmunds
* Translation:  Petrosyan R.
*             for@petrosyan.rv.ua
*
* Location: http://github.com/benedmunds/ion_auth/
*
* Created:  03.26.2010
*
* Description:  Russian language file for Ion Auth messages and errors
*
*/

// Account Creation
$lang['account_creation_successful'] 	  	 = 'Учетная запись успешно создана';
$lang['account_creation_unsuccessful'] 	 	 = 'Невозможно создать учетную запись';
$lang['account_creation_duplicate_email'] 	 = 'Электронная почта используется или некорректна';
$lang['account_creation_duplicate_username'] 	 = 'Имя пользователя существует или некорректно';

// Password
$lang['password_change_successful'] 	 	 = 'Пароль успешно изменен';
$lang['password_change_unsuccessful'] 	  	 = 'Пароль невозможно изменить';
$lang['forgot_password_successful'] 	 	 = 'Пароль сброшен. На электронную почту отправлено сообщение';
$lang['forgot_password_unsuccessful'] 	 	 = 'Невозможен сброс пароля';

// Activation
$lang['activate_successful'] 		  	 = 'Учетная запись активирована';
$lang['activate_unsuccessful'] 		 	 = 'Не удалось активировать учетную запись';
$lang['deactivate_successful'] 		  	 = 'Учетная запись деактивирована';
$lang['deactivate_unsuccessful'] 	  	 = 'Невозможно деактивировать учетную запись';
$lang['activation_email_successful'] 	  	 = 'Сообщение об активации отправлено';
$lang['activation_email_unsuccessful']   	 = 'Сообщение об активации невозможно отправить';

// Login / Logout
$lang['login_successful'] 		  	 = 'Авторизация прошла успешно';
$lang['login_unsuccessful'] 		  	 = 'Логин/пароль не верен';
$lang['logout_successful'] 		 	 = 'Выход успешный';

// Account Changes
$lang['update_successful'] 		 	 = 'Учетная запись успешно обновлена';
$lang['update_unsuccessful'] 		 	 = 'Невозможно обновить учетную запись';
$lang['delete_successful'] 		 	 = 'Учетная запись удалена';
$lang['delete_unsuccessful'] 		 	 = 'Невозможно удалить учетную запись';

// Email Subjects - TODO Please Translate
$lang['email_forgotten_password_subject']    = 'Восстановление забытого пароля';
$lang['email_new_password_subject']          = 'Новый пароль';
$lang['email_activation_subject']            = 'Активация учетной записи';
$lang['email_forgot_password_heading']       = 'Сброс пароля для пользователя %s';
$lang['email_forgot_password_subheading']    = 'Нажмите на ссылку для %s.';
$lang['email_forgot_password_link']          = 'восстановления пароля';
$site = site_url();
$lang['email_forgot_password_hbody']         = "Это письмо отправлено с сайта $site.<br><br>  Вы получили это письмо, так как этот e-mail адрес был использован при регистрации на сайте. Если Вы не отправляли запрос на восстановление пароля, просто проигнорируйте это письмо и удалите его.<br><br>------------------------------------------------<br>Инструкция по восстановлению<br>------------------------------------------------";
$lang['email_forgot_password_fbody']         = 'Если и при этих действиях ничего не получилось, возможно Ваш аккаунт удалён. В этом случае, обратитесь к Администратору, для разрешения проблемы.';
$lang['email_forgot_password_footer']        = "--<br>С уважением,<br>Администрация $site";