<?php

class LeaveapplicationsController extends \BaseController {

	/**
	 * Display a listing of leaveapplications
	 *
	 * @return Response
	 */
	public function index()
	{
		$leaveapplications = Leaveapplication::all();

		return Redirect::to('leavemgmt');
	}

	/**
	 * Show the form for creating a new leaveapplication
	 *
	 * @return Response
	 */
	public function create()
	{
		$employees = Employee::all();

		$leavetypes = Leavetype::all();

		return View::make('leaveapplications.create', compact('employees', 'leavetypes'));
	}

	/**
	 * Store a newly created leaveapplication in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Validator::make($data = Input::all(), Leaveapplication::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		Leaveapplication::createLeaveApplication($data);

		return Redirect::to('leavemgmt');
	}

	/**
	 * Display the specified leaveapplication.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$leaveapplication = Leaveapplication::findOrFail($id);

		return View::make('leaveapplications.show', compact('leaveapplication'));
	}

	/**
	 * Show the form for editing the specified leaveapplication.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$leaveapplication = Leaveapplication::find($id);

		$employees = Employee::all();

		$leavetypes = Leavetype::all();

		return View::make('leaveapplications.edit', compact('leaveapplication', 'employees', 'leavetypes'));
	}

	/**
	 * Update the specified leaveapplication in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$leaveapplication = Leaveapplication::findOrFail($id);

		$validator = Validator::make($data = Input::all(), Leaveapplication::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		Leaveapplication::amendLeaveApplication($data, $id);

		return Redirect::to('leavemgmt');
	}

	/**
	 * Remove the specified leaveapplication from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Leaveapplication::destroy($id);

		return Redirect::to('leavemgmt');
	}


	public function approve($id){

		$leaveapplication = Leaveapplication::find($id);

		return View::make('leaveapplications.approve', compact('leaveapplication'));



	}


	public function doApprove($id){



		$data = Input::all();

		Leaveapplication::approveLeaveApplication($data, $id);

		return Redirect::route('leaveapplications.index');

	}


	public function reject($id){

		Leaveapplication::rejectLeaveApplication($id);
		return Redirect::route('leaveapplications.index');

	}

	public function cancel($id){

		Leaveapplication::cancelLeaveApplication($id);
		return Redirect::route('leaveapplications.index');

	}

	public function redeem(){

		$employee = Employee::find(Input::get('employee_id'));
		$leeavetype = Leavetype::find(Input::get('leavetype_id'));

		Leaveapplication::RedeemLeaveDays($employee, $leavetype);

		return Redirect::route('leaveapplications.index');

	}


	public function approvals()
	{
		$leaveapplications = Leaveapplication::all();

		return View::make('leaveapplications.approved', compact('leaveapplications'));
	}


	public function amended()
	{
		$leaveapplications = Leaveapplication::all();

		return View::make('leaveapplications.amended', compact('leaveapplications'));
	}

	public function rejects()
	{
		$leaveapplications = Leaveapplication::all();

		return View::make('leaveapplications.rejected', compact('leaveapplications'));
	}

	public function cancellations()
	{
		$leaveapplications = Leaveapplication::all();

		return View::make('leaveapplications.cancelled', compact('leaveapplications'));
	}

}
