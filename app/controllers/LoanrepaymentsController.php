<?php

class LoanrepaymentsController extends \BaseController {

	/**
	 * Display a listing of loanrepayments
	 *
	 * @return Response
	 */
	public function index()
	{
		$loanrepayments = Loanrepayment::all();

		return View::make('loanrepayments.index', compact('loanrepayments'));
	}

	/**
	 * Show the form for creating a new loanrepayment
	 *
	 * @return Response
	 */
	public function create($id)
	{

		$loanaccount = Loanaccount::findOrFail($id);

		$loanbalance = Loantransaction::getLoanBalance($loanaccount);

		$principal_due = Loantransaction::getPrincipalDue($loanaccount);

		$interest = Loanaccount::getInterestAmount($loanaccount);

		$interest_due = Loantransaction::getInterestDue($loanaccount);

		return View::make('loanrepayments.create', compact('loanaccount', 'principal_due', 'interest_due', 'loanbalance', 'interest'));
	}

	/**
	 * Store a newly created loanrepayment in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Validator::make($data = Input::all(), Loanrepayment::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$loanaccount = Input::get('loanaccount_id');
		Loanrepayment::repayLoan($data);

		return Redirect::to('loans/show/'.$loanaccount);
	}



	public function offsetloan()
	{
		$validator = Validator::make($data = Input::all(), Loanrepayment::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$loanaccount = Input::get('loanaccount_id');
		Loanrepayment::offsetLoan($data);

		return Redirect::to('loans/show/'.$loanaccount);
	}

	/**
	 * Display the specified loanrepayment.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$loanrepayment = Loanrepayment::findOrFail($id);

		return View::make('loanrepayments.show', compact('loanrepayment'));
	}

	/**
	 * Show the form for editing the specified loanrepayment.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$loanrepayment = Loanrepayment::find($id);

		return View::make('loanrepayments.edit', compact('loanrepayment'));
	}

	/**
	 * Update the specified loanrepayment in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$loanrepayment = Loanrepayment::findOrFail($id);

		$validator = Validator::make($data = Input::all(), Loanrepayment::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$loanrepayment->update($data);

		return Redirect::route('loanrepayments.index');
	}

	/**
	 * Remove the specified loanrepayment from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Loanrepayment::destroy($id);

		return Redirect::route('loanrepayments.index');
	}


	public function offset($id){

		$loanaccount = Loanaccount::findOrFail($id);

		$principal_paid = Loanrepayment::getPrincipalPaid($loanaccount);

		$principal_due = $loanaccount->amount_disbursed - $principal_paid;

		$interest_due = Loanaccount::intBalOffset($loanaccount);

		return View::make('loanrepayments.offset', compact('loanaccount', 'principal_due', 'interest_due', 'principal_paid'));
	}


	public function offprint($id){


		$loanaccount = Loanaccount::findOrFail($id);

		$organization = Organization::find(1);

		$principal_paid = Loanrepayment::getPrincipalPaid($loanaccount);

		$principal_due = $loanaccount->amount_disbursed - $principal_paid;

		$interest_due = $principal_due * ($loanaccount->interest_rate / 100);


		$pdf = PDF::loadView('pdf.offset', compact('loanaccount', 'organization', 'principal_paid', 'interest_due', 'principal_due'))->setPaper('a4')->setOrientation('potrait');
 	
		return $pdf->stream('Offset.pdf');


	}

}
