<?php

class PettyCashController extends BaseController{

	/**
	 * Display a listing of expenses
	 *
	 * @return Response
	 */
	public function index(){
		Session::forget('newTransaction');
		Session::forget('trItems');

		$accounts = Account::all();
		$assets = Account::where('category', 'ASSET')->get();
		$liabilities = Account::where('category', 'LIABILITY')->get();
		$petty = Account::where('name', 'LIKE', '%petty%')->get();
		$petty_account = Account::where('name', 'LIKE', '%petty%')->where('active', 1)->first();

		if(count($petty_account) > 0){
			$acID = $petty_account->id;

			$query = DB::table('account_transactions');
			$ac_transactions = $query->where(function($query) use ($acID){
										$query->where('account_debited', $acID)
										->orWhere('account_credited', $acID);
									})->orderBy('id','DESC')->get();
		}

		//return $ac_transactions;

		return View::make('petty_cash.index', compact('accounts', 'assets', 'liabilities', 'petty', 'petty_account', 'ac_transactions'));
	}

	/**
	 * Show the form for creating a new expense
	 *
	 * @return Response
	 */
	public function create()
	{
		
	}

	/**
	 * Store a newly created expense in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		
	}

	/**
	 * Display the specified expense.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		
	}

	/**
	 * Show the form for editing the specified expense.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		
	}

	/**
	 * Update the specified expense in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		
	}

	/**
	 * Remove the specified expense from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		
	}


	/**
	 * SHOW RECEIPT TRANSACTIONS
	 */
	public function receiptTransactions($id){
		$items = PettycashItem::where('ac_trns', $id)->get();

		return View::make('petty_cash.receiptTransactions', compact('items'));
	}


	/**
	 * ADD MONEY TO PETTY CASH ACCOUNT
	 */
	public function addMoney(){
		$ac_name = Account::where('id', Input::get('ac_from'))->first();
		$amount = Input::get('amount');
		if($ac_name->balance < Input::get('amount')){
			return Redirect::back()->with('error', 'Insufficient funds in From Account selected!');
		}

		$data = array(
			'date' => date("Y-m-d"), 
			'debit_account' => Input::get('ac_to'),
			'credit_account' => Input::get('ac_from'),
			'description' => "Transferred cash from $ac_name->name account to Petty Cash Account",
			'amount' => Input::get('amount'),
			'initiated_by' => Confide::user()->username
		);

		DB::table('accounts')->where('id', Input::get('ac_from'))->decrement('balance', Input::get('amount'));
		DB::table('accounts')->where('id', Input::get('ac_to'))->increment('balance', Input::get('amount'));

		$acTransaction = new AccountTransaction;
		$journal = new Journal;

		$acTransaction->createTransaction($data);
		$journal->journal_entry($data);

		return Redirect::action('PettyCashController@index')->with('success', "KES. $amount Successfully Transferred from $ac_name->name to Petty Cash!");
	}

	/**
	 * ADD MONEY TO PETTY CASH FROM OWNER'S CONTRIBUTION
	 */
	public function addContribution(){
		$ac_name = Account::where('id', Input::get('cont_acFrom'))->first();
		$contAmount = Input::get('cont_amount');
		$contName = Input::get('cont_name');

		$data = array(
			'date' => date("Y-m-d"), 
			'debit_account' => Input::get('cont_acTo'),
			'credit_account' => Input::get('cont_acFrom'),
			'description' => "Transferred Money to Petty Cash Account from $contName",
			'amount' => Input::get('cont_amount'),
			'initiated_by' => Confide::user()->username
		);

		DB::table('accounts')->where('id', Input::get('cont_acFrom'))->decrement('balance', Input::get('cont_amount'));
		DB::table('accounts')->where('id', Input::get('cont_acTo'))->increment('balance', Input::get('cont_amount'));

		$acTransaction = new AccountTransaction;
		$journal = new Journal;

		$acTransaction->createTransaction($data);
		$journal->journal_entry($data);

		return Redirect::action('PettyCashController@index')->with('success', "KES. $contAmount Transferred to Petty Cash Account from $contName");
	}

	/**
	 * CREATE NEW PETTY CASH TRANSACTION
	 */
	public function newTransaction(){
		Session::put('newTransaction', [
			'transactTo'=>Input::get('transact_to'),
			'trDate'=>Input::get('tr_date'),
			'description'=>Input::get('description'),
			'expense_ac'=>Input::get('expense_ac'),
			'credit_ac'=>Input::get('credit_ac')
		]);

		$newTr = Session::get('newTransaction');
		//return Input::get();
		if(Input::get('item') != NULL){
			Session::push('trItems', array(
				'item_name' => Input::get('item'),
				'description' => Input::get('desc'),
				'quantity' => Input::get('qty'),
				'unit_price' => Input::get('unit_price')
			));
		}

		$trItems = Session::get('trItems');

		return View::make('petty_cash.transactionItems', compact('newTr', 'trItems'));
	}


	/**
	 * Remove Petty Cash Transaction Item
	 */
	public function removeTransactionItem($count){
		/*Session::put('newTransaction', [
			'transactTo'=>Input::get('transact_to'),
			'trDate'=>Input::get('tr_date')
		]);*/
		$newTr = Session::get('newTransaction');

		$items = Session::get('trItems');
		unset($items[$count]);
		$newItems = array_values($items);
		Session::put('trItems', $newItems);

		//return Session::get('trItems');
		$trItems = Session::get('trItems');

		return View::make('petty_cash.transactionItems', compact('newTr', 'trItems'));
	}


	/**
	 * Commit Transaction
	 */
	public function commitTransaction(){

		$newTr = Session::get('newTransaction');
		$trItems = Session::get('trItems');

		if($trItems == NULL){
			return View::make('petty_cash.transactionItems', compact('newTr', 'trItems'));
		}

		$total = 0;
		foreach($trItems as $trItem){
			$total += ($trItem['quantity'] * $trItem['unit_price']);
		}

		$data = array(
			'date' => date("Y-m-d"), 
			'debit_account' => $newTr['expense_ac'],
			'credit_account' => $newTr['credit_ac'],
			'description' => $newTr['description'],
			'amount' => $total,
			'initiated_by' => Confide::user()->username
		);

		DB::table('accounts')->where('id', $newTr['credit_ac'])->decrement('balance', $total);
		DB::table('accounts')->where('id', $newTr['expense_ac'])->increment('balance', $total);

		$acTransaction = new AccountTransaction;
		$journal = new Journal;

		$trId = $acTransaction->createTransaction($data);
		$journal->journal_entry($data);

		foreach($trItems as $trItem){
			$pettyCashItem = new PettycashItem;

			$pettyCashItem->ac_trns = $trId;
			$pettyCashItem->item_name = $trItem['item_name'];
			$pettyCashItem->description = $trItem['description'];
			$pettyCashItem->quantity = $trItem['quantity'];
			$pettyCashItem->unit_price = $trItem['unit_price'];

			$pettyCashItem->save();
		}

		Session::forget('newTransaction');
		Session::forget('trItems');

		return Redirect::action('PettyCashController@index');
	}


}