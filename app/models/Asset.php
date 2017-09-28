<?php 

class Asset extends \Eloquent{
	public $table = 'assets';

	public static $rules = [

	];

	public static function registerAsset($data){
		$asset = new Asset;

		$asset->asset_name = $data['assetName'];
		$asset->asset_number = $data['assetNumber'];
		$asset->purchase_date = $data['purchaseDate'];
		$asset->purchase_price = $data['purchasePrice'];
		$asset->book_value = $data['purchasePrice'];
		$asset->warranty_expiry = $data['warrantyExpiry'];
		$asset->serial_number = $data['serialNumber'];
		$asset->depreciation_start_date = $data['depreciationStartDate'];
		$asset->depreciation_method = $data['depreciationMethod'];
		$asset->averaging_method = $data['averagingMethod'];
		$asset->salvage_value = $data['salvageValue'];
		$asset->method = $data['method'];
		$asset->rate = $data['rate'];
		$asset->years = $data['lifeYears'];

		$asset->save();
	}

	/**
	 * Update Asset Details
	 */
	public static function updateAsset($data){
		$asset = Asset::find($data['asset_id']);

		$asset->asset_name = $data['assetName'];
		$asset->asset_number = $data['assetNumber'];
		$asset->purchase_date = $data['purchaseDate'];
		$asset->purchase_price = $data['purchasePrice'];
		$asset->book_value = $data['purchasePrice'];
		$asset->warranty_expiry = $data['warrantyExpiry'];
		$asset->serial_number = $data['serialNumber'];
		$asset->depreciation_start_date = $data['depreciationStartDate'];
		$asset->depreciation_method = $data['depreciationMethod'];
		$asset->averaging_method = $data['averagingMethod'];
		$asset->salvage_value = $data['salvageValue'];
		$asset->method = $data['method'];
		$asset->rate = $data['rate'];
		$asset->years = $data['lifeYears'];

		$asset->update();
	}

	/**
	 * Calculate Depreciation
	 */
	public static function calculateDepreciation($id){
		$asset = Asset::find($id);

		$annualDep = 0;
		$monthlyDep = 0;
		$dailyDep = 0;

		if($asset->depreciation_method == 'SL'){
			// STRAIGHT-LINE METHOD
			if($asset->method == 'rate'){
				$annualDep = ($asset->rate/100)*($asset->purchase_price - $asset->salvage_value);
			} else if($asset->method == 'years'){
				$annualDep = ($asset->purchase_price - $asset->salvage_value)/$asset->years;
			}

			$monthlyDep = $annualDep/12;
			$dailyDep = round($annualDep/365, 2);

			if($asset->averaging_method == 'FULLMO'){
				// Normal monthly depreciation
				$seconds = strtotime(date('Y-m-d')) - strtotime($asset->depreciation_start_date);
				$days = floor($seconds/(24*60*60));
				$depAmount = $dailyDep * $days;
				return $depAmount;

			} else if($asset->averaging_method == 'HALFYR'){
				// Half-Year Depreciation (Monthly Depreciation - Half)
				if(date('Y') == date('Y', strtotime($asset->depreciation_start_date))){
					$annualDep2 = $annualDep/2;
					$dailyDep2 = round($annualDep2/365, 2);

					$seconds = strtotime(date('Y-m-d')) - strtotime($asset->depreciation_start_date);
					$days = floor($seconds/(24*60*60));
					$depAmount = $dailyDep2 * $days;
				} else{
					$annualDep2 = $annualDep/2;
					$dailyDep2 = round($annualDep2/365, 2);

					$yr = date('Y', strtotime($asset->depreciation_start_date));
					$fDays = floor((strtotime(date($yr.'-12-31')) - strtotime($asset->depreciation_start_date))/(24*60*60));
					$depAmount_1 = $fDays *  $dailyDep2;

					$sDays = floor((strtotime(date('Y-m-d')) - strtotime(date($yr.'-12-31')))/(24*60*60));
					$depAmount_2 = $sDays * $dailyDep;

					$depAmount = $depAmount_1 + $depAmount_2;
				}
				return $depAmount;
				
			} else if($asset->averaging_method == 'MIDMO'){
				//
			} else if($asset->averaging_method == 'MIDQ'){
				//
			}

		} else if($asset->depreciation_method == 'DB'){
			// DOUBLE-DECLINING METHOD
			if($asset->method == 'rate'){
				$ddbRate = 1.5*($asset->rate/100);
			} else if($asset->method == 'years'){
				$ddbRate = 1.5*(100/$asset->years);
			}

			$daysLapsed = date('z')+1;
			$period = date('Y') - date('Y', strtotime($asset->depreciation_start_date));

			$seconds = strtotime(date('Y-m-d')) - strtotime($asset->depreciation_start_date);
			$days = floor($seconds/(24*60*60));

			if($asset->averaging_method == 'FULLMO'){
				if(date('Y') == date('Y', strtotime($asset->depreciation_start_date))){
					$depAmount = round((($ddbRate * ($asset->purchase_price))/365)*$days, 2);
					return $depAmount;
				} else{
					$cumDep = 0; //$ddbRate * ($asset->purchase_price);
					$subTDep = 0;
					for($k=1; $k<=$period; $k++){
						$dep = $ddbRate * ($asset->purchase_price - $cumDep);
						$cumDep += $dep;
						$subTDep += $dep;
					}

					$finalYearDep = (($ddbRate * ($asset->purchase_price - $cumDep))/365)*$daysLapsed;
					$depAmount = round($depAmount + $subTDep, 2);
					return $depAmount;
				}

			} else if($asset->averaging_method == 'HALFYR'){
				if(date('Y') == date('Y', strtotime($asset->depreciation_start_date))){
					$depAmount = round((($ddbRate * (($asset->purchase_price))/365)/2)*$days, 2);
					return $depAmount;
				} else{
					$fYearDep = (($ddbRate * (($asset->purchase_price))/365)/2);
					$cumDep = $fYearDep; //$ddbRate * ($asset->purchase_price);
					$subTDep = 0;
					for($k=2; $k<=$period; $k++){
						$dep = $ddbRate * ($asset->purchase_price - $cumDep);
						$cumDep += $dep;
						$subTDep += $dep;
					}

					$finalYearDep = (($ddbRate * ($asset->purchase_price - $cumDep))/365)*$daysLapsed;
					$depAmount = round($fYearDep + $depAmount + $subTDep, 2);
					return $depAmount;
				}
			}


		} else if($asset->depreciation_method == 'SY'){
			// SUM-OF-YEARS METHOD
			if($asset->method == 'years'){
				$depValue = ($asset->purchase_price - $asset->salvage_value);
				$life = $asset->years;
				$soy = ($asset->years*($asset->years + 1))/2;
				$today = date("z") + 1; 
				$period = date('Y') - date('Y', strtotime($asset->depreciation_start_date));

				//return $depValue;
				if(date('m', strtotime($asset->depreciation_start_date)) == 02){
					if($period < 1){
						$annual = (($life-1+1)/($soy)*($depValue));
						$depAmount = round(($annual/365)*$today, 2);
						return $depAmount;
					} else{
						$totalDep = 0;
						for($i=1; $i<=$period; $i++){
							$annual = ((($life-$i+1)/($soy))*($depValue));
							$totalDep+=$annual;
						}
						$currentYrDep = ((($life-($period+1)+1)/($soy)*($depValue))/365)*$today;
						$depAmount = round($totalDep+$currentYrDep, 2);
						return $depAmount;
					}
				} else{
					$fyPeriod = 12 - date('m', strtotime($asset->depreciation_start_date));
					$rmPeriod = 12 - $fyPeriod;
					$fYearPeriod = 365 - date('z', strtotime($asset->depreciation_start_date));
					$today2 = date('z') - date('z', strtotime($asset->depreciation_start_date));

					if($period < 1){
						$annual = (($fyPeriod/12)*(($life-1+1)/($soy))*($depValue));
						$depAmount = round(($annual/365)*$today2, 2);
						return $depAmount;
					} else{
						$fYear = (($fyPeriod/12)*(($life-1+1)/($soy))*($depValue));
						$subTotalDep = 0;
						$lYear = 0;
						for($j=2; $j<=$period; $j++){
							$depV = ((($rmPeriod/12)*(($life-$j+1)/($soy))*($depValue))) + ((($fyPeriod/12)*(($life-$j+1)/($soy))*($depValue)));
							$subTotalDep += $depV;
						}

						if(date('m') <= date('m', strtotime($asset->depreciation_start_date))){
							$lYear = ((($rmPeriod/12)*(($life-$j+1)/($soy))*($depValue))/(date('z', strtotime($asset->depreciation_start_date)) + 1)) * (date('z')+1);
						} else{
							$lYear = ((($rmPeriod/12)*(($life-$j+1)/($soy))*($depValue))) + ((((($fyPeriod/12)*(($life-$j+1)/($soy))*($depValue)))/$fYearPeriod)*$today2);
						}

						$depAmount = round($fYear + $subTotalDep + $lYear, 2);
						return $depAmount;

					}
				}
			}
		}

	}
}