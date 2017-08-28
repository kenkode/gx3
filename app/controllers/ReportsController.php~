<?php

class ReportsController extends \BaseController {

	


	public function employees(){

		$employees = Employee::all();

		$organization = Organization::find(1);

		$pdf = PDF::loadView('pdf.employeelist', compact('employees', 'organization'))->setPaper('a4')->setOrientation('potrait');
 	
		return $pdf->stream('Employee List.pdf');
		
	}

	public function emp_id()
	{
		$employees = Employee::all();

		return View::make('pdf.ind_emp', compact('employees'));
	}

    public function individual(){

		$id = Input::get('employeeid');

		$employee = Employee::find($id);

		$organization = Organization::find(1);

		$pdf = PDF::loadView('pdf.individualemployee', compact( 'employee','organization'))->setPaper('a4')->setOrientation('potrait');
 	
		//dd($organization);

		return $pdf->stream($employee->first_name.' '.$employee->last_name.'.pdf');
		
	}

    public function period_payslip()
  {
    $employees = DB::table('employee')->get();

    return View::make('pdf.payslipSelect', compact('employees'));
  }

    public function payslip(){
      if(!empty(Input::get('sel'))){
        $period = Input::get("period");
        
        $id = Input::get('employeeid');

        $employees = Employee::all();

        foreach ($employees as $employee) {

        $transacts = DB::table('transact')
            ->join('employee', 'transact.employee_id', '=', 'employee.personal_file_number')
            ->where('financial_month_year' ,'=', Input::get('period'))
            ->where('employee.id' ,'=', $employee->id)
            ->groupBy('transact.id')
            ->get(); 

        $allws = DB::table('transact_allowances')
            ->join('employee', 'transact_allowances.employee_id', '=', 'employee.id')
            ->where('financial_month_year' ,'=', Input::get('period'))
            ->where('employee.id' ,'=', $employee->id)
            ->groupBy('allowance_name')
            ->get(); 

        $earnings = DB::table('transact_earnings')
            ->join('employee', 'transact_earnings.employee_id', '=', 'employee.id')
            ->where('financial_month_year' ,'=', Input::get('period'))
            ->where('employee.id' ,'=', $employee->id)
            ->groupBy('earning_name')
            ->get(); 

        $deds = DB::table('transact_deductions')
            ->join('employee', 'transact_deductions.employee_id', '=', 'employee.id')
            ->where('financial_month_year' ,'=', Input::get('period'))
            ->where('employee.id' ,'=', $employee->id)
            ->groupBy('deduction_name')
            ->get();    

        $currencies = DB::table('currencies')
            ->select('shortname')
            ->get();

    $organization = Organization::find(1);

    $pdf = PDF::loadView('pdf.monthlySlip', compact('transacts','allws','deds','earnings','period','currencies', 'organization'))->setPaper('a4')->setOrientation('potrait');
    }
    return $pdf->stream('Monthly_Payslip_'.$period.'.pdf');
    }else{
        $period = Input::get("period");
        
        $id = Input::get('employeeid');

        $employee = Employee::find($id);

        $transacts = DB::table('transact')
            ->join('employee', 'transact.employee_id', '=', 'employee.personal_file_number')
            ->where('financial_month_year' ,'=', Input::get('period'))
            ->where('employee.id' ,'=', Input::get('employeeid'))
            ->get(); 

        $allws = DB::table('transact_allowances')
            ->join('employee', 'transact_allowances.employee_id', '=', 'employee.id')
            ->where('financial_month_year' ,'=', Input::get('period'))
            ->where('employee.id' ,'=', Input::get('employeeid'))
            ->groupBy('allowance_name')
            ->get(); 

        $earnings = DB::table('transact_earnings')
            ->join('employee', 'transact_earnings.employee_id', '=', 'employee.id')
            ->where('financial_month_year' ,'=', Input::get('period'))
            ->where('employee.id' ,'=', Input::get('employeeid'))
            ->groupBy('earning_name')
            ->get(); 

        $deds = DB::table('transact_deductions')
            ->join('employee', 'transact_deductions.employee_id', '=', 'employee.id')
            ->where('financial_month_year' ,'=', Input::get('period'))
            ->where('employee.id' ,'=', Input::get('employeeid'))
            ->groupBy('deduction_name')
            ->get();    
 
        $currencies = DB::table('currencies')
            ->select('shortname')
            ->get();

    $organization = Organization::find(1);

    $pdf = PDF::loadView('pdf.monthlySlip', compact('employee','transacts','allws','deds','earnings','period','currencies', 'organization'))->setPaper('a4')->setOrientation('potrait');
  
    return $pdf->stream($employee->first_name.'_'.$employee->last_name.'_'.$period.'.pdf');
    }
    
  }

    public function employee_allowances()
	{
		$allws = DB::table('allowances')->get();

		return View::make('pdf.allowanceSelect', compact('allws'));
	}

    public function allowances(){
    	if(!empty(Input::get('sel'))){
        $period = Input::get("period");
        $allws = DB::table('transact_allowances')
            ->join('employee', 'transact_allowances.employee_id', '=', 'employee.id')
            ->where('financial_month_year' ,'=', Input::get('period'))
            ->select('personal_file_number','first_name','last_name','allowance_name','allowance_amount')
            ->get();   	
 
        $currencies = DB::table('currencies')
            ->select('shortname')
            ->get();

		$organization = Organization::find(1);

		$pdf = PDF::loadView('pdf.allowanceReport', compact('allws','period','currencies', 'organization'))->setPaper('a4')->setOrientation('potrait');
 	
		return $pdf->stream('Allowance_Report_'.$period.'.pdf');
	  }else{
        $period = Input::get("period");
	    $allws = DB::table('transact_allowances')
	        ->join('employee', 'transact_allowances.employee_id', '=', 'employee.id')
            ->join('allowances', 'transact_allowances.allowance_id', '=', 'allowances.id')
            ->where('allowances.id' ,'=', Input::get('allowance'))
            ->where('financial_month_year' ,'=', Input::get('period'))
            ->select('personal_file_number','first_name','last_name','transact_allowances.allowance_name','transact_allowances.allowance_amount')
            ->get();

        $currencies = DB::table('currencies')
            ->select('shortname')
            ->get();

		$organization = Organization::find(1);

		$pdf = PDF::loadView('pdf.allowanceReport', compact('allws','period','currencies', 'organization'))->setPaper('a4')->setOrientation('potrait');
 	
		return $pdf->stream('Allowance_Report_'.$period.'.pdf');
	  }
		
	}

	public function employee_deductions()
	{
		$deds = DB::table('deductions')->get();

		return View::make('pdf.deductionSelect', compact('deds'));
	}

    public function deductions(){
    	if(!empty(Input::get('sel'))){
        $period = Input::get("period");
        $deds = DB::table('transact_deductions')
            ->join('employee', 'transact_deductions.employee_id', '=', 'employee.id')
            ->where('financial_month_year' ,'=', Input::get('period'))
            ->select('personal_file_number','first_name','last_name','deduction_name','deduction_amount')
            ->get();   	
 
        $currencies = DB::table('currencies')
            ->select('shortname')
            ->get();

		$organization = Organization::find(1);

		$pdf = PDF::loadView('pdf.deductionReport', compact('deds','period','currencies', 'organization'))->setPaper('a4')->setOrientation('potrait');
 	
		return $pdf->stream('Deduction_Report_'.$period.'pdf');
	  }else{
        $period = Input::get("period");
	    $deds = DB::table('transact_deductions')
            ->join('employee', 'transact_deductions.employee_id', '=', 'employee.id')
            ->join('deductions', 'transact_deductions.deduction_id', '=', 'deductions.id')
            ->where('deductions.id' ,'=', Input::get('deduction'))
            ->where('financial_month_year' ,'=', Input::get('period'))
            ->select('personal_file_number','first_name','last_name','transact_deductions.deduction_name','transact_deductions.deduction_amount')
            ->get();

        $currencies = DB::table('currencies')
            ->select('shortname')
            ->get();

		$organization = Organization::find(1);

		$pdf = PDF::loadView('pdf.deductionReport', compact('deds','period','currencies', 'organization'))->setPaper('a4')->setOrientation('potrait');
 	
		return $pdf->stream('Deduction_Report_'.$period.'.pdf');
	  }
		
	}

     public function period_paye()
	{
		return View::make('pdf.payeSelect');
	}

    public function payeReturns(){
		$period = Input::get("period");

		$total = DB::table('transact')
        ->where('financial_month_year' ,'=', Input::get('period'))
		->sum('paye');

		$currencies = DB::table('currencies')
            ->select('shortname')
            ->get();

		$payes = DB::table('transact')
            ->join('employee', 'transact.employee_id', '=', 'employee.personal_file_number')
            ->where('financial_month_year' ,'=', Input::get('period'))
            ->get(); 

		$organization = Organization::find(1);

		$pdf = PDF::loadView('pdf.payeReport', compact('payes','total','currencies','period','organization'))->setPaper('a4')->setOrientation('potrait');
 	
		return $pdf->stream('Paye_Returns_'.$period.'.pdf');
		
	}

   public function period_nssf()
	{
		return View::make('pdf.nssfSelect');
	}

    public function nssfReturns(){
		$period = Input::get("period");

		$total = DB::table('transact')
        ->where('financial_month_year' ,'=', Input::get('period'))
		->sum('nssf_amount');

		$currencies = DB::table('currencies')
            ->select('shortname')
            ->get();

		$nssfs = DB::table('transact')
            ->join('employee', 'transact.employee_id', '=', 'employee.personal_file_number')
            ->where('financial_month_year' ,'=', Input::get('period'))
            ->get(); 

		$organization = Organization::find(1);


		$pdf = PDF::loadView('pdf.nssfReport', compact('nssfs','total','currencies','period','organization'))->setPaper('a4')->setOrientation('potrait');
 	
		return $pdf->stream('nssf_Report_'.$period.'.pdf');
		
	}

    public function period_nhif()
	{
		return View::make('pdf.nhifSelect');
	}

    public function nhifReturns(){
		$period = Input::get("period");

		$total = DB::table('transact')
        ->where('financial_month_year' ,'=', Input::get('period'))
		->sum('nhif_amount');

		$currencies = DB::table('currencies')
            ->select('shortname')
            ->get();

		$nhifs = DB::table('transact')
            ->join('employee', 'transact.employee_id', '=', 'employee.personal_file_number')
            ->where('financial_month_year' ,'=', Input::get('period'))
            ->get(); 

		$organization = Organization::find(1);


		$pdf = PDF::loadView('pdf.nhifReport', compact('nhifs','total','currencies','period','organization'))->setPaper('a4')->setOrientation('potrait');
 	
		return $pdf->stream('nhif_Report_'.$period.'.pdf');
		
	}

    public function export(){
    Excel::create('NssfReport', function($excel) {

      $excel->sheet('NssfReport', function($sheet) {
        $period = Input::get("period");

		$total = DB::table('transact')
        ->where('financial_month_year' ,'=', Input::get('period'))
		->sum('nssf_amount');

		$currencies = DB::table('currencies')
            ->select('shortname')
            ->get();

		$nssfs = DB::table('transact')
            ->join('employee', 'transact.employee_id', '=', 'employee.personal_file_number')
            ->where('financial_month_year' ,'=', Input::get('period'))
            ->get(); 

		$organization = Organization::find(1);
        $sheet->loadView('pdf.nssfReport.csv', ['nssfs' => $nssfs->toArray()]);
      });
    })->download('xls');
  }


    public function period_rem()
	{
		$branches = Branch::all();
		$depts = Department::all();
		return View::make('pdf.remittanceSelect',compact('branches','depts'));
	}

    public function payeRems(){
		$period = Input::get("period");
		

        if(!empty(Input::get('selB')) && !empty(Input::get('selD')) && !empty(Input::get('selM'))){

          $total = DB::table('transact')
        ->where('financial_month_year' ,'=', Input::get('period'))
		->sum('net');

		$currencies = DB::table('currencies')
            ->select('shortname')
            ->get();

		$rems = DB::table('transact')
            ->join('employee', 'transact.employee_id', '=', 'employee.personal_file_number')
            ->where('financial_month_year' ,'=', Input::get('period'))
            ->get(); 

		$organization = Organization::find(1);

    $branches=DB::table('bank_branches')
            ->where('organization_id','=',$organization->id)
            ->get();


		$pdf = PDF::loadView('pdf.remittanceReport', compact('rems','branches','total','currencies','period','organization'))->setPaper('a4')->setOrientation('landscape');
 	
		return $pdf->stream('Pay_Remittance_'.$period.'.pdf');

        }else if(!empty(Input::get('selD')) && !empty(Input::get('selM'))){
          $total = DB::table('transact')
          ->join('employee', 'transact.employee_id', '=', 'employee.personal_file_number')
          ->where('branch_id' ,'=', Input::get('branch'))
          ->where('financial_month_year' ,'=', Input::get('period'))
		  ->sum('net');

		$currencies = DB::table('currencies')
            ->select('shortname')
            ->get();

		$rems = DB::table('transact')
            ->join('employee', 'transact.employee_id', '=', 'employee.personal_file_number')
            ->where('branch_id' ,'=', Input::get('branch'))
            ->where('financial_month_year' ,'=', Input::get('period'))
            ->get(); 

		$organization = Organization::find(1);

     $branches=DB::table('bank_branches')
            ->where('organization_id','=',$organization->id)
            ->get();

		$pdf = PDF::loadView('pdf.remittanceReport', compact('rems','branches','total','emps','currencies','period','organization'))->setPaper('a4')->setOrientation('landscape');
 	
		return $pdf->stream('Pay_Remittance_'.$period.'.pdf');

        } else if(!empty(Input::get('selB')) && !empty(Input::get('selM'))){
          $total = DB::table('transact')
          ->join('employee', 'transact.employee_id', '=', 'employee.personal_file_number')
          ->where('department_id' ,'=', Input::get('department'))
          ->where('financial_month_year' ,'=', Input::get('period'))
		  ->sum('net');

		$currencies = DB::table('currencies')
            ->select('shortname')
            ->get();

		$rems = DB::table('transact')
            ->join('employee', 'transact.employee_id', '=', 'employee.personal_file_number')
            ->where('department_id' ,'=', Input::get('department'))
            ->where('financial_month_year' ,'=', Input::get('period'))
            ->get(); 

		$organization = Organization::find(1);

     $branches=DB::table('bank_branches')
            ->where('organization_id','=',$organization->id)
            ->get();

		$pdf = PDF::loadView('pdf.remittanceReport', compact('rems','total','branches','currencies','period','organization'))->setPaper('a4')->setOrientation('landscape');
 	
		return $pdf->stream('Pay_Remittance_'.$period.'.pdf');

        } else if(!empty(Input::get('selB')) && !empty(Input::get('selD'))){
          $total = DB::table('transact')
          ->join('employee', 'transact.employee_id', '=', 'employee.personal_file_number')
          ->where('mode_of_payment' ,'=', Input::get('mode'))
          ->where('financial_month_year' ,'=', Input::get('period'))
		  ->sum('net');

		$currencies = DB::table('currencies')
            ->select('shortname')
            ->get();

		$rems = DB::table('transact')
            ->join('employee', 'transact.employee_id', '=', 'employee.personal_file_number')
            ->where('mode_of_payment' ,'=', Input::get('mode'))
            ->where('financial_month_year' ,'=', Input::get('period'))
            ->get(); 

		$organization = Organization::find(1);

     $branches=DB::table('bank_branches')
            ->where('organization_id','=',$organization->id)
            ->get();

		$pdf = PDF::loadView('pdf.remittanceReport', compact('rems','branches','total','currencies','period','organization'))->setPaper('a4')->setOrientation('landscape');
 	
		return $pdf->stream('Pay_Remittance_'.$period.'.pdf');

        } else if(!empty(Input::get('selB'))){
          $total = DB::table('transact')
          ->join('employee', 'transact.employee_id', '=', 'employee.personal_file_number')
          ->where('department_id' ,'=', Input::get('department'))
          ->where('mode_of_payment' ,'=', Input::get('mode'))
          ->where('financial_month_year' ,'=', Input::get('period'))
		  ->sum('net');

		$currencies = DB::table('currencies')
            ->select('shortname')
            ->get();

		$rems = DB::table('transact')
            ->join('employee', 'transact.employee_id', '=', 'employee.personal_file_number')
            ->where('department_id' ,'=', Input::get('department'))
            ->where('mode_of_payment' ,'=', Input::get('mode'))
            ->where('financial_month_year' ,'=', Input::get('period'))
            ->get(); 

		$organization = Organization::find(1);

     $branches=DB::table('bank_branches')
            ->where('organization_id','=',$organization->id)
            ->get();

		$pdf = PDF::loadView('pdf.remittanceReport', compact('rems','branches','total','currencies','period','organization'))->setPaper('a4')->setOrientation('landscape');
 	
		return $pdf->stream('Pay_Remittance_'.$period.'.pdf');

        }  else if(!empty(Input::get('selD'))){
          $total = DB::table('transact')
          ->join('employee', 'transact.employee_id', '=', 'employee.personal_file_number')
          ->where('branch_id' ,'=', Input::get('branch'))
          ->where('mode_of_payment' ,'=', Input::get('mode'))
          ->where('financial_month_year' ,'=', Input::get('period'))
		  ->sum('net');

		$currencies = DB::table('currencies')
            ->select('shortname')
            ->get();

		$rems = DB::table('transact')
            ->join('employee', 'transact.employee_id', '=', 'employee.personal_file_number')
            ->where('branch_id' ,'=', Input::get('branch'))
            ->where('mode_of_payment' ,'=', Input::get('mode'))
            ->where('financial_month_year' ,'=', Input::get('period'))
            ->get(); 

		$organization = Organization::find(1);

     $branches=DB::table('bank_branches')
            ->where('organization_id','=',$organization->id)
            ->get();

		$pdf = PDF::loadView('pdf.remittanceReport', compact('rems','branches','total','currencies','period','organization'))->setPaper('a4')->setOrientation('landscape');
 	
		return $pdf->stream('Pay_Remittance_'.$period.'.pdf');

        }  else if(!empty(Input::get('selM'))){
          $total = DB::table('transact')
          ->join('employee', 'transact.employee_id', '=', 'employee.personal_file_number')
          ->where('branch_id' ,'=', Input::get('branch'))
          ->where('department_id' ,'=', Input::get('department'))
          ->where('financial_month_year' ,'=', Input::get('period'))
		  ->sum('net');

		$currencies = DB::table('currencies')
            ->select('shortname')
            ->get();

		$rems = DB::table('transact')
            ->join('employee', 'transact.employee_id', '=', 'employee.personal_file_number')
            ->where('branch_id' ,'=', Input::get('branch'))
            ->where('department_id' ,'=', Input::get('department'))
            ->where('financial_month_year' ,'=', Input::get('period'))
            ->get(); 

		$organization = Organization::find(1);

     $branches=DB::table('bank_branches')
            ->where('organization_id','=',$organization->id)
            ->get();

		$pdf = PDF::loadView('pdf.remittanceReport', compact('rems','branches','total','currencies','period','organization'))->setPaper('a4')->setOrientation('landscape');
 	
		return $pdf->stream('Pay_Remittance_'.$period.'.pdf');

        }  else if(empty(Input::get('selB')) && empty(Input::get('selD')) && empty(Input::get('selM'))){
          $total = DB::table('transact')
          ->join('employee', 'transact.employee_id', '=', 'employee.personal_file_number')
          ->where('branch_id' ,'=', Input::get('branch'))
          ->where('department_id' ,'=', Input::get('department'))
          ->where('mode_of_payment' ,'=', Input::get('mode'))
          ->where('financial_month_year' ,'=', Input::get('period'))
		  ->sum('net');

		$currencies = DB::table('currencies')
            ->select('shortname')
            ->get();

		$rems = DB::table('transact')
            ->join('employee', 'transact.employee_id', '=', 'employee.personal_file_number')
            ->where('branch_id' ,'=', Input::get('branch'))
            ->where('department_id' ,'=', Input::get('department'))
            ->where('mode_of_payment' ,'=', Input::get('mode'))
            ->where('financial_month_year' ,'=', Input::get('period'))
            ->get(); 

		$organization = Organization::find(1);

     $branches=DB::table('bank_branches')
            ->where('organization_id','=',$organization->id)
            ->get();

		$pdf = PDF::loadView('pdf.remittanceReport', compact('rems','branches','total','currencies','period','organization'))->setPaper('a4')->setOrientation('landscape');
 	
		return $pdf->stream('Pay_Remittance_'.$period.'.pdf');

        }                     	
		
	}


   public function period_summary()
	{
		$branches = Branch::all();
		$depts = Department::all();
		return View::make('pdf.summarySelect',compact('branches','depts'));
	}

    public function paySummary(){
		$period = Input::get("period");
		$selBranch = Input::get("selB");
		$selDept = Input::get("selD");


        if(!empty(Input::get('selB')) && !empty(Input::get('selD'))){
		 $total_pay = DB::table('transact')
        ->where('financial_month_year' ,'=', Input::get('period'))
		->sum('transact.basic_pay');

		 $total_earning = DB::table('transact')
        ->where('financial_month_year' ,'=', Input::get('period'))
		->sum('earning_amount');

		 $total_gross = DB::table('transact')
        ->where('financial_month_year' ,'=', Input::get('period'))
		->sum('taxable_income');
        
        $total_paye = DB::table('transact')
        ->where('financial_month_year' ,'=', Input::get('period'))
		->sum('paye');

		 $total_nssf = DB::table('transact')
        ->where('financial_month_year' ,'=', Input::get('period'))
		->sum('nssf_amount');

		 $total_nhif = DB::table('transact')
        ->where('financial_month_year' ,'=', Input::get('period'))
		->sum('nhif_amount');

		$total_others = DB::table('transact')
        ->where('financial_month_year' ,'=', Input::get('period'))
		->sum('other_deductions');

		$total_deds = DB::table('transact')
        ->where('financial_month_year' ,'=', Input::get('period'))
		->sum('total_deductions');

		$total_net = DB::table('transact')
        ->where('financial_month_year' ,'=', Input::get('period'))
		->sum('net');

		$currencies = DB::table('currencies')
            ->select('shortname')
            ->get();

		$sums = DB::table('transact')
            ->join('employee', 'transact.employee_id', '=', 'employee.personal_file_number')
            ->where('financial_month_year' ,'=', Input::get('period'))
            ->get(); 

		$organization = Organization::find(1);

		$pdf = PDF::loadView('pdf.summaryReport', compact('sums','selBranch','selDept','total_pay','total_earning','total_gross','total_paye','total_nssf','total_nhif','total_others','total_deds','total_net','currencies','period','organization'))->setPaper('a4')->setOrientation('landscape');
 	
		return $pdf->stream('Payroll_summary_'.$period.'.pdf');

        }else if(!empty(Input::get('selD'))){
         $sels = DB::table('branches')->find(Input::get('branch')); 

         $total_pay = DB::table('transact')
         ->join('employee', 'transact.employee_id', '=', 'employee.personal_file_number')
         ->where('branch_id' ,'=', Input::get('branch'))
         ->where('financial_month_year' ,'=', Input::get('period'))
		 ->sum('transact.basic_pay');

		 $total_earning = DB::table('transact')
		->join('employee', 'transact.employee_id', '=', 'employee.personal_file_number')
		->where('branch_id' ,'=', Input::get('branch'))
        ->where('financial_month_year' ,'=', Input::get('period'))
		->sum('earning_amount');

		 $total_gross = DB::table('transact')
		->join('employee', 'transact.employee_id', '=', 'employee.personal_file_number')
		->where('branch_id' ,'=', Input::get('branch'))
        ->where('financial_month_year' ,'=', Input::get('period'))
		->sum('taxable_income');
        
        $total_paye = DB::table('transact')
        ->join('employee', 'transact.employee_id', '=', 'employee.personal_file_number')
        ->where('branch_id' ,'=', Input::get('branch'))
        ->where('financial_month_year' ,'=', Input::get('period'))
		->sum('paye');

		 $total_nssf = DB::table('transact')
		->join('employee', 'transact.employee_id', '=', 'employee.personal_file_number')
		->where('branch_id' ,'=', Input::get('branch'))
        ->where('financial_month_year' ,'=', Input::get('period'))
		->sum('nssf_amount');

		 $total_nhif = DB::table('transact')
		->join('employee', 'transact.employee_id', '=', 'employee.personal_file_number')
		->where('branch_id' ,'=', Input::get('branch'))
        ->where('financial_month_year' ,'=', Input::get('period'))
		->sum('nhif_amount');

		$total_others = DB::table('transact')
	    ->join('employee', 'transact.employee_id', '=', 'employee.personal_file_number')
		->where('branch_id' ,'=', Input::get('branch'))
        ->where('financial_month_year' ,'=', Input::get('period'))
		->sum('other_deductions');

		$total_deds = DB::table('transact')
	    ->join('employee', 'transact.employee_id', '=', 'employee.personal_file_number')
		->where('branch_id' ,'=', Input::get('branch'))
        ->where('financial_month_year' ,'=', Input::get('period'))
		->sum('total_deductions');

		$total_net = DB::table('transact')
		->join('employee', 'transact.employee_id', '=', 'employee.personal_file_number')
		->where('branch_id' ,'=', Input::get('branch'))
        ->where('financial_month_year' ,'=', Input::get('period'))
		->sum('net');

		$currencies = DB::table('currencies')
            ->select('shortname')
            ->get();

		$sums = DB::table('transact')
            ->join('employee', 'transact.employee_id', '=', 'employee.personal_file_number')
            ->join('branches', 'employee.branch_id', '=', 'branches.id')
            ->where('branch_id' ,'=', Input::get('branch'))
            ->where('financial_month_year' ,'=', Input::get('period'))
            ->get(); 

		$organization = Organization::find(1);

		$pdf = PDF::loadView('pdf.summaryReport', compact('sums','selBranch','selDept','sels','total_pay','total_earning','total_gross','total_paye','total_nssf','total_nhif','total_others','total_deds','total_net','currencies','period','organization'))->setPaper('a4')->setOrientation('landscape');
  
    return $pdf->stream('Payroll_summary_'.$period.'.pdf');

        } else if(!empty(Input::get('selB'))){
          $sels = DB::table('departments')->find(Input::get('department')); 

          $total_pay = DB::table('transact')
         ->join('employee', 'transact.employee_id', '=', 'employee.personal_file_number')
         ->where('department_id' ,'=', Input::get('department'))
         ->where('financial_month_year' ,'=', Input::get('period'))
		     ->sum('transact.basic_pay');

		 $total_earning = DB::table('transact')
		 ->join('employee', 'transact.employee_id', '=', 'employee.personal_file_number')
         ->where('department_id' ,'=', Input::get('department'))
         ->where('financial_month_year' ,'=', Input::get('period'))
		 ->sum('earning_amount');

		 $total_gross = DB::table('transact')
		 ->join('employee', 'transact.employee_id', '=', 'employee.personal_file_number')
         ->where('department_id' ,'=', Input::get('department'))
         ->where('financial_month_year' ,'=', Input::get('period'))
		 ->sum('taxable_income');
        
        $total_paye = DB::table('transact')
         ->join('employee', 'transact.employee_id', '=', 'employee.personal_file_number')
         ->where('department_id' ,'=', Input::get('department'))
         ->where('financial_month_year' ,'=', Input::get('period'))
		 ->sum('paye');

		 $total_nssf = DB::table('transact')
		 ->join('employee', 'transact.employee_id', '=', 'employee.personal_file_number')
         ->where('department_id' ,'=', Input::get('department'))
         ->where('financial_month_year' ,'=', Input::get('period'))
		 ->sum('nssf_amount');

		 $total_nhif = DB::table('transact')
		 ->join('employee', 'transact.employee_id', '=', 'employee.personal_file_number')
         ->where('department_id' ,'=', Input::get('department'))
         ->where('financial_month_year' ,'=', Input::get('period'))
		 ->sum('nhif_amount');

		$total_others = DB::table('transact')
		 ->join('employee', 'transact.employee_id', '=', 'employee.personal_file_number')
         ->where('department_id' ,'=', Input::get('department'))
         ->where('financial_month_year' ,'=', Input::get('period'))
		 ->sum('other_deductions');

		$total_deds = DB::table('transact')
		 ->join('employee', 'transact.employee_id', '=', 'employee.personal_file_number')
         ->where('department_id' ,'=', Input::get('department'))
         ->where('financial_month_year' ,'=', Input::get('period'))
		 ->sum('total_deductions');

		$total_net = DB::table('transact')
		 ->join('employee', 'transact.employee_id', '=', 'employee.personal_file_number')
         ->where('department_id' ,'=', Input::get('department'))
         ->where('financial_month_year' ,'=', Input::get('period'))
		 ->sum('net');

		$currencies = DB::table('currencies')
            ->select('shortname')
            ->get();

		$sums = DB::table('transact')
         ->join('employee', 'transact.employee_id', '=', 'employee.personal_file_number')
         ->join('departments', 'employee.department_id', '=', 'departments.id')
         ->where('department_id' ,'=', Input::get('department'))
         ->where('financial_month_year' ,'=', Input::get('period'))
         ->get(); 

		$organization = Organization::find(1);

		$pdf = PDF::loadView('pdf.summaryReport', compact('sums','selBranch','selDept','sels','total_pay','total_earning','total_gross','total_paye','total_nssf','total_nhif','total_others','total_deds','total_net','currencies','period','organization'))->setPaper('a4')->setOrientation('landscape');
 	
		return $pdf->stream('Payroll_summary_'.$period.'.pdf');


        }   else if(empty(Input::get('selB')) && empty(Input::get('selD'))){
             $selBr = DB::table('branches')->find(Input::get('branch')); 
             $selDt = DB::table('departments')->find(Input::get('department')); 

          $total_pay = DB::table('transact')
         ->join('employee', 'transact.employee_id', '=', 'employee.personal_file_number')
         ->where('branch_id' ,'=', Input::get('branch'))
         ->where('department_id' ,'=', Input::get('department'))
         ->where('financial_month_year' ,'=', Input::get('period'))
		 ->sum('transact.basic_pay');

		 $total_earning = DB::table('transact')
		 ->join('employee', 'transact.employee_id', '=', 'employee.personal_file_number')
		 ->where('branch_id' ,'=', Input::get('branch'))
         ->where('department_id' ,'=', Input::get('department'))
         ->where('financial_month_year' ,'=', Input::get('period'))
		 ->sum('earning_amount');

		 $total_gross = DB::table('transact')
		 ->join('employee', 'transact.employee_id', '=', 'employee.personal_file_number')
		 ->where('branch_id' ,'=', Input::get('branch'))
         ->where('department_id' ,'=', Input::get('department'))
         ->where('financial_month_year' ,'=', Input::get('period'))
		 ->sum('taxable_income');
        
        $total_paye = DB::table('transact')
         ->join('employee', 'transact.employee_id', '=', 'employee.personal_file_number')
         ->where('branch_id' ,'=', Input::get('branch'))
         ->where('department_id' ,'=', Input::get('department'))
         ->where('financial_month_year' ,'=', Input::get('period'))
		 ->sum('paye');

		 $total_nssf = DB::table('transact')
		 ->join('employee', 'transact.employee_id', '=', 'employee.personal_file_number')
		 ->where('branch_id' ,'=', Input::get('branch'))
         ->where('department_id' ,'=', Input::get('department'))
         ->where('financial_month_year' ,'=', Input::get('period'))
		 ->sum('nssf_amount');

		 $total_nhif = DB::table('transact')
		 ->join('employee', 'transact.employee_id', '=', 'employee.personal_file_number')
		 ->where('branch_id' ,'=', Input::get('branch'))
         ->where('department_id' ,'=', Input::get('department'))
         ->where('financial_month_year' ,'=', Input::get('period'))
		 ->sum('nhif_amount');

		$total_others = DB::table('transact')
		 ->join('employee', 'transact.employee_id', '=', 'employee.personal_file_number')
		 ->where('branch_id' ,'=', Input::get('branch'))
         ->where('department_id' ,'=', Input::get('department'))
         ->where('financial_month_year' ,'=', Input::get('period'))
		 ->sum('other_deductions');

		$total_deds = DB::table('transact')
		 ->join('employee', 'transact.employee_id', '=', 'employee.personal_file_number')
		 ->where('branch_id' ,'=', Input::get('branch'))
         ->where('department_id' ,'=', Input::get('department'))
         ->where('financial_month_year' ,'=', Input::get('period'))
		 ->sum('total_deductions');

		$total_net = DB::table('transact')
		 ->join('employee', 'transact.employee_id', '=', 'employee.personal_file_number')
		 ->where('branch_id' ,'=', Input::get('branch'))
         ->where('department_id' ,'=', Input::get('department'))
         ->where('financial_month_year' ,'=', Input::get('period'))
		 ->sum('net');

		$currencies = DB::table('currencies')
            ->select('shortname')
            ->get();

		$sums = DB::table('transact')
         ->join('employee', 'transact.employee_id', '=', 'employee.personal_file_number')
         ->join('branches', 'employee.branch_id', '=', 'branches.id')
         ->join('departments', 'employee.department_id', '=', 'departments.id')
         ->where('branch_id' ,'=', Input::get('branch'))
         ->where('department_id' ,'=', Input::get('department'))
         ->where('financial_month_year' ,'=', Input::get('period'))
         ->get(); 

		$organization = Organization::find(1);

		$pdf = PDF::loadView('pdf.summaryReport', compact('sums','selBranch','selDept','selBr','selDt','total_pay','total_earning','total_gross','total_paye','total_nssf','total_nhif','total_others','total_deds','total_net','currencies','period','organization'))->setPaper('a4')->setOrientation('landscape');
 	
		return $pdf->stream('Payroll_summary_'.$period.'.pdf');

        }                     	
		
	}



	public function remittance(){

		//$members = DB::table('members')->where('is_active', '=', '1')->get();

		$members = Member::all();
		$organization = Organization::find(1);

		$savingproducts = Savingproduct::all();

		$loanproducts = Loanproduct::all();

		$pdf = PDF::loadView('pdf.remittance', compact('members', 'organization', 'loanproducts', 'savingproducts'))->setPaper('a4')->setOrientation('landscape');
 	
		return $pdf->stream('Remittance.pdf');
		
	}



	public function template(){

		$employees = Employee::all();

		$organization = Organization::find(1);

		$pdf = PDF::loadView('pdf.blank', compact('employees', 'organization'))->setPaper('a4')->setOrientation('landscape');
 	
		return $pdf->stream('Template.pdf');
		
	}



	public function loanlisting(){

		$loans = Loanaccount::all();

		$organization = Organization::find(1);

		$pdf = PDF::loadView('pdf.loanreports.loanbalances', compact('loans', 'organization'))->setPaper('a4')->setOrientation('potrait');
 	
		return $pdf->stream('Loan Listing.pdf');
		
	}



	public function loanproduct($id){

		$loans = Loanproduct::find($id);

		$organization = Organization::find(1);

		$pdf = PDF::loadView('pdf.loanreports.loanproducts', compact('loans', 'organization'))->setPaper('a4')->setOrientation('potrait');
 	
		return $pdf->stream('Loan Product Listing.pdf');
		
	}



	public function savinglisting(){

		$savings = Savingaccount::all();

		$organization = Organization::find(1);

		$pdf = PDF::loadView('pdf.savingreports.savingbalances', compact('savings', 'organization'))->setPaper('a4')->setOrientation('potrait');
 	
		return $pdf->stream('Savings Listing.pdf');
		
	}



	public function savingproduct($id){

		$saving = Savingproduct::find($id);

		$organization = Organization::find(1);

		$pdf = PDF::loadView('pdf.savingreports.savingproducts', compact('saving', 'organization'))->setPaper('a4')->setOrientation('potrait');
 	
		return $pdf->stream('Saving Product Listing.pdf');
		
	}
	


	public function financials(){

		
		$report = Input::get('report_type');
		$date = Input::get('date');

		$accounts = Account::all();

		$organization = Organization::find(1);


		if($report == 'balancesheet'){

			

			$pdf = PDF::loadView('pdf.financials.balancesheet', compact('accounts', 'date', 'organization'))->setPaper('a4')->setOrientation('potrait');
 	
			return $pdf->stream('Balance Sheet.pdf');

		}


		if($report == 'income'){

			$pdf = PDF::loadView('pdf.financials.incomestatement', compact('accounts', 'date', 'organization'))->setPaper('a4')->setOrientation('potrait');
 	
			return $pdf->stream('Income Statement.pdf');

		}


		if($report == 'trialbalance'){

			$pdf = PDF::loadView('pdf.financials.trialbalance', compact('accounts', 'date', 'organization'))->setPaper('a4')->setOrientation('potrait');
 	
			return $pdf->stream('Trial Balance.pdf');

		}



	}



	


	

}
