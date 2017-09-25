<?php

class Mailsender extends \Eloquent {

	protected $table = 'mails';
	// Add your validation rules here
	public static $rules = [
		// 'title' => 'required'
	];

	// Don't forget to fill this array
	protected $fillable = [];


	


	public static function host(){

			$mail = Mailsender::find(1);

			return $mail->host;

	}


	public static function port(){

			$mail = Mailsender::find(1);

			return $mail->port;

	}


	public static function username(){

			$mail = Mailsender::find(1);

			return $mail->username;

	}

	public static function encryption(){

			$mail = Mailsender::find(1);

			return $mail->encryption;

	}


	public static function password(){

			$mail = Mailsender::find(1);

			return $mail->password;

	}

	public static function driver(){

			$mail = Mailsender::find(1);

			return $mail->driver;

	}



	public static function checkConnection(){

		

		$host = Mailsender::host();
		$port = Mailsender::port();
		$encryption = Mailsender::encryption();
		$username = Mailsender::username();
		$password = Mailsender::password();



		try{
        $transport = Swift_SmtpTransport::newInstance($host, $port, $encryption);
        $transport->setUsername($username);
        $transport->setPassword($password);
        $mailer = \Swift_Mailer::newInstance($transport);
        $mailer->getTransport()->start();
        return true;
    } catch (Swift_TransportException $e) {
        return false;
    } catch (Exception $e) {
      return false;
    }

    	
	}




}