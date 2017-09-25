<?php

class Payroll extends \Eloquent {
	public $table = "transact";

    /*

    use \Traits\Encryptable;


    protected $encryptable = [
        'basic_pay',
        'earning_amount',
        'taxable_income',
        'paye',
        'nssf_amount',
        'vol_amount',
        'nhif_amount',
        'net',
        'other_deductions',
        'total_deductions',
        'financial_month_year',

    ];
    */

public static $rules = [
		'period' => 'required',
		'account' => 'required'
	];

	public static $messages = array(
        'period.required'=>'Please select period!',
        'account.required'=>'Please select account type!',
    );

	// Don't forget to fill this array
	protected $fillable = [];


	public function employees(){

		return $this->hasMany('Employee');
	}

	public static function allowances($id){
    $allw = 0.00;
    
    $total_allws = DB::table('employee_allowances')
                     ->select(DB::raw('COALESCE(sum(allowance_amount),0.00) as total_allowances'))
                     ->where('employee_id', '=', $id)
                     ->get();
    foreach($total_allws as $total_allw){
    $allw = $total_allw->total_allowances;
    }
    return $allw;

    }

    public static function reliefs($id){
    $rel = 0.00;
    
    $total_rels = DB::table('employee_relief')
                     ->select(DB::raw('COALESCE(sum(relief_amount),0.00) as total_reliefs'))
                     ->where('employee_id', '=', $id)
                     ->get();
    foreach($total_rels as $total_rel){
    $rel = $total_rel->total_reliefs;
    }
    return $rel;

    }

    public static function earnings($id){
    $earn = 0.00;
    
    $total_earns = DB::table('earnings')
                     ->select(DB::raw('COALESCE(sum(earnings_amount),0.00) as total_earnings'))
                     ->where('employee_id', '=', $id)
                     ->get();
    foreach($total_earns as $total_earn){
    $earn = $total_earn->total_earnings;
    }
    return $earn;

    }
    
    public static function salary_pay($id){
    $salary = 0.00;
    
    $pays = DB::table('employee')
                     ->select(DB::raw('COALESCE(sum(basic_pay),0.00) as total_pay'))
                     ->where('id', '=', $id)
                     ->get();
    foreach($pays as $pay){
    $salary = $pay->total_pay;
    }
    return $salary;
   }


    public static function total_benefits($id){
    $total_earnings = 0.00;
    
    $total_earnings = static::allowances($id)+static::earnings($id)+static::reliefs($id);

    return $total_earnings;

    }

    public static function gross($id){
    $total_gross = 0.00;
    
    $total_gross = static::salary_pay($id)+static::total_benefits($id);

    return $total_gross;

    }

    public static function tax($id){
    $paye = 0.00;
    $total_pay = static::gross($id);
    $total_nssf = static::nssf($id);
    $taxable = $total_pay-$total_nssf;
    $emps = DB::table('employee')->where('id', '=', $id)->get();
    foreach($emps as $emp){
    if($emp->income_tax_applicable=='0'){
    $paye=0.00;
    }else if($emp->income_tax_applicable=='1' && $emp->income_tax_relief_applicable=='1'){
    if($taxable>=11135.67 && $taxable<19741){
    $paye = 1016.4+($taxable-10165)*15/100;
    $paye = $paye-1162.00;
    }else if($taxable>=19741 && $taxable<29317){
    $paye = 2452.8+($taxable-19741)*20/100;
    $paye = $paye-1162.00;
    }else if($taxable>=29317 && $taxable<38893){
    $paye = 4368+($taxable-29317)*25/100;
    $paye = $paye-1162.00;
    }else if($taxable>=38893){
    $paye = 6762+($taxable-38893)*30/100;
    $paye = $paye-1162.00;
    }else{
    $paye = 0.00;
    }
    }else if($emp->income_tax_applicable=='1' && $emp->income_tax_relief_applicable=='0'){
    if($taxable>=11135.67 && $taxable<19741){
    $paye = 1016.4+($taxable-10165)*15/100;
    }else if($taxable>=19741 && $taxable<29317){
    $paye = 2452.8+($taxable-19741)*20/100;
    }else if($taxable>=29317 && $taxable<38893){
    $paye = 4368+($taxable-29317)*25/100;
    }else if($taxable>=38893){
    $paye = 6762+($taxable-38893)*30/100;
    }else{
    $paye = 0.00;
    }
    }else if($emp->income_tax_applicable=='0' && $emp->income_tax_relief_applicable=='1'){
     $paye = 0.00;
    }
    }
    return round($paye,2);
   }

    public static function nssf($id){
    $nssfAmt = 0.00;
    $total = static::gross($id);
    $emps = DB::table('employee')->where('id', '=', $id)->get();
    foreach($emps as $emp){
    if($emp->social_security_applicable=='0'){
    $nssfAmt=0.00;
    }else{
    $nssf_amts = DB::table('social_security')->get();
    foreach($nssf_amts as $nssf_amt){
    $from=$nssf_amt->income_from;
    $to=$nssf_amt->income_to;
    if($total>=$from && $total<=$to){
    $nssfAmt=$nssf_amt->ss_amount_employee;
    }
    }
    }
    }
    return $nssfAmt;
   }

   public static function nhif($id){
    $nhifAmt = 0.00;
    $total = static::gross($id);
    $emps = DB::table('employee')->where('id', '=', $id)->get();
    foreach($emps as $emp){
    if($emp->hospital_insurance_applicable=='0'){
    $nhifAmt=0.00;
    }else{
    $nhif_amts = DB::table('hospital_insurance')->get();
    foreach($nhif_amts as $nhif_amt){
    $from=$nhif_amt->income_from;
    $to=$nhif_amt->income_to;
    if($total>=$from && $total<=$to){
    $nhifAmt=$nhif_amt->hi_amount;
    }
    }
    }
   }
    return $nhifAmt;
   }
    
    public static function deductions($id){
    $other_ded = 0.00;
    
    $deds = DB::table('employee_deductions')
                     ->select(DB::raw('COALESCE(sum(deduction_amount),0.00) as total_deduction'))
                     ->where('employee_id', '=', $id)
                     ->get();
    foreach($deds as $ded){
    $other_ded = $ded->total_deduction;
    }
    return $other_ded;
   }

   public static function total_deductions($id){
    $total_deds = 0.00;
    
    $total_deds = static::tax($id)+static::nssf($id)+static::nhif($id)+static::deductions($id);

    return $total_deds;

    }

    public static function net($id){
    $total_net = 0.00;
    
    $total_net = static::gross($id)-static::total_deductions($id);

    return $total_net;

    }

     public static function asMoney($value){

        return number_format($value, 2);

    }

}