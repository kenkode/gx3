<?php

class BankAccountController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(){
		$mnth = date('m-Y', strtotime('-1 month'));
		$bnkAccount = DB::table('bank_accounts')
						//->leftJoin('bank_statements','bank_accounts.id','=','bank_statements.bank_account_id')
						//->whereNotNull('bank_statements.stmt_month')
						//->where('bank_statements.stmt_month',$mnth)
						//->orWhereNull('bank_statements.stmt_month')
						//->select('bank_accounts.*','bank_statements.bal_bd as bal_bd','bank_statements.stmt_month as stmt_month', 
							//'bank_statements.created_at as stmt_date','bank_statements.is_reconciled')
						->get();
						//return $bnkAccount;

		$bkAccounts = DB::table('accounts')
						->where('category', 'ASSET')
						->select('id','category','name')
						->get();

		return View::make('banking.index', compact('bnkAccount','bkAccounts'));
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('banking.create');
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Validator::make($data = Input::all(), BankAccount::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$bnkAccount = new BankAccount;

		$bnkAccount->bank_name = Input::get('bnkName');
		$bnkAccount->account_name = Input::get('acName');
		$bnkAccount->account_number = Input::get('acNumber');
		$bnkAccount->save();

		return Redirect::action('BankAccountController@index')->withSuccess('Bank Account successfully added');
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}


	/**
	 * ============================================================================================
	 * UPLOAD BANK STATEMENTS (CSV file)
	 */
	public function uploadBankStatement(){
			$bnk_id = Input::get('bnk_id');
			$stmt_month = Input::get('stmt_month');
			$bal_bd = Input::get('bal_bd');

			if($bal_bd === ''){
					return Redirect::back()->withError('Please insert Bank Balance b/d');	
			}

			if(Input::hasFile('bknStatementCSV')){
					$csv_file = Input::file('bknStatementCSV');

					if($csv_file->isValid()){
							//$destination = public_path().'/migrations/';

							// Check if directory exists make sure it has correct permissions, if not make it
				      if (is_dir($destination = public_path().'/bankStatements/')) {
				          chmod($destination, 0777);
				      } else {
				          mkdir($destination, 0777, true);
				      }

				      //return $destination;
				      $fileName = 'bnkStatement';
				      $fileName = $fileName.'_'.$stmt_month;
				      //$fileName = $fileName.'_'.date('m-Y');
				      $ext = $csv_file->getClientOriginalExtension();
				      $file = $fileName.'.'.$ext;

				      if(file_exists($destination.$file)){
				      		return Redirect::back()->withError('File already exists!');	
				      } 

				      $moved_file = $csv_file->move($destination, $file);
				      $moved_file = $this->normalize($moved_file);

				      // INSERT BANK STATEMENT DATA TO DB
					  	$bnk_statement = new BankStatement;
					  	$bnk_statement->bank_account_id = $bnk_id;
					  	$bnk_statement->bal_bd = $bal_bd;
					  	$bnk_statement->stmt_month = $stmt_month;
					  	$bnk_statement->save();

					  	$lastInsertID = $bnk_statement->id;

				      // UPLOAD FILE CONTENTS TO DB
				      $this->importFileContents($moved_file,$lastInsertID);

				      return Redirect::back()->withSuccess('Transactions successfully uploaded!');	

					}	else{
							return Redirect::back()->withError('Please upload a valid csv file');	
					}
				
			} else{
					return Redirect::back()->withError('Please upload a valid csv file');
			}
	}


	protected function normalize($file_path) {
	   //Load the file into a string
	   $string = @file_get_contents($file_path);

	   if (!$string) {
	      return $file_path;
	   }

	   //Convert all line-endings using regular expression
	   $string = preg_replace('~\r\n?~', "\n", $string);

	   file_put_contents($file_path, $string);

	   return $file_path;
   }

   /**
    * INSERT CSV DATA INTO DB
    */
  	private function importFileContents($file_path, $lastInsertID) {

		$query = sprintf("LOAD DATA LOCAL INFILE '%s' INTO TABLE stmt_transactions 
		   FIELDS TERMINATED BY ',' 
	      LINES TERMINATED BY '\\n' 
	      IGNORE 1 LINES
	      (@col1, @col2, @col3, @col4, @col5)
	      set bank_statement_id=$lastInsertID, transaction_date=@col1, description=@col2, ref_no=@col3, 
	      transaction_amnt=@col4, check_no=@col5, created_at=NOW(), updated_at=NOW()", 
	      addslashes($file_path));

		return DB::connection()->getpdo()->exec($query);
	}

	/**=====================================================================================================**/


	/**
	 * GET THE RECONCILIATION PAGE
	 */
	public function showReconcile($bnk_stmt_id){
		$ac_stmt_id = Input::get('book_account_id');
		$rec_month = Input::get('rec_month');
		$rec_month;

		$bnkAccount = DB::table('bank_accounts')
							->join('bank_statements','bank_accounts.id','=','bank_statements.bank_account_id')
							->where('bank_statements.stmt_month',$rec_month)
							->where('bank_accounts.id', $bnk_stmt_id)
							->select('bank_accounts.*','bank_statements.bal_bd as bal_bd','bank_statements.stmt_month as stmt_month', 
								'bank_statements.created_at as stmt_date')
							->first();

		$bAcc = DB::table('bank_statements')
						->where('bank_statements.bank_account_id',$bnk_stmt_id)
						->get();

		$bAccStmt = DB::table('stmt_transactions')
							->where('stmt_transactions.bank_statement_id', $bnk_stmt_id)
							->get();

		$stmt_transactions = DB::table('stmt_transactions')
									->where('stmt_transactions.bank_statement_id', $bnk_stmt_id)
									->where('stmt_transactions.status', '<>', 'RECONCILED')
									->select('*')
									->get();

		$query = DB::table('account_transactions');
		$ac_transaction = $query->where(function($query) use ($ac_stmt_id){
									$query->where('account_debited', $ac_stmt_id)
									->orWhere('account_credited', $ac_stmt_id);
								})->where(function($query) use ($rec_month){
									$query->where('status', '<>', 'RECONCILED')
									->whereMonth('transaction_date', '=', substr($rec_month, 0, 2))
									->whereYear('transaction_date', '=', substr($rec_month, 3, 4));
								})
								->select('*')
								->get();

		$accounts = DB::table('account_transactions')
							->where('status', '=', 'RECONCILED')
							->where('bank_statement_id', $bnk_stmt_id)
							->select('account_credited','account_debited','transaction_amount')
							->get();

		$count = count($accounts);

		$bkTotal = 0;
		foreach($accounts as $acnt){
			if($acnt->account_debited == $ac_stmt_id){
				$bkTotal += $acnt->transaction_amount;
			} else if($acnt->account_credited == $ac_stmt_id){
				$bkTotal -= $acnt->transaction_amount;
			}
		}

		$bankBalBD = DB::table('bank_statements')
							->where('id', $bnk_stmt_id)
							->pluck('bal_bd');

		// Check if book bal and bank balance matches
		if($bankBalBD == $bkTotal){
			if(DB::table('bank_statements')->where('id',$bnk_stmt_id)->count() > 0){
				$bankStmt = DB::table('bank_statements')->where('id',$bnk_stmt_id)->first();
				if($bankStmt->is_reconciled !== 1){
					$bankStmt->adj_bal_bd = $bkTotal;
					$bankStmt->is_reconciled = 1;
					$bankStmt->update();
				}
			}
		}

		$lastRec = DB::table('bank_statements')
						->where('bank_account_id',$bnk_stmt_id)
						->where('is_reconciled', 1)
						->select('stmt_month')
						->orderBy('stmt_month', 'DESC')
						->first();

		return View::make('banking.createReconcile', compact('bnkAccount', 'bAcc', 'bAccStmt', 'stmt_transactions', 'ac_transaction', 'ac_stmt_id', 'rec_month', 'bnk_stmt_id', 'bkTotal', 'count', 'lastRec'));
	}


	/**
	 * RECONCILE STATEMENT 
	 */
	public function reconcileStatement(){
		if(Input::get('btnReconcile')){
			$btn = Input::get('btnReconcile'); // Button being clicked
			$acTrans  = Input::get('ac_transaction');	// Book account transaction being reconciled against
			$bnkTrans = Input::get('bnk_trans_id');	// Bank Statement transaction being reconciled
			$bnkStmt = Input::get('bnk_stmt_id');	// Bank statement ID being reconciled 
			$acStmt = Input::get('ac_stmt_id');	// Account ID being reconciled against
			$bk_total = Input::get('bk_total');	// Reconciled book totals brought-down

			// Update Xara Account Transactions
			$acTransaction = AccountTransaction::findOrfail($acTrans);
			$acTransaction->bank_transaction_id = $bnkTrans;
			$acTransaction->bank_statement_id = $bnkStmt;
			$acTransaction->status = 'RECONCILED';
			$acTransaction->update();

			// Update Bank Statement Transactions
			$stmtTransaction = StmtTransaction::findOrfail($bnkTrans);
			$stmtTransaction->status = 'RECONCILED';
			$stmtTransaction->update();

			// Update Bank Statement status
			$bnkStatement = BankStatement::findOrfail($bnkStmt);
			if($bnkStatement->bal_bd == $bk_total){
				$bnkStatement->is_reconciled = 1;
				$bnkStatement->update();
			}

			return Redirect::back();

			//return $btn.' - '.$acTrans.' - '.$bnkTrans.' - '.$bnkStmt;

		} else if(Input::get('btnEdit')){
			$btn = Input::get('btnReconcile');
			$acTrans  = Input::get('ac_transaction');
			$bnkTrans = Input::get('bnk_trans_id');
			$bnkStmt = Input::get('bnk_stmt_id');

			return $btn.' - '.$acTrans.' - '.$bnkTrans.' - '.$bnkStmt;
		}
	}


	/**
	 * ADD MISSING BOOK STATEMENT TRANSACTION, TO MATCH BANK STATMENT 
	 */
	public function addStatementTransaction($bnk_trans_id, $bnk_stmt_id, $bookStmtID){
		$accounts = DB::table('accounts')
							->select('*')
							->get();

		return View::make('banking.addMissingTrans', compact('bnk_trans_id', 'bnk_stmt_id', 'accounts', 'bookStmtID'));
		//return $bnk_trans_id .' - '. $bnk_stmt_id;
	}

	
	/**
	 * SAVE MISSING BOOK STATEMENT TRANSACTION
	 */
	public function saveStatementTransaction(){
		$bnkTransID = Input::get('bnk_trans_id');
		$bnkStmtID = Input::get('bnk_stmt_id');
		$bookStmtID = Input::get('ac_stmt_id');
		$tDesc = Input::get('t_desc');
		$aCredited = Input::get('ac_credited');
		$aDebited = Input::get('ac_debited');
		$tAmount = Input::get('t_amount');

		//$urlInput = "$bnkStmtID?book_account_id=$bookStmtID";

		//return Redirect::action('BankAccountController@showReconcile', array($urlInput));
		//return $bnkTransID.' - '.$bnkStmtID.' - '.$bookStmtID.' - '.$tDesc.' - '.$aCredited.' - '.$aDebited.' - '.$tAmount.' - '.date('Y-m-d');

		$aTransaction = new AccountTransaction;
		$aTransaction->transaction_date = date('Y-m-d');
		$aTransaction->description = $tDesc;
		$aTransaction->account_debited = $aDebited;
		$aTransaction->account_credited = $aCredited;
		$aTransaction->bank_transaction_id = $bnkTransID;
		$aTransaction->bank_statement_id = $bnkStmtID;
		$aTransaction->transaction_amount = $tAmount;
		$aTransaction->status = 'RECONCILED';
		$aTransaction->save();

		$stmtTrans = StmtTransaction::findOrfail($bnkTransID);
		$stmtTrans->status = 'RECONCILED';
		$stmtTrans->update();

		return Redirect::action('BankAccountController@index');

		//return $bnkTransID.' - '.$bnkStmtID.' - '.$tDesc.' - '.$aCredited.' - '.$aDebited.' - '.$tAmount;
	}

}
