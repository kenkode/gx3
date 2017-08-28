<?php 

class StmtTransaction extends Eloquent{

	protected $table = 'stmt_transactions';

	/**
	 * Link with BankStatement
	 */
	public function bankStatement(){
		return $this->belongsTo('BankStatement');
	}

	// Link with AccountTransaction Model
	/*public function accountTransaction(){
		return $this->hasOne('AccountTransaction');
	}*/
}