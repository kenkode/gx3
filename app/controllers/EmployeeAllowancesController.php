<?php

class EmployeeAllowancesController extends \BaseController {

	/**
	 * Display a listing of branches
	 *
	 * @return Response
	 */
	public function index()
	{
		$eallws = EAllowances::all();

		Audit::logaudit('Employee Allowances', 'view', 'viewed employee allowances');

		return View::make('employee_allowances.index', compact('eallws'));
	}

	/**
	 * Show the form for creating a new branch
	 *
	 * @return Response
	 */
	public function create()
	{
		$employees = Employee::all();
		$allowances = Allowance::all();
		return View::make('employee_allowances.create',compact('employees','allowances'));
	}

	/**
	 * Store a newly created branch in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Validator::make($data = Input::all(), EAllowances::$rules, EAllowances::$messages);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$allowance = new EAllowances;

		$allowance->employee_id = Input::get('employee');

		$allowance->allowance_id = Input::get('allowance');

        $allowance->allowance_amount = Input::get('amount');

		$allowance->save();

		

		Audit::logaudit('Employee Allowances', 'create', 'assigned: '.$allowance->allowance_amount.' to'.Employee::getEmployeeName(Input::get('employee')));

		return Redirect::route('employee_allowances.index');
	}

	/**
	 * Display the specified branch.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$eallw = EAllowances::findOrFail($id);

		return View::make('employee_allowances.show', compact('eallw'));
	}

	/**
	 * Show the form for editing the specified branch.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$eallw = EAllowances::find($id);
		$employees = Employee::all();
		$allowances = Allowance::all();

		return View::make('employee_allowances.edit', compact('eallw','allowances','employees'));
	}

	/**
	 * Update the specified branch in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$allowance = EAllowances::findOrFail($id);

		$validator = Validator::make($data = Input::all(), EAllowances::$rules, EAllowances::$messages);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$allowance->employee_id = Input::get('employee');

		$allowance->allowance_id = Input::get('allowance');

        $allowance->allowance_amount = Input::get('amount');

		$allowance->update();

		Audit::logaudit('Employee Allowances', 'update', 'assigned: '.$allowance->allowance_amount.' to'.Employee::getEmployeeName(Input::get('employee')));


		return Redirect::route('employee_allowances.index');
	}

	/**
	 * Remove the specified branch from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$allowance = EAllowances::findOrFail($id);

		EAllowances::destroy($id);


		Audit::logaudit('Employee Allowances', 'delete', 'deleted: '.$allowance->allowance_amount);


		return Redirect::route('employee_allowances.index');
	}

}
