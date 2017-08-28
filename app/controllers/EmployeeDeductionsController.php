<?php

class EmployeeDeductionsController extends \BaseController {

	/**
	 * Display a listing of branches
	 *
	 * @return Response
	 */
	public function index()
	{
		$deds = EDeduction::all();
		return View::make('employee_deductions.index', compact('deds'));
	}

	/**
	 * Show the form for creating a new branch
	 *
	 * @return Response
	 */
	public function create()
	{
		$employees = Employee::all();
		$deductions = Deduction::all();
		return View::make('employee_deductions.create',compact('employees','deductions'));
	}

	/**
	 * Store a newly created branch in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Validator::make($data = Input::all(), EDeduction::$rules, EDeduction::$messages);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$ded = new EDeduction;

		$ded->employee_id = Input::get('employee');

		$ded->deduction_id = Input::get('deduction');

		$ded->formular = Input::get('formular');

		if(Input::get('formular') == 'Instalments'){
		$ded->instalments = Input::get('instalments');
	    }else{
	    $ded->instalments = '0';
	    }

        $ded->deduction_amount = Input::get('amount');

        $ded->deduction_date = Input::get('ddate');

		$ded->save();

		return Redirect::route('employee_deductions.index');
	}

	/**
	 * Display the specified branch.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$ded = EDeduction::findOrFail($id);

		return View::make('employee_deductions.show', compact('ded'));
	}

	/**
	 * Show the form for editing the specified branch.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$ded = EDeduction::find($id);
		$employees = Employee::all();
        $deductions = Deduction::all();
		return View::make('employee_deductions.edit', compact('ded','employees','deductions'));
	}

	/**
	 * Update the specified branch in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$ded = EDeduction::findOrFail($id);

		$validator = Validator::make($data = Input::all(), EDeduction::$rules, EDeduction::$messages);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$ded->employee_id = Input::get('employee');

		$ded->deduction_id = Input::get('deduction');

		$ded->formular = Input::get('formular');

		if(Input::get('formular') == 'Instalments'){
		$ded->instalments = Input::get('instalments');
	    }else{
	    $ded->instalments = '0';
	    }

        $ded->deduction_amount = Input::get('amount');

        $ded->deduction_date = Input::get('ddate');

		$ded->update();

		return Redirect::route('employee_deductions.index');
	}

	/**
	 * Remove the specified branch from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		EDeduction::destroy($id);

		return Redirect::route('employee_deductions.index');
	}

}
