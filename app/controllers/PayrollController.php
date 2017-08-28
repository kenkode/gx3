<?php

class PayrollController extends \BaseController {

	/**
	 * Display a listing of branches
	 *
	 * @return Response
	 */
	public function index()
	{
        $accounts = Account::all();

		return View::make('payroll.index', compact('accounts'));
	}

    public function preview_payroll()
	{
		$employee = Employee::all();

		//print_r($accounts);

		Audit::logaudit('Payroll', 'preview', 'previewed payroll');


		return View::make('payroll.preview', compact('employee'));
	}

    public function valid()
	{
		$period = Input::get('period');

		//print_r($accounts);

		return View::make('payroll.valid', compact('period'));
	}

	/**
	 * Show the form for creating a new branch
	 *
	 * @return Response
	 */
	public function create()
	{
		$employees = Employee::all();
		$period = Input::get('period');
		$account = Input::get('account');

		//print_r($accounts);

		Audit::logaudit('Payroll', 'preview', 'previewed payroll');

		return View::make('payroll.preview', compact('employees','period','account'));
	}

	public function del_exist()
	{
    $postedit = Input::all();
    $part1    = $postedit['period1'];
    $part2    = $postedit['period2'];
    $part3    = $postedit['period3'];
    $period   = $part1.$part2.$part3;  
    $data     = DB::table('transact')->where('financial_month_year',$period)->delete(); 
    $data2    = DB::table('transact_allowances')->where('financial_month_year', '=', $period)->delete();
    $data3    = DB::table('transact_deductions')->where('financial_month_year', '=', $period)->delete();
    $data4    = DB::table('transact_earnings')->where('financial_month_year', '=', $period)->delete();
    if($data > 0){
      return 0;
    }else{
      return 1;
    }
    exit();
	}

	/**
	 * Store a newly created branch in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$employees = Employee::all();

		foreach ($employees as $employee) {
		$payroll = new Payroll;

		$payroll->employee_id = $employee->personal_file_number;
		$payroll->basic_pay = $employee->basic_pay; 
        $payroll->earning_amount = Payroll::total_benefits($employee->id);
		$payroll->taxable_income = Payroll::gross($employee->id);
		$payroll->paye = Payroll::tax($employee->id);
		$payroll->nssf_amount = Payroll::nssf($employee->id);
		$payroll->nhif_amount = Payroll::nhif($employee->id);
		$payroll->other_deductions = Payroll::deductions($employee->id);
		$payroll->total_deductions = Payroll::total_deductions($employee->id);
		$payroll->net = Payroll::net($employee->id);
		$payroll->financial_month_year = Input::get('period');
        $payroll->account_id = Input::get('account');
        $payroll->save();
		}
	
	    $allws = DB::table('employee_allowances')
            ->join('allowances', 'employee_allowances.allowance_id', '=', 'allowances.id')
            ->join('employee', 'employee_allowances.employee_id', '=', 'employee.id')
            ->join('transact', 'employee.personal_file_number', '=', 'transact.employee_id')
            ->select('employee.id','allowance_name','allowance_id','allowance_amount','financial_month_year')
            ->get();

	    foreach($allws as $allw){
        DB::table('transact_allowances')->insert(
        ['employee_id' => $allw->id, 
        'allowance_name' => $allw->allowance_name,
        'allowance_id' => $allw->allowance_id,
        'allowance_amount' => $allw->allowance_amount,
        'financial_month_year'=>$allw->financial_month_year,
        ]
        );
        }

        $deds = DB::table('employee_deductions')
            ->join('deductions', 'employee_deductions.deduction_id', '=', 'deductions.id')
            ->join('employee', 'employee_deductions.employee_id', '=', 'employee.id')
            ->join('transact', 'employee.personal_file_number', '=', 'transact.employee_id')
            ->select('employee.id','deduction_name','deduction_id','deduction_amount','financial_month_year')
            ->get();

	    foreach($deds as $ded){
        DB::table('transact_deductions')->insert(
        ['employee_id' => $ded->id, 
        'deduction_name' => $ded->deduction_name,
        'deduction_id' => $ded->deduction_id,
        'deduction_amount' => $ded->deduction_amount,
        'financial_month_year'=>$ded->financial_month_year,
        ]
        );
        }

        $earns = DB::table('earnings')
            ->join('employee', 'earnings.employee_id', '=', 'employee.id')
            ->join('transact', 'employee.personal_file_number', '=', 'transact.employee_id')
            ->select('earnings.employee_id','earnings_name','financial_month_year','earnings_amount')
            ->get();

	    foreach($earns as $earn){
        DB::table('transact_earnings')->insert(
        ['employee_id' => $earn->employee_id, 
        'earning_name' => $earn->earnings_name,
        'earning_amount' => $earn->earnings_amount,
        'financial_month_year'=>$earn->financial_month_year,
        ]
        );
        }

        $period = Input::get('period'); 
        Audit::logaudit('Payroll', 'process', 'processed payroll for '.$period);
    
	return Redirect::route('payroll.index')->withFlashMessage('Payroll successfully processed!');
     
	}

	

	/**
	 * Display the specified branch.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$payroll = Payroll::findOrFail($id);

		return View::make('payroll.show', compact('payroll'));
	}

	/**
	 * Show the form for editing the specified branch.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$deduction = Deduction::find($id);

		return View::make('deductions.edit', compact('deduction'));
	}

	/**
	 * Update the specified branch in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$deduction = Deduction::findOrFail($id);

		$validator = Validator::make($data = Input::all(), Deduction::$rules, Deduction::$messages);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$deduction->deduction_name = Input::get('name');
		$deduction->update();

		return Redirect::route('deductions.index');
	}

	/**
	 * Remove the specified branch from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Deduction::destroy($id);

		return Redirect::route('deductions.index');
	}

}
