<?php

class AccountTransaction extends Eloquent{

	protected $table = 'account_transactions';

	// Validation Rules
	public static $rules = [
		// Rules come here....
	];

	// Link with Account model
	public function account(){
		return $this->belongsTo('Account');
	}

	// Link bank account StmtTransaction Model
	/*public function stmtTransaction(){
		return $this->belongsTo('StmtTransaction');
	}*/

	// Create a new Transaction
	public function createTransaction($data){
		$acTr = new AccountTransaction;

		$acTr->transaction_date = $data['date'];
		$acTr->description = $data['description'];
		$acTr->account_debited = $data['debit_account'];
		$acTr->account_credited = $data['credit_account'];
		$acTr->transaction_amount = $data['amount'];
		$acTr->save();
	}
}