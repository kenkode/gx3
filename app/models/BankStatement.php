<?php

Class BankStatement extends Eloquent{

	protected $table = 'bank_statements';

	/**
	 * Link with BankAcount
	 */
	public function bankAccount(){
		return $this->belongsTo('BankAccount');
	}

	/**
	 * Link with Bank Statement Transactions
	 */
	public function stmtTransaction(){
		return $this->hasMany('StmtTransaction');
	}
}