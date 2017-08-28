<?php

class AccountController extends \BaseController {


public function create()
	{
		return View::make('account.create');
	}


public function store()
	{
		$validator = Validator::make($data = Input::all(), Accounts::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$account = new Accounts;

		$account->name = Input::get('name');
		$account->description = Input::get('description');
		$account->category = Input::get('category');
		$account->balance = Input::get('balance');
		if(Input::get('confirmed')){
			$account->confirmed = TRUE;
		}
		else {
			$account->confirmed = FALSE;
		}
		$account->save();


		return Redirect::route('account.index')->withErrors('Successully created');

	}

	public function index()
	{
		$account = Accounts::all();

		return View::make('account.index', compact('account'));
	}


	public function show()
	{
		$banking = Accounts::all();
		$account = Banking::all();
		return View::make('account.banking', compact('account', 'banking'));
	}

	public function recordbanking()
	{
		//$account = Accounts::all();

		$banking = new Banking;

		$banking->account_from = Input::get('account_from');
		$banking->account_to = Input::get('account_to');
		$banking->amount = Input::get('amount');

		$banking->save();

		DB::table('account')->leftjoin('banking','account.name','=','banking.account_from')->where('account.name', '=', $banking->account_from)->decrement('account.balance', $banking->amount);
		DB::table('account')->leftjoin('banking','account.name','=','banking.account_to')->where('account.name', '=', $banking->account_to)->increment('account.balance', $banking->amount);


		return Redirect::back()->withErrors('Successully banked');
	}



   public function edit($id)
	{
		$account = Accounts::find($id);

		return View::make('account.edit', compact('account'));
	}

	/**
	 * Update the specified account in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$account = Accounts::findOrFail($id);

		$validator = Validator::make($data = Input::all(), Accounts::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$account->name = Input::get('name');
		$account->description = Input::get('description');
		$account->category = Input::get('category');

		$account->balance = Input::get('balance');

		if(Input::get('confirmed')){
			$account->confirmed = TRUE;
		}
		else {
			$account->confirmed = FALSE;
		}
		
		$account->update();

		return Redirect::route('account.index')->withErrors('Successully Updated');
	}


/**
    * Delete the account
    *
    */

	public function destroy($id)
	{
		Accounts::destroy($id);

		return Redirect::route('account.index');
	}
		

}