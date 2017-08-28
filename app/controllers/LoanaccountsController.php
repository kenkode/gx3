<?php

class LoanaccountsController extends \BaseController {

	/**
	 * Display a listing of loanaccounts
	 *
	 * @return Response
	 */
	public function index()
	{
		$loanaccounts = Loanaccount::all();

		return View::make('loanaccounts.index', compact('loanaccounts'));
	}

	/**
	 * Show the form for creating a new loanaccount
	 *
	 * @return Response
	 */
	public function apply($id)
	{

		$member = Member::find($id);
		$loanproducts = Loanproduct::all();
		return View::make('loanaccounts.create', compact('member', 'loanproducts'));
	}



	public function apply2($id)
	{

		$member = Member::find($id);

		$loanproducts = Loanproduct::all();

		return View::make('css.loancreate', compact('member', 'loanproducts'));
	}

	/**
	 * Store a newly created loanaccount in storage.
	 *
	 * @return Response
	 */
	public function doapply()
	{
		$validator = Validator::make($data = Input::all(), Loanaccount::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		Loanaccount::submitApplication($data);

		$id = array_get($data, 'member_id');

		return Redirect::to('loans');



	}



	public function doapply2()
	{
		$validator = Validator::make($data = Input::all(), Loanaccount::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		Loanaccount::submitApplication($data);

		$id = array_get($data, 'member_id');

		return Redirect::to('memberloans');



	}


public function shopapplication()
	{

		$data =Input::all();


		

		
		


		Loanaccount::submitShopApplication($data);
		


		//$id = array_get($data, 'member_id');

		return Redirect::to('memberloans');

	

	}

	/**
	 * Display the specified loanaccount.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$loanaccount = Loanaccount::findOrFail($id);
		$interest = Loanaccount::getInterestAmount($loanaccount);
		$loanbalance = Loantransaction::getLoanBalance($loanaccount);
		$principal_paid = Loanrepayment::getPrincipalPaid($loanaccount);
		$interest_paid = Loanrepayment::getInterestPaid($loanaccount);
		$loanguarantors = $loanaccount->guarantors;

		$loantransactions = DB::table('loantransactions')->where('loanaccount_id', '=', $id)->orderBy('id', 'DESC')->get();
		
		return View::make('loanaccounts.show', compact('loanaccount', 'loanguarantors', 'interest', 'principal_paid', 'interest_paid', 'loanbalance', 'loantransactions'));
	}




	public function show2($id)
	{
		$loanaccount = Loanaccount::findOrFail($id);
		$interest = Loanaccount::getInterestAmount($loanaccount);
		$loanbalance = Loantransaction::getLoanBalance($loanaccount);
		$principal_paid = Loanrepayment::getPrincipalPaid($loanaccount);
		$interest_paid = Loanrepayment::getInterestPaid($loanaccount);
		$loanguarantors = $loanaccount->guarantors;
		
		return View::make('css.loanshow', compact('loanaccount', 'loanguarantors', 'interest', 'principal_paid', 'interest_paid', 'loanbalance'));
	}

	/**
	 * Show the form for editing the specified loanaccount.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$loanaccount = Loanaccount::find($id);

		return View::make('loanaccounts.edit', compact('loanaccount'));
	}

	/**
	 * Update the specified loanaccount in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$loanaccount = Loanaccount::findOrFail($id);

		$validator = Validator::make($data = Input::all(), Loanaccount::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$loanaccount->update($data);

		return Redirect::route('loanaccounts.index');
	}

	/**
	 * Remove the specified loanaccount from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Loanaccount::destroy($id);

		return Redirect::route('loanaccounts.index');
	}




	public function approve($id)
	{
		$loanaccount = Loanaccount::find($id);

		return View::make('loanaccounts.approve', compact('loanaccount'));
	}

	/**
	 * Update the specified loanaccount in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function doapprove($id)
	{
		//$loanaccount =  new Loanaccount;

		$validator = Validator::make($data = Input::all(), Loanaccount::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		//$loanaccount->approve($data);


		$loanaccount_id = array_get($data, 'loanaccount_id');

		

		$loanaccount = Loanaccount::findorfail($loanaccount_id);


		


		$loanaccount->date_approved = array_get($data, 'date_approved');
		$loanaccount->amount_approved = array_get($data, 'amount_approved');
		$loanaccount->interest_rate = array_get($data, 'interest_rate');
		$loanaccount->period = array_get($data, 'period');
		$loanaccount->is_approved = TRUE;
		$loanaccount->is_new_application = FALSE;
		$loanaccount->update();

		return Redirect::route('loans.index');
	}



	public function disburse($id)
	{
		$loanaccount = Loanaccount::find($id);

		return View::make('loanaccounts.disburse', compact('loanaccount'));
	}

	/**
	 * Update the specified loanaccount in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function dodisburse($id)
	{
		//$loanaccount =  new Loanaccount;

		$validator = Validator::make($data = Input::all(), Loanaccount::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		//$loanaccount->approve($data);


		$loanaccount_id = array_get($data, 'loanaccount_id');

		

		$loanaccount = Loanaccount::findorfail($loanaccount_id);


		$amount = array_get($data, 'amount_disbursed');
		$date = array_get($data, 'date_disbursed');

		$loanaccount->date_disbursed = $date;
		$loanaccount->amount_disbursed = $amount;
		$loanaccount->repayment_start_date = array_get($data, 'repayment_start_date');
		$loanaccount->account_number = Loanaccount::loanAccountNumber($loanaccount);
		$loanaccount->is_disbursed = TRUE;
		
	
		$loanaccount->update();

		$loanamount = $amount + Loanaccount::getInterestAmount($loanaccount);
		Loantransaction::disburseLoan($loanaccount, $loanamount, $date);

		return Redirect::route('loans.index');
	}



	public function gettopup($id){

		$loanaccount = Loanaccount::findOrFail($id);


		return View::make('loanaccounts.topup', compact('loanaccount'));
	}



	public function topup($id){

		
		$data = Input::all();
		
		$date =  Input::get('top_up_date');
		$amount = Input::get('amount');

	
		$loanaccount = Loanaccount::findOrFail($id);



		$loanaccount->is_top_up = true;
		$loanaccount->top_up_amount = $amount;
		$loanaccount->top_up_date = $date;
		$loanaccount->update();

		Loantransaction::topupLoan($loanaccount, $amount, $date);


		 return Redirect::to('loans/show/'.$loanaccount->id);

		

		
	}


}
