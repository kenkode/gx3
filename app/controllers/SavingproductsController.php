<?php

class SavingproductsController extends \BaseController {

	/**
	 * Display a listing of savingproducts
	 *
	 * @return Response
	 */
	public function index()
	{
		$savingproducts = Savingproduct::all();

		return View::make('savingproducts.index', compact('savingproducts'));
	}

	/**
	 * Show the form for creating a new savingproduct
	 *
	 * @return Response
	 */
	public function create()
	{

		$accounts = Account::all();
		$charges = Charge::all();
		$currencies = Currency::all();
		return View::make('savingproducts.create', compact('accounts', 'charges', 'currencies'));
	}

	/**
	 * Store a newly created savingproduct in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Validator::make($data = Input::all(), Savingproduct::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$charge_id = array();
		
		$charge_id = Input::get('charge_id');
		

		 $prod_id = DB::table('savingproducts')->insertGetId(
            
             array(
                'name' => Input::get('name'), 
                'shortname' => Input::get('shortname'),
                'opening_balance' => Input::get('opening_balance'),
                'currency' => Input::get('currency'),
                'type' => Input::get('type')
                )
            );


		 

		

		$product = Savingproduct::findOrFail($prod_id);

		$fee_income_acc = Input::get('fee_income_acc');
		$saving_control_acc = Input::get('saving_control_acc');
		$cash_account = Input::get('cash_account');


		//save charges 


		foreach($charge_id as $charg){

			$charge = Charge::findOrFail($charg);

			$product->charges()->attach($charge);
		}


		// create posting rules

		$savingposting = new savingposting;

		$savingposting->create_post_rules($product, $fee_income_acc, $saving_control_acc, $cash_account);




		return Redirect::route('savingproducts.index');
	}

	/**
	 * Display the specified savingproduct.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$savingproduct = Savingproduct::findOrFail($id);

		return View::make('savingproducts.show', compact('savingproduct'));
	}

	/**
	 * Show the form for editing the specified savingproduct.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$savingproduct = Savingproduct::find($id);
		$currencies = Currency::all();

		return View::make('savingproducts.edit', compact('savingproduct', 'currencies'));
	}

	/**
	 * Update the specified savingproduct in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$savingproduct = Savingproduct::findOrFail($id);

		$validator = Validator::make($data = Input::all(), Savingproduct::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$savingproduct = new Savingproduct;


		$savingproduct->name = Input::get('name');
		$savingproduct->shortname = Input::get('shortname');
		$savingproduct->opening_balance = Input::get('opening_balance');
		$savingproduct->type = Input::get('type');
		$savingproduct->currency = Input::get('currency');
		$savingproduct->fee_income_acc = Input::get('fee_income_acc');
		$savingproduct->saving_control_acc = Input::get('saving_control_acc');

		$savingproduct->update();

		return Redirect::route('savingproducts.index');
	}

	/**
	 * Remove the specified savingproduct from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Savingproduct::destroy($id);

		return Redirect::route('savingproducts.index');
	}

}
