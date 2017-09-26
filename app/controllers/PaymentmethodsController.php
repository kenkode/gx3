<?php

class PaymentmethodsController extends \BaseController {

	/**
	 * Display a listing of paymentmethods
	 *
	 * @return Response
	 */
	public function index()
	{
		$paymentmethods = Paymentmethod::all();

		if (! Entrust::can('view_payment_methods') ) // Checks the current user
        {
        return Redirect::to('dashboard')->with('notice', 'you do not have access to this resource. Contact your system admin');
        }else{

		return View::make('paymentmethods.index', compact('paymentmethods'));
	}
	}

	/**
	 * Show the form for creating a new paymentmethod
	 *
	 * @return Response
	 */
	public function create()
	{
		$accounts = Account::all();

		if (! Entrust::can('create_payment_methods') ) // Checks the current user
        {
        return Redirect::to('dashboard')->with('notice', 'you do not have access to this resource. Contact your system admin');
        }else{
		return View::make('paymentmethods.create',compact('accounts'));
	}
	}

	/**
	 * Store a newly created paymentmethod in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Validator::make($data = Input::all(), Paymentmethod::$rules, Paymentmethod::$messages);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$paymentmethod = new Paymentmethod;

		$paymentmethod->name = Input::get('name');
		$paymentmethod->account_id = Input::get('account');
		$paymentmethod->save();

		return Redirect::route('paymentmethods.index')->withFlashMessage('Payment Method successfully created!');
	}

	/**
	 * Display the specified paymentmethod.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$paymentmethod = Paymentmethod::findOrFail($id);

        if (! Entrust::can('view_payment_methods') ) // Checks the current user
        {
        return Redirect::to('dashboard')->with('notice', 'you do not have access to this resource. Contact your system admin');
        }else{
		return View::make('paymentmethods.show', compact('paymentmethod'));
	}
	}

	/**
	 * Show the form for editing the specified paymentmethod.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$paymentmethod = Paymentmethod::find($id);
        $accounts = Account::all();

        if (! Entrust::can('update_payment_methods') ) // Checks the current user
        {
        return Redirect::to('dashboard')->with('notice', 'you do not have access to this resource. Contact your system admin');
        }else{
		return View::make('paymentmethods.edit', compact('paymentmethod','accounts'));
	}
	}

	/**
	 * Update the specified paymentmethod in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$paymentmethod = Paymentmethod::findOrFail($id);

		$validator = Validator::make($data = Input::all(), Paymentmethod::$rules, Paymentmethod::$messages);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

        $paymentmethod->name = Input::get('name');
		$paymentmethod->account_id = Input::get('account');
		$paymentmethod->update();

		return Redirect::route('paymentmethods.index')->withFlashMessage('Payment Method successfully updated!');
	}

	/**
	 * Remove the specified paymentmethod from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Paymentmethod::destroy($id);

        if (! Entrust::can('delete_payment_methods') ) // Checks the current user
        {
        return Redirect::to('dashboard')->with('notice', 'you do not have access to this resource. Contact your system admin');
        }else{
		return Redirect::route('paymentmethods.index')->withDeleteMessage('Payment Method successfully deleted!');
	}
	}

}
