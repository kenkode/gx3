<?php 

class ClaimReceiptItem extends Eloquent{

	protected $table = 'claim_receipt_items';

	// Link with Expense Claim Receipt table
	public function claimReceipt(){
		return $this->belongsTo('ClaimReceipt');
	}

	// Get data of a particular receipt
	public static function receiptData($id){
		$items = ClaimReceiptItem::where('claimReceiptID', $id)
		          ->selectRaw('SUM(quantity) as items, SUM(quantity*unit_price) as total')
		          ->first();
		return $items;
	}


	/**
	 * Get totals of particular receipt items
	 */
	public static function getTotals($data){
		if(is_array($data)){
			$totals = ClaimReceiptItem::whereIn('claimReceiptID', $data)
							->selectRaw('SUM(quantity*unit_price) as grand')
							->first();

			return $totals;
		}
	}

    public static function getAmount($id){
        $amount = ClaimReceiptItem::where('claimReceiptID',$id)
        ->selectRaw('unit_price')
        ->first();

    return $amount->unit_price;    
    }		
   
   		
	
}