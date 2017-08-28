<?php

class Client extends \Eloquent {

	// Add your validation rules here
	public static $rules = [
		 'name' => 'required',
		 'email_office' => 'email|unique:clients,email',
		 'email_personal' => 'email|unique:clients,contact_person_email',
		 'type' => 'required',
		 'mobile_phone' => 'unique:clients,contact_person_phone',
		 'office_phone' => 'unique:clients,phone',

	];

    public static function rolesUpdate($id)
    {
        return array(
         'name' => 'required',
		 'email_office' => 'email|unique:clients,email,' . $id,
		 'email_personal' => 'email|unique:clients,contact_person_email,' . $id,
		 'type' => 'required',
		 'mobile_phone' => 'unique:clients,contact_person_phone,' . $id,
		 'office_phone' => 'unique:clients,phone,' . $id
        );
    }

    public static $messages = array(
    	'name.required'=>'Please insert client name!',
        'email_office.email'=>'That please insert a vaild email address!',
        'email_office.unique'=>'That office email already exists!',
        'email_personal.email'=>'That please insert a vaild email address!',
        'email_personal.unique'=>'That office email already exists!',
        'mobile_phone.unique'=>'That mobile number already exists!',
        'office_phone.unique'=>'That office mobile already exists!',
        'type.required'=>'Please select client type!'
    );

	// Don't forget to fill this array
	protected $fillable = [];


	public function erporders(){

		return $this->hasMany('Erporder');
	}

	public function payments(){

		return $this->hasMany('Payment');
	}

  public function prices(){

    return $this->hasMany('Price');
  }


  /**
   * GETTING CLIENT ACCOUNT BALANCES [TOTAL-BALANCES]
   * @param  [type] $id [description]
   * @return [type]     [description]
   */
	public static function due($id){

          $client = Client::find($id);
          $order = 0;

          if($client->type == 'Customer'){
             $order = DB::table('erporders')
                     ->join('erporderitems','erporders.id','=','erporderitems.erporder_id')
                     ->join('clients','erporders.client_id','=','clients.id')           
                     ->where('clients.id',$id)
                     ->where('erporders.type','=','sales')
                     ->where('erporders.status','!=','cancelled')   
                     ->selectRaw('SUM(price * quantity)-COALESCE(SUM(discount_amount),0)- COALESCE(SUM(erporderitems.client_discount),0) + COALESCE(clients.balance,0)  as total')
                     ->pluck('total');
          }
          else{
              $order = DB::table('erporders')
                     ->join('erporderitems','erporders.id','=','erporderitems.erporder_id')
                     ->join('clients','erporders.client_id','=','clients.id')           
                     ->where('clients.id',$id) ->selectRaw('SUM(price * quantity)as total')
                     ->pluck('total');
                   
          }

          $paid = DB::table('clients')
                 ->join('payments','clients.id','=','payments.client_id')
                 ->where('clients.id',$id) 
                 ->selectRaw('COALESCE(SUM(amount_paid),0) as due')
                 ->pluck('due');

          /*$discount = DB::table('erporders')
                    ->join('erporderitems','erporders.id','=','erporderitems.erporder_id')
                    ->join('clients','erporders.client_id','=','clients.id') 
                    ->select ('discount_amount')
                    ->get();*/

      return ($order-$paid);
  }



  /**
   * BALANCES TODAY
   */
  public static function dueToday($id){
      $today = date('Y-m-d');

      $client = Client::find($id);
      $order = 0;

      if($client->type == 'Customer'){
         $order = DB::table('erporders')
                 ->join('erporderitems','erporders.id','=','erporderitems.erporder_id')
                 ->join('clients','erporders.client_id','=','clients.id')           
                 ->where('clients.id',$id)
                 ->where('erporders.type','=','sales')
                 ->where('erporders.status','!=','cancelled') 
                 ->where('erporders.date',$today)   
                 ->selectRaw('SUM(price * quantity)-COALESCE(SUM(discount_amount),0)- COALESCE(SUM(erporderitems.client_discount),0) + COALESCE(clients.balance,0)  as total')
                 ->pluck('total');
      }
      else{
          $order = DB::table('erporders')
                 ->join('erporderitems','erporders.id','=','erporderitems.erporder_id')
                 ->join('clients','erporders.client_id','=','clients.id')     
                 ->where('erporders.date',$today)         
                 ->where('clients.id',$id) ->selectRaw('SUM(price * quantity)as total')
                 ->pluck('total');
               
      }

      $paid = DB::table('clients')
             ->join('payments','clients.id','=','payments.client_id')
             ->where('clients.id',$id) 
             ->where('payments.payment_date',$today)   
             ->selectRaw('COALESCE(SUM(amount_paid),0) as due')
             ->pluck('due');

      return ($order-$paid);
  }

/**
 * BALANCES <= 30 DAYS
 */
public static function due30($id){
      $from = date('Y-m-d', strtotime('-30 days'));
      $to = date('Y-m-d', strtotime('-1 day'));

      $client = Client::find($id);
      $order = 0;

      if($client->type == 'Customer'){
         $order = DB::table('erporders')
                 ->join('erporderitems','erporders.id','=','erporderitems.erporder_id')
                 ->join('clients','erporders.client_id','=','clients.id')           
                 ->where('clients.id',$id)
                 ->where('erporders.type','=','sales')
                 ->where('erporders.status','!=','cancelled')  
                 ->whereBetween('erporders.date', array($from, $to)) 
                 ->selectRaw('SUM(price * quantity)-COALESCE(SUM(discount_amount),0)- COALESCE(SUM(erporderitems.client_discount),0) + COALESCE(clients.balance,0)  as total')
                 ->pluck('total');
      }
      else{
          $order = DB::table('erporders')
                 ->join('erporderitems','erporders.id','=','erporderitems.erporder_id')
                 ->join('clients','erporders.client_id','=','clients.id') 
                 ->whereBetween('erporders.date', array($from, $to)) 
                 ->where('clients.id',$id) ->selectRaw('SUM(price * quantity)as total')
                 ->pluck('total');
               
      }

      $paid = DB::table('clients')
             ->join('payments','clients.id','=','payments.client_id')
             ->where('clients.id',$id) 
             ->whereBetween('payments.payment_date', array($from, $to)) 
             ->selectRaw('COALESCE(SUM(amount_paid),0) as due')
             ->pluck('due');

      return ($order-$paid);
  }

  /**
   * BALANCES 31 <= 60
   */
  public static function due60($id){
      $from = date('Y-m-d', strtotime('-60 days'));
      $to = date('Y-m-d', strtotime('-31 days'));

      $client = Client::find($id);
      $order = 0;

      if($client->type == 'Customer'){
         $order = DB::table('erporders')
                 ->join('erporderitems','erporders.id','=','erporderitems.erporder_id')
                 ->join('clients','erporders.client_id','=','clients.id')           
                 ->where('clients.id',$id)
                 ->where('erporders.type','=','sales')
                 ->where('erporders.status','!=','cancelled')  
                 ->whereBetween('erporders.date', array($from, $to)) 
                 ->selectRaw('SUM(price * quantity)-COALESCE(SUM(discount_amount),0)- COALESCE(SUM(erporderitems.client_discount),0) + COALESCE(clients.balance,0)  as total')
                 ->pluck('total');
      }
      else{
          $order = DB::table('erporders')
                 ->join('erporderitems','erporders.id','=','erporderitems.erporder_id')
                 ->join('clients','erporders.client_id','=','clients.id')           
                 ->whereBetween('erporders.date', array($from, $to)) 
                 ->where('clients.id',$id) ->selectRaw('SUM(price * quantity)as total')
                 ->pluck('total');
               
      }

      $paid = DB::table('clients')
             ->join('payments','clients.id','=','payments.client_id')
             ->where('clients.id',$id) 
             ->whereBetween('payments.payment_date', array($from, $to)) 
             ->selectRaw('COALESCE(SUM(amount_paid),0) as due')
             ->pluck('due');

      return ($order-$paid);
  }


  /**
   * BALANCES 61 <= 90
   */
  public static function due90($id){
      $from = date('Y-m-d', strtotime('-90 days'));
      $to = date('Y-m-d', strtotime('-61 days'));

      $client = Client::find($id);
      $order = 0;

      if($client->type == 'Customer'){
         $order = DB::table('erporders')
                 ->join('erporderitems','erporders.id','=','erporderitems.erporder_id')
                 ->join('clients','erporders.client_id','=','clients.id')           
                 ->where('clients.id',$id)
                 ->where('erporders.type','=','sales')
                 ->where('erporders.status','!=','cancelled') 
                 ->whereBetween('erporders.date', array($from, $to))   
                 ->selectRaw('SUM(price * quantity)-COALESCE(SUM(discount_amount),0)- COALESCE(SUM(erporderitems.client_discount),0) + COALESCE(clients.balance,0)  as total')
                 ->pluck('total');
      }
      else{
          $order = DB::table('erporders')
                 ->join('erporderitems','erporders.id','=','erporderitems.erporder_id')
                 ->join('clients','erporders.client_id','=','clients.id')     
                 ->whereBetween('erporders.date', array($from, $to))       
                 ->where('clients.id',$id) ->selectRaw('SUM(price * quantity)as total')
                 ->pluck('total');
               
      }

      $paid = DB::table('clients')
             ->join('payments','clients.id','=','payments.client_id')
             ->where('clients.id',$id) 
             ->whereBetween('payments.payment_date', array($from, $to)) 
             ->selectRaw('COALESCE(SUM(amount_paid),0) as due')
             ->pluck('due');

      return ($order-$paid);
  }


  /**
   * BALANCES >90
   */
  public static function due91($id){
      $date = date('Y-m-d', strtotime('-90 days'));

      $client = Client::find($id);
      $order = 0;

      if($client->type == 'Customer'){
         $order = DB::table('erporders')
                 ->join('erporderitems','erporders.id','=','erporderitems.erporder_id')
                 ->join('clients','erporders.client_id','=','clients.id')           
                 ->where('clients.id',$id)
                 ->where('erporders.type','=','sales')
                 ->where('erporders.status','!=','cancelled') 
                 ->where('erporders.date','<',$date)   
                 ->selectRaw('SUM(price * quantity)-COALESCE(SUM(discount_amount),0)- COALESCE(SUM(erporderitems.client_discount),0) + COALESCE(clients.balance,0)  as total')
                 ->pluck('total');
      }
      else{
          $order = DB::table('erporders')
                 ->join('erporderitems','erporders.id','=','erporderitems.erporder_id')
                 ->join('clients','erporders.client_id','=','clients.id')     
                 ->where('erporders.date','<',$date)         
                 ->where('clients.id',$id) ->selectRaw('SUM(price * quantity)as total')
                 ->pluck('total');
               
      }

      $paid = DB::table('clients')
             ->join('payments','clients.id','=','payments.client_id')
             ->where('clients.id',$id) 
             ->where('payments.payment_date','<',$date)   
             ->selectRaw('COALESCE(SUM(amount_paid),0) as due')
             ->pluck('due');

      return ($order-$paid);
  }





public static function total($id){

    $client = Client::find($id);
    $order = 0;
    

          if($client->type == 'Customer'){
   $order = DB::table('erporders')
           ->join('erporderitems','erporders.id','=','erporderitems.erporder_id')
           ->join('clients','erporders.client_id','=','clients.id')           
           ->where('clients.id',$id) ->selectRaw('SUM(price * quantity)-COALESCE(SUM(discount_amount),0)- COALESCE(SUM(erporderitems.client_discount),0)  as total')
           ->pluck('total');
           }
            else{
    $order = DB::table('erporders')
           ->join('erporderitems','erporders.id','=','erporderitems.erporder_id')
           ->join('clients','erporders.client_id','=','clients.id')           
           ->where('clients.id',$id) ->selectRaw('SUM(price * quantity)as total')
           ->pluck('total');         
         }         

    
           return $order;

  }

  public static function payment($id){   
    $paid = DB::table('clients')
          ->join('payments','clients.id','=','payments.client_id')
          ->where('clients.id',$id) ->selectRaw('COALESCE(SUM(amount_paid),0) as due')
          ->pluck('due');                      
          
          return $paid;
  }


  /**
   * GET CLIENT MONTHLY SALES REPORT
   */
  public static function clientMonthlySales($id, $month, $days){
    //$date = "09-2016";
    $from = date('Y-m-d', strtotime('01-'.$month));
    $to = date('Y-m-d', strtotime($days.'-'.$month));

    $clientSalesTotal = DB::table('erporders')
                          ->join('erporderitems', 'erporders.id', '=', 'erporderitems.erporder_id')
                          ->join('items', 'erporderitems.item_id', '=', 'items.id')
                          ->join('clients', 'erporders.client_id', '=', 'clients.id')
                          ->where('erporders.client_id', $id)
                          ->where('erporders.type','=','sales')
                          ->where('erporders.status','!=','cancelled') 
                          ->whereBetween('erporders.date', array($from, $to))
                          ->selectRaw('COALESCE(SUM((erporderitems.price * erporderitems.quantity) - erporderitems.client_discount),0) as clientTotal')
                          ->pluck('clientTotal');

              return $clientSalesTotal;
  }


  /**
   * Cients Monthly Sales Report
   */
  public static function clientMonthlySalesSummary($id,$date){
    $month = substr($date, 0,2);
    $year = substr($date, 3,6);
    $clientSales = DB::table('erporders')
                      ->join('erporderitems', 'erporders.id', '=', 'erporderitems.erporder_id')
                      ->join('items', 'erporderitems.item_id', '=', 'items.id')
                      ->join('clients', 'erporders.client_id', '=', 'clients.id')
                      ->where('erporders.client_id', $id)
                      ->where('erporders.type','=','sales')
                      ->where('erporders.status','!=','cancelled')
                      ->whereMonth('erporders.date', '=', $month)
                      ->whereYear('erporders.date', '=', $year)
                      ->selectRaw('COALESCE(SUM((erporderitems.price * erporderitems.quantity) - erporderitems.client_discount),0) as orderTotal,
                          SUM(erporderitems.quantity) as qty, items.description as description, clients.name as client_name, clients.category as category')
                      //->selectRaw('erporders.*, erporderitems.*, items.*, clients.*')
                      ->first();

              return $clientSales;
  }


  /**
   * Cients Daily Sales Report
   */
  public static function clientDailySalesSummary($id){
    $clientSales = DB::table('erporders')
                      ->join('erporderitems', 'erporders.id', '=', 'erporderitems.erporder_id')
                      ->join('items', 'erporderitems.item_id', '=', 'items.id')
                      ->join('clients', 'erporders.client_id', '=', 'clients.id')
                      ->where('erporders.client_id', $id)
                      ->where('erporders.type','=','sales')
                      ->where('erporders.status','!=','cancelled')
                      ->where('erporders.date', date('Y-m-d'))
                      ->selectRaw('COALESCE(SUM((erporderitems.price * erporderitems.quantity) - erporderitems.client_discount),0) as orderTotal,
                          SUM(erporderitems.quantity) as qty, items.description as description, clients.name as client_name, clients.category as category')
                      //->selectRaw('erporders.*, erporderitems.*, items.*, clients.*')
                      ->first();

              return $clientSales;
  }

}