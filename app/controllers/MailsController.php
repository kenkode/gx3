<?php

class MailsController extends \BaseController {

	/**
	 * Display a listing of mails
	 *
	 * @return Response
	 */
	public function index()
	{
		$mails = Mailsender::all();

		return View::make('mails.index', compact('mails'));
	}

	/**
	 * Show the form for creating a new mail
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('mails.create');
	}

	/**
	 * Store a newly created mail in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Validator::make($data = Input::all(), Mailsender::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$mail = Mailsender::find(1);

		$mail->driver = Input::get('driver');
		$mail->host = Input::get('host');
		$mail->username = Input::get('email');
		$mail->password = Input::get('password');
		$mail->port = Input::get('port');
		$mail->encryption = Input::get('encryption');
		$mail->update();

		return Redirect::to('mail');
	}

	/**
	 * Display the specified mail.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$mail = Mailsender::findOrFail($id);

		return View::make('mails.show', compact('mail'));
	}

	/**
	 * Show the form for editing the specified mail.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$mail = Mailsender::find($id);

		return View::make('mails.edit', compact('mail'));
	}

	/**
	 * Update the specified mail in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$mail = Mail::findOrFail($id);

		$validator = Validator::make($data = Input::all(), Mailsender::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$mail->update($data);

		return Redirect::route('mails.index');
	}

	/**
	 * Remove the specified mail from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Mailsender::destroy($id);

		return Redirect::route('mails.index');
	}


	public function test(){

		

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
        $msg = 'Connection established';
    } catch (Swift_TransportException $e) {
        $msg = $e->getMessage();
    } catch (Exception $e) {
      $msg = $e->getMessage();
    }

    	return Redirect::back()->with('notice', $msg);
	}



	

}
