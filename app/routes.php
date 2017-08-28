<?php
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/


Route::get('/', function()
{

    $count = count(User::all());
    $organization = Organization::find(1);

    if($count <= 1 ){

        return View::make('login', compact('account', 'organization'));
    }


	if (Confide::user()) {

   

        return Redirect::to('/dashboard');
        } else {
            return View::make('login', compact('account', 'organization'));
        }
});



Route::get('/dashboard', function()
{
	if (Confide::user()) {


        if(Confide::user()->user_type == 'admin'){

             
          //$employees = Employee::all();
           //return View::make('dashboard', compact('employees'));

return Redirect::to('erpmgmt');

        }
       

      
        } else {
            return View::make('login', compact('account', 'organization'));
        }
});
//

Route::get('fpassword', function(){

  return View::make(Config::get('confide::forgot_password_form'));

});

Route::get('mail', function(){
  $mail = Mailsender::find(1);  
  return View::make('system.mail', compact('mail'));

});

// Confide routes
Route::resource('users', 'UsersController');
Route::get('users/create', 'UsersController@create');
Route::get('users/edit/{user}', 'UsersController@edit');
Route::post('users/update/{user}', 'UsersController@update');
Route::post('users', 'UsersController@store');
Route::get('users/add', 'UsersController@add');
Route::post('users/newuser', 'UsersController@newuser');
Route::get('users/login', 'UsersController@login');
Route::post('users/login', 'UsersController@doLogin');
Route::get('users/confirm/{code}', 'UsersController@confirm');
Route::get('users/forgot_password', 'UsersController@forgotPassword');
Route::post('users/forgot_password', 'UsersController@doForgotPassword');
Route::get('users/reset_password/{token}', 'UsersController@resetPassword');
Route::post('users/reset_password', 'UsersController@doResetPassword');
Route::get('users/logout', 'UsersController@logout');
Route::get('users/activate/{user}', 'UsersController@activate');
Route::get('users/deactivate/{user}', 'UsersController@deactivate');
Route::get('users/destroy/{user}', 'UsersController@destroy');
Route::get('users/password/{user}', 'UsersController@Password');
Route::post('users/password/{user}', 'UsersController@changePassword');
Route::get('users/profile/{user}', 'UsersController@profile');
Route::get('users/show/{user}', 'UsersController@show');



Route::post('users/pass', 'UsersController@changePassword2');

Route::group(['before' => 'manage_roles'], function() {

Route::resource('roles', 'RolesController');
Route::get('roles/create', 'RolesController@create');
Route::get('roles/edit/{id}', 'RolesController@edit');
Route::post('roles/update/{id}', 'RolesController@update');
Route::get('roles/delete/{id}', 'RolesController@destroy');

});

Route::get('import', function(){

    return View::make('import');
});


Route::group(['before' => 'manage_system'], function() {

Route::get('system', function(){


    $organization = Organization::find(1);

    return View::make('system.index', compact('organization'));
});

});



Route::get('license', function(){


    $organization = Organization::find(1);

    return View::make('system.license', compact('organization'));
});




/**
* Organization routes
*/

Route::group(['before' => 'manage_organization'], function() {

Route::resource('organizations', 'OrganizationsController');

Route::post('organizations/update/{id}', 'OrganizationsController@update');
Route::post('organizations/logo/{id}', 'OrganizationsController@logo');

});

Route::get('language/{lang}', 
           array(
                  'as' => 'language.select', 
                  'uses' => 'OrganizationsController@language'
                 )
          );


Route::resource('clients', 'ClientsController');
Route::get('clients/edit/{id}', 'ClientsController@edit');
Route::post('clients/update/{id}', 'ClientsController@update');
Route::get('clients/delete/{id}', 'ClientsController@destroy');
Route::get('clients/show/{id}', 'ClientsController@show');


/**
 * SHOW ALL CLIENTS WITH BALANCES
 */
Route::get('client/balances', function(){
  $clients = Client::where('type', 'Customer')->get();

  //return date('Y-m-d', strtotime('-3 months'));
  return View::make('clients.balances', compact('clients'));
});

Route::get('client/balances/report', 'ErpReportsController@clientBalancesReport');

/**
 * Select client statement period
 */
Route::get('client/selectPeriod/{id}', function($id){
  return View::make('clients.selectPeriod', compact('id'));
});

/**
 * Return customer statement
 */
Route::get('erpReports/clientstatement', 'ErpReportsController@ClientStatement');


Route::resource('prices', 'PricesController');
Route::get('prices/edit/{id}', 'PricesController@edit');
Route::post('prices/update/{id}', 'PricesController@update');
Route::get('prices/delete/{id}', 'PricesController@destroy');
Route::get('prices/show/{id}', 'PricesController@show');

Route::resource('items', 'ItemsController');
Route::get('items/edit/{id}', 'ItemsController@edit');
Route::post('items/update/{id}', 'ItemsController@update');
Route::get('items/delete/{id}', 'ItemsController@destroy');
Route::get('items/code/{id}', 'ItemsController@code');
Route::post('items/generate/{id}', 'ItemsController@generate');

Route::resource('expenses', 'ExpensesController');
Route::get('expenses/edit/{id}', 'ExpensesController@edit');
Route::post('expenses/update/{id}', 'ExpensesController@update');
Route::get('expenses/delete/{id}', 'ExpensesController@destroy');

Route::resource('paymentmethods', 'PaymentmethodsController');
Route::get('paymentmethods/edit/{id}', 'PaymentmethodsController@edit');
Route::post('paymentmethods/update/{id}', 'PaymentmethodsController@update');
Route::get('paymentmethods/delete/{id}', 'PaymentmethodsController@destroy');

Route::resource('payments', 'PaymentsController');
Route::get('payments/edit/{id}', 'PaymentsController@edit');
Route::post('payments/update/{id}', 'PaymentsController@update');
Route::get('payments/delete/{id}', 'PaymentsController@destroy');









Route::resource('currencies', 'CurrenciesController');
Route::get('currencies/edit/{id}', 'CurrenciesController@edit');
Route::post('currencies/update/{id}', 'CurrenciesController@update');
Route::get('currencies/delete/{id}', 'CurrenciesController@destroy');
Route::get('currencies/create', 'CurrenciesController@create');



/*
* branches routes
*/

Route::group(['before' => 'manage_branches'], function() {

Route::resource('branches', 'BranchesController');
Route::post('branches/update/{id}', 'BranchesController@update');
Route::get('branches/delete/{id}', 'BranchesController@destroy');
Route::get('branches/edit/{id}', 'BranchesController@edit');
});
/*
* groups routes
*/
Route::group(['before' => 'manage_groups'], function() {

Route::resource('groups', 'GroupsController');
Route::post('groups/update/{id}', 'GroupsController@update');
Route::get('groups/delete/{id}', 'GroupsController@destroy');
Route::get('groups/edit/{id}', 'GroupsController@edit');
});


/**
 * Bank Account Routes &
 * Bank Reconciliation Routes
 */
Route::resource('bankAccounts', 'BankAccountController');
Route::get('bankAccounts/reconcile/{id}', 'BankAccountController@showReconcile');
Route::post('bankAccounts/uploadStatement', 'BankAccountController@uploadBankStatement');
Route::post('bankAccount/reconcile', 'BankAccountController@reconcileStatement');

Route::get('bankAccount/reconcile/add/{id}/{id2}/{id3}', 'BankAccountController@addStatementTransaction');
Route::post('bankAccount/reconcile/add', 'BankAccountController@saveStatementTransaction');

Route::get('bankReconciliation/report', 'ErpReportsController@displayRecOptions');
Route::post('bankReconciliartion/generateReport', 'ErpReportsController@showRecReport');


/*
* accounts routes
*/

Route::group(['before' => 'process_payroll'], function() {

Route::resource('accounts', 'AccountsController');
Route::post('accounts/update/{id}', 'AccountsController@update');
Route::get('accounts/delete/{id}', 'AccountsController@destroy');
Route::get('accounts/edit/{id}', 'AccountsController@edit');
Route::get('accounts/show/{id}', 'AccountsController@show');
Route::get('accounts/create/{id}', 'AccountsController@create');

});

/*
* journals routes
*/
Route::resource('journals', 'JournalsController');
Route::post('journals/update/{id}', 'JournalsController@update');
Route::get('journals/delete/{id}', 'JournalsController@destroy');
Route::get('journals/edit/{id}', 'JournalsController@edit');
Route::get('journals/show/{id}', 'JournalsController@show');

/*
* Account routes
*/


Route::resource('account', 'AccountController');
Route::get('account/create', 'AccountController@create');
Route::get('account/edit/{id}', 'AccountController@edit');
Route::post('account/update/{id}', 'AccountController@update');
Route::get('account/delete/{id}', 'AccountController@destroy');

Route::get('account/show/{id}', 'AccountController@show');

Route::get('account/bank', 'AccountController@show');
Route::post('account/bank', 'AccountController@recordbanking');

/*
* license routes
*/

Route::post('license/key', 'OrganizationsController@generate_license_key');
Route::post('license/activate', 'OrganizationsController@activate_license');
Route::get('license/activate/{id}', 'OrganizationsController@activate_license_form');

/*
* Audits routes
*/
Route::group(['before' => 'manage_audits'], function() {

Route::resource('audits', 'AuditsController');

});

/*
* backups routes
*/

Route::get('backups', function(){

   
    //$backups = Backup::getRestorationFiles('../app/storage/backup/');

    return View::make('backup');

});


Route::get('backups/create', function(){

    echo '<pre>';

    $instance = Backup::getBackupEngineInstance();

    print_r($instance);

    //Backup::setPath(public_path().'/backups/');

   //Backup::export();
    //$backups = Backup::getRestorationFiles('../app/storage/backup/');

    //return View::make('backup');

});







/*
* #####################################################################################################################
*/
Route::group(['before' => 'manage_holiday'], function() {

Route::resource('holidays', 'HolidaysController');
Route::get('holidays/edit/{id}', 'HolidaysController@edit');
Route::get('holidays/delete/{id}', 'HolidaysController@destroy');
Route::post('holidays/update/{id}', 'HolidaysController@update');

});

Route::group(['before' => 'manage_leavetype'], function() {

Route::resource('leavetypes', 'LeavetypesController');
Route::get('leavetypes/edit/{id}', 'LeavetypesController@edit');
Route::get('leavetypes/delete/{id}', 'LeavetypesController@destroy');
Route::post('leavetypes/update/{id}', 'LeavetypesController@update');

});


Route::resource('leaveapplications', 'LeaveapplicationsController');
Route::get('leaveapplications/edit/{id}', 'LeaveapplicationsController@edit');
Route::get('leaveapplications/delete/{id}', 'LeaveapplicationsController@destroy');
Route::post('leaveapplications/update/{id}', 'LeaveapplicationsController@update');
Route::get('leaveapplications/approve/{id}', 'LeaveapplicationsController@approve');
Route::post('leaveapplications/approve/{id}', 'LeaveapplicationsController@doapprove');
Route::get('leaveapplications/cancel', 'LeaveapplicationsController@cancel');
Route::get('leaveapplications/reject/{id}', 'LeaveapplicationsController@reject');
Route::get('leaveapplications/show/{id}', 'LeaveapplicationsController@show');

Route::get('leaveapplications/approvals', 'LeaveapplicationsController@approvals');
Route::get('leaveapplications/rejects', 'LeaveapplicationsController@rejects');
Route::get('leaveapplications/cancellations', 'LeaveapplicationsController@cancellations');
Route::get('leaveapplications/amends', 'LeaveapplicationsController@amended');


Route::get('leaveapprovals', function(){

  $leaveapplications = Leaveapplication::all();

  return View::make('leaveapplications.approved', compact('leaveapplications'));

} );

Route::group(['before' => 'amend_application'], function() {

Route::get('leaveamends', function(){

  $leaveapplications = Leaveapplication::all();

  return View::make('leaveapplications.amended', compact('leaveapplications'));

} );

});

Route::group(['before' => 'reject_application'], function() {

Route::get('leaverejects', function(){

  $leaveapplications = Leaveapplication::all();

  return View::make('leaveapplications.rejected', compact('leaveapplications'));

} );

});

Route::group(['before' => 'manage_settings'], function() {

Route::get('migrate', function(){

    return View::make('migration');

});

});


/*
* Template routes and generators 
*/


Route::get('template/employees', function(){

  $bank_data = Bank::all();

  $bankbranch_data = BBranch::all();
 
  $branch_data = Branch::all();

  $department_data = Department::all();

  $employeetype_data = EType::all();

  $jobgroup_data = JGroup::all();

  Excel::create('Employees', function($excel) use($bank_data, $bankbranch_data, $branch_data, $department_data, $employeetype_data, $jobgroup_data, $employees) {

    require_once(base_path()."/vendor/phpoffice/phpexcel/Classes/PHPExcel/NamedRange.php");
    require_once(base_path()."/vendor/phpoffice/phpexcel/Classes/PHPExcel/Cell/DataValidation.php");

    

    $excel->sheet('employees', function($sheet) use($bank_data, $bankbranch_data, $branch_data, $department_data, $employeetype_data, $jobgroup_data, $employees){


              $sheet->row(1, array(
     'PERSONAL FILE NUMBER','EMPLOYEE', 'FIRST NAME', 'LAST NAME', 'ID', 'KRA PIN', 'BASIC PAY', ''
));

             
                $empdata = array();

                foreach($employees as $d){

                  $empdata[] = $d->personal_file_number.':'.$d->first_name.' '.$d->last_name.' '.$d->middle_name;
                }

                $emplist = implode(", ", $empdata);

                

                $listdata = array();

                foreach($data as $d){

                  $listdata[] = $d->allowance_name;
                }

                $list = implode(", ", $listdata);
   

    for($i=2; $i <= 250; $i++){

                $objValidation = $sheet->getCell('B'.$i)->getDataValidation();
                $objValidation->setType(\PHPExcel_Cell_DataValidation::TYPE_LIST);
                $objValidation->setErrorStyle(\PHPExcel_Cell_DataValidation::STYLE_INFORMATION);
                $objValidation->setAllowBlank(false);
                $objValidation->setShowInputMessage(true);
                $objValidation->setShowErrorMessage(true);
                $objValidation->setShowDropDown(true);
                $objValidation->setErrorTitle('Input error');
                $objValidation->setError('Value is not in list.');
                $objValidation->setPromptTitle('Pick from list');
                $objValidation->setPrompt('Please pick a value from the drop-down list.');
                $objValidation->setFormula1('"'.$list.'"'); //note this!



                $objValidation = $sheet->getCell('A'.$i)->getDataValidation();
                $objValidation->setType(\PHPExcel_Cell_DataValidation::TYPE_LIST);
                $objValidation->setErrorStyle(\PHPExcel_Cell_DataValidation::STYLE_INFORMATION);
                $objValidation->setAllowBlank(false);
                $objValidation->setShowInputMessage(true);
                $objValidation->setShowErrorMessage(true);
                $objValidation->setShowDropDown(true);
                $objValidation->setErrorTitle('Input error');
                $objValidation->setError('Value is not in list.');
                $objValidation->setPromptTitle('Pick from list');
                $objValidation->setPrompt('Please pick a value from the drop-down list.');
                $objValidation->setFormula1('"'.$emplist.'"'); //note this!

    }

                

                
        

    });

  })->export('xls');
});


/*
*allowance template
*
*/

Route::get('template/allowances', function(){

  $data = Allowance::all();
  $employees = Employee::all();


  Excel::create('Allowances', function($excel) use($data, $employees) {

    require_once(base_path()."/vendor/phpoffice/phpexcel/Classes/PHPExcel/NamedRange.php");
    require_once(base_path()."/vendor/phpoffice/phpexcel/Classes/PHPExcel/Cell/DataValidation.php");

    

    $excel->sheet('allowances', function($sheet) use($data, $employees){


              $sheet->row(1, array(
     'EMPLOYEE', 'ALLOWANCE TYPE', 'AMOUNT'
));

             
                $empdata = array();

                foreach($employees as $d){

                  $empdata[] = $d->personal_file_number.':'.$d->first_name.' '.$d->last_name.' '.$d->middle_name;
                }

                $emplist = implode(", ", $empdata);

                

                $listdata = array();

                foreach($data as $d){

                  $listdata[] = $d->allowance_name;
                }

                $list = implode(", ", $listdata);
   

    for($i=2; $i <= 250; $i++){

                $objValidation = $sheet->getCell('B'.$i)->getDataValidation();
                $objValidation->setType(\PHPExcel_Cell_DataValidation::TYPE_LIST);
                $objValidation->setErrorStyle(\PHPExcel_Cell_DataValidation::STYLE_INFORMATION);
                $objValidation->setAllowBlank(false);
                $objValidation->setShowInputMessage(true);
                $objValidation->setShowErrorMessage(true);
                $objValidation->setShowDropDown(true);
                $objValidation->setErrorTitle('Input error');
                $objValidation->setError('Value is not in list.');
                $objValidation->setPromptTitle('Pick from list');
                $objValidation->setPrompt('Please pick a value from the drop-down list.');
                $objValidation->setFormula1('"'.$list.'"'); //note this!



                $objValidation = $sheet->getCell('A'.$i)->getDataValidation();
                $objValidation->setType(\PHPExcel_Cell_DataValidation::TYPE_LIST);
                $objValidation->setErrorStyle(\PHPExcel_Cell_DataValidation::STYLE_INFORMATION);
                $objValidation->setAllowBlank(false);
                $objValidation->setShowInputMessage(true);
                $objValidation->setShowErrorMessage(true);
                $objValidation->setShowDropDown(true);
                $objValidation->setErrorTitle('Input error');
                $objValidation->setError('Value is not in list.');
                $objValidation->setPromptTitle('Pick from list');
                $objValidation->setPrompt('Please pick a value from the drop-down list.');
                $objValidation->setFormula1('"'.$emplist.'"'); //note this!

    }

                

                
        

    });

  })->export('xls');



});

/*
*earning template
*
*/

Route::get('template/earnings', function(){

  $employees = Employee::all();


  Excel::create('Earnings', function($excel) use($employees) {

    require_once(base_path()."/vendor/phpoffice/phpexcel/Classes/PHPExcel/NamedRange.php");
    require_once(base_path()."/vendor/phpoffice/phpexcel/Classes/PHPExcel/Cell/DataValidation.php");

    

    $excel->sheet('earnings', function($sheet) use($employees){


              $sheet->row(1, array(
     'EMPLOYEE', 'EARNING TYPE','NARRATIVE', 'AMOUNT'
));

             
                $empdata = array();

                foreach($employees as $d){

                  $empdata[] = $d->personal_file_number.':'.$d->first_name.' '.$d->last_name.' '.$d->middle_name;
                }

                $emplist = implode(", ", $empdata);

                
   

    for($i=2; $i <= 250; $i++){

                $objValidation = $sheet->getCell('B'.$i)->getDataValidation();
                $objValidation->setType(\PHPExcel_Cell_DataValidation::TYPE_LIST);
                $objValidation->setErrorStyle(\PHPExcel_Cell_DataValidation::STYLE_INFORMATION);
                $objValidation->setAllowBlank(false);
                $objValidation->setShowInputMessage(true);
                $objValidation->setShowErrorMessage(true);
                $objValidation->setShowDropDown(true);
                $objValidation->setErrorTitle('Input error');
                $objValidation->setError('Value is not in list.');
                $objValidation->setPromptTitle('Pick from list');
                $objValidation->setPrompt('Please pick a value from the drop-down list.');
                $objValidation->setFormula1('"Bonus, Commission, Others"'); //note this!



                $objValidation = $sheet->getCell('A'.$i)->getDataValidation();
                $objValidation->setType(\PHPExcel_Cell_DataValidation::TYPE_LIST);
                $objValidation->setErrorStyle(\PHPExcel_Cell_DataValidation::STYLE_INFORMATION);
                $objValidation->setAllowBlank(false);
                $objValidation->setShowInputMessage(true);
                $objValidation->setShowErrorMessage(true);
                $objValidation->setShowDropDown(true);
                $objValidation->setErrorTitle('Input error');
                $objValidation->setError('Value is not in list.');
                $objValidation->setPromptTitle('Pick from list');
                $objValidation->setPrompt('Please pick a value from the drop-down list.');
                $objValidation->setFormula1('"'.$emplist.'"'); //note this!

    }

                

                
        

    });

  })->export('xls');



});

/*
*Relief template
*
*/

Route::get('template/reliefs', function(){

  $employees = Employee::all();
  
  $data = Relief::all();

  Excel::create('Reliefs', function($excel) use($employees, $data) {

    require_once(base_path()."/vendor/phpoffice/phpexcel/Classes/PHPExcel/NamedRange.php");
    require_once(base_path()."/vendor/phpoffice/phpexcel/Classes/PHPExcel/Cell/DataValidation.php");

    

    $excel->sheet('reliefs', function($sheet) use($employees, $data){


              $sheet->row(1, array(
     'EMPLOYEE', 'RELIEF TYPE', 'AMOUNT'
));

             
                $empdata = array();

                foreach($employees as $d){

                  $empdata[] = $d->personal_file_number.':'.$d->first_name.' '.$d->last_name.' '.$d->middle_name;
                }

                $emplist = implode(", ", $empdata);

                
                $listdata = array();

                foreach($data as $d){

                  $listdata[] = $d->relief_name;
                }

                $list = implode(", ", $listdata);
   

    for($i=2; $i <= 250; $i++){

                $objValidation = $sheet->getCell('B'.$i)->getDataValidation();
                $objValidation->setType(\PHPExcel_Cell_DataValidation::TYPE_LIST);
                $objValidation->setErrorStyle(\PHPExcel_Cell_DataValidation::STYLE_INFORMATION);
                $objValidation->setAllowBlank(false);
                $objValidation->setShowInputMessage(true);
                $objValidation->setShowErrorMessage(true);
                $objValidation->setShowDropDown(true);
                $objValidation->setErrorTitle('Input error');
                $objValidation->setError('Value is not in list.');
                $objValidation->setPromptTitle('Pick from list');
                $objValidation->setPrompt('Please pick a value from the drop-down list.');
                $objValidation->setFormula1('"'.$list.'"'); //note this!



                $objValidation = $sheet->getCell('A'.$i)->getDataValidation();
                $objValidation->setType(\PHPExcel_Cell_DataValidation::TYPE_LIST);
                $objValidation->setErrorStyle(\PHPExcel_Cell_DataValidation::STYLE_INFORMATION);
                $objValidation->setAllowBlank(false);
                $objValidation->setShowInputMessage(true);
                $objValidation->setShowErrorMessage(true);
                $objValidation->setShowDropDown(true);
                $objValidation->setErrorTitle('Input error');
                $objValidation->setError('Value is not in list.');
                $objValidation->setPromptTitle('Pick from list');
                $objValidation->setPrompt('Please pick a value from the drop-down list.');
                $objValidation->setFormula1('"'.$emplist.'"'); //note this!

    }

                

                
        

    });

  })->export('xls');



});



/*
*deduction template
*
*/

Route::get('template/deductions', function(){

  $data = Deduction::all();
  $employees = Employee::all();


  Excel::create('Deductions', function($excel) use($data, $employees) {

    require_once(base_path()."/vendor/phpoffice/phpexcel/Classes/PHPExcel/NamedRange.php");
    require_once(base_path()."/vendor/phpoffice/phpexcel/Classes/PHPExcel/Cell/DataValidation.php");

    

    $excel->sheet('deductions', function($sheet) use($data, $employees){


              $sheet->row(1, array(
     'EMPLOYEE', 'DEDUCTION TYPE', 'AMOUNT','Date'
));

             
                $empdata = array();

                foreach($employees as $d){

                  $empdata[] = $d->personal_file_number.':'.$d->first_name.' '.$d->last_name.' '.$d->middle_name;
                }

                $emplist = implode(", ", $empdata);

                

                $listdata = array();

                foreach($data as $d){

                  $listdata[] = $d->deduction_name;
                }

                $list = implode(", ", $listdata);
   

    for($i=2; $i <= 250; $i++){

                $objValidation = $sheet->getCell('B'.$i)->getDataValidation();
                $objValidation->setType(\PHPExcel_Cell_DataValidation::TYPE_LIST);
                $objValidation->setErrorStyle(\PHPExcel_Cell_DataValidation::STYLE_INFORMATION);
                $objValidation->setAllowBlank(false);
                $objValidation->setShowInputMessage(true);
                $objValidation->setShowErrorMessage(true);
                $objValidation->setShowDropDown(true);
                $objValidation->setErrorTitle('Input error');
                $objValidation->setError('Value is not in list.');
                $objValidation->setPromptTitle('Pick from list');
                $objValidation->setPrompt('Please pick a value from the drop-down list.');
                $objValidation->setFormula1('"'.$list.'"'); //note this!



                $objValidation = $sheet->getCell('A'.$i)->getDataValidation();
                $objValidation->setType(\PHPExcel_Cell_DataValidation::TYPE_LIST);
                $objValidation->setErrorStyle(\PHPExcel_Cell_DataValidation::STYLE_INFORMATION);
                $objValidation->setAllowBlank(false);
                $objValidation->setShowInputMessage(true);
                $objValidation->setShowErrorMessage(true);
                $objValidation->setShowDropDown(true);
                $objValidation->setErrorTitle('Input error');
                $objValidation->setError('Value is not in list.');
                $objValidation->setPromptTitle('Pick from list');
                $objValidation->setPrompt('Please pick a value from the drop-down list.');
                $objValidation->setFormula1('"'.$emplist.'"'); //note this!

    }

                

                
        

    });

  })->export('xls');



});



/* #################### IMPORT EMPLOYEES ################################## */

Route::post('import/employees', function(){

  
  if(Input::hasFile('employees')){

      $destination = public_path().'/migrations/';

      $filename = str_random(12);

      $ext = Input::file('employees')->getClientOriginalExtension();
      $file = $filename.'.'.$ext;



      
      
     
      Input::file('employees')->move($destination, $file);


  


    Excel::selectSheetsByIndex(0)->load(public_path().'/migrations/'.$file, function($reader){

          $results = $reader->get();    
  
    foreach ($results as $result) {



      $employee = new Employee;

      $employee->personal_file_number = $result->employment_number;
      
      $employee->first_name = $result->first_name;
      $employee->last_name = $result->surname;
      $employee->middle_name = $result->other_names;
      $employee->identity_number = $result->id_number;
      $employee->pin = $result->kra_pin;
      $employee->social_security_number = $result->nssf_number;
      $employee->hospital_insurance_number = $result->nhif_number;
      $employee->email_office = $result->email_address;
      $employee->save();
      
    }
    

    

  });



      
    }



  return Redirect::back()->with('notice', 'Employees have been succeffully imported');



  

});




/* #################### IMPORT EARNINGS ################################## */

Route::post('import/earnings', function(){

  
  if(Input::hasFile('earnings')){

      $destination = public_path().'/migrations/';

      $filename = str_random(12);

      $ext = Input::file('earnings')->getClientOriginalExtension();
      $file = $filename.'.'.$ext;

     
      Input::file('earnings')->move($destination, $file);


    Excel::selectSheetsByIndex(0)->load(public_path().'/migrations/'.$file, function($reader){

          $results = $reader->get();    
  
    foreach ($results as $result) {

    $name = explode(':', $result->employee);

    
    $employeeid = DB::table('employee')->where('personal_file_number', '=', $name[0])->pluck('id');

    $earning = new Earnings;

    $earning->employee_id = $employeeid;

    $earning->earnings_name = $result->earning_type;

    $earning->narrative = $result->narrative;

    $earning->earnings_amount = $result->amount;

    $earning->save();
      
    }
    

    

  });



      
    }



  return Redirect::back()->with('notice', 'earnings have been succeffully imported');



  

});


/* #################### IMPORT RELIEFS ################################## */

Route::post('import/reliefs', function(){

  
  if(Input::hasFile('reliefs')){

      $destination = public_path().'/migrations/';

      $filename = str_random(12);

      $ext = Input::file('reliefs')->getClientOriginalExtension();
      $file = $filename.'.'.$ext;

     
      Input::file('reliefs')->move($destination, $file);


    Excel::selectSheetsByIndex(0)->load(public_path().'/migrations/'.$file, function($reader){

          $results = $reader->get();    
  
    foreach ($results as $result) {

    $name = explode(':', $result->employee);

    
    $employeeid = DB::table('employee')->where('personal_file_number', '=', $name[0])->pluck('id');

    $reliefid = DB::table('relief')->where('relief_name', '=', $result->relief_type)->pluck('id');

    $relief = new ERelief;

    $relief->employee_id = $employeeid;

    $relief->relief_id = $reliefid;

    $relief->relief_amount = $result->amount;

    $relief->save();
      
    }
    

    

  });



      
    }



  return Redirect::back()->with('notice', 'reliefs have been succeffully imported');



  

});



/* #################### IMPORT ALLOWANCES ################################## */

Route::post('import/allowances', function(){

  
  if(Input::hasFile('allowances')){

      $destination = public_path().'/migrations/';

      $filename = str_random(12);

      $ext = Input::file('allowances')->getClientOriginalExtension();
      $file = $filename.'.'.$ext;



      
      
     
      Input::file('allowances')->move($destination, $file);


  


  Excel::selectSheetsByIndex(0)->load(public_path().'/migrations/'.$file, function($reader){

    $results = $reader->get();    
  
    foreach ($results as $result) {

    $name = explode(':', $result->employee);

    

    
    $employeeid = DB::table('employee')->where('personal_file_number', '=', $name[0])->pluck('id');

    $allowanceid = DB::table('allowances')->where('allowance_name', '=', $result->allowance_type)->pluck('id');

    $allowance = new EAllowances;

    $allowance->employee_id = $employeeid;

    $allowance->allowance_id = $allowanceid;

    $allowance->allowance_amount = $result->amount;

    $allowance->save();

    
      
    }
    

    

  });



      
    }



  return Redirect::back()->with('notice', 'allowances have been succefully imported');



  

});


/* #################### IMPORT DEDUCTIONS ################################## */

Route::post('import/deductions', function(){

  
  if(Input::hasFile('deductions')){

      $destination = public_path().'/migrations/';

      $filename = str_random(12);

      $ext = Input::file('deductions')->getClientOriginalExtension();
      $file = $filename.'.'.$ext;



      
      
     
      Input::file('deductions')->move($destination, $file);


  


  Excel::selectSheetsByIndex(0)->load(public_path().'/migrations/'.$file, function($reader){

    $results = $reader->get();    
  
    foreach ($results as $result) {

    $name = explode(':', $result->employee);

    

    
    $employeeid = DB::table('employee')->where('personal_file_number', '=', $name[0])->pluck('id');

    $deductionid = DB::table('deductions')->where('deduction_name', '=', $result->deduction_type)->pluck('id');

    $deduction = new EDeduction;

    $deduction->employee_id = $employeeid;

    $deduction->deduction_id = $deductionid;

    $deduction->deduction_amount = $result->amount;

    $deduction->deduction_date = $result->date;

    $deduction->save();

    
      
    }
    

    

  });



      
    }



  return Redirect::back()->with('notice', 'deductions have been succefully imported');



  

});







/*
* #####################################################################################################################
*/
/*
* banks routes
*/

Route::resource('banks', 'BanksController');
Route::post('banks/update/{id}', 'BanksController@update');
Route::get('banks/delete/{id}', 'BanksController@destroy');
Route::get('banks/edit/{id}', 'BanksController@edit');

/*
* departments routes
*/

Route::resource('departments', 'DepartmentsController');
Route::post('departments/update/{id}', 'DepartmentsController@update');
Route::get('departments/delete/{id}', 'DepartmentsController@destroy');
Route::get('departments/edit/{id}', 'DepartmentsController@edit');


/*
* bank branch routes
*/

Route::resource('bank_branch', 'BankBranchController');
Route::post('bank_branch/update/{id}', 'BankBranchController@update');
Route::get('bank_branch/delete/{id}', 'BankBranchController@destroy');
Route::get('bank_branch/edit/{id}', 'BankBranchController@edit');

/*
* allowances routes
*/

Route::resource('allowances', 'AllowancesController');
Route::post('allowances/update/{id}', 'AllowancesController@update');
Route::get('allowances/delete/{id}', 'AllowancesController@destroy');
Route::get('allowances/edit/{id}', 'AllowancesController@edit');

/*
* reliefs routes
*/

Route::resource('reliefs', 'ReliefsController');
Route::post('reliefs/update/{id}', 'ReliefsController@update');
Route::get('reliefs/delete/{id}', 'ReliefsController@destroy');
Route::get('reliefs/edit/{id}', 'ReliefsController@edit');

/*
* deductions routes
*/

Route::resource('deductions', 'DeductionsController');
Route::post('deductions/update/{id}', 'DeductionsController@update');
Route::get('deductions/delete/{id}', 'DeductionsController@destroy');
Route::get('deductions/edit/{id}', 'DeductionsController@edit');

/*
* nssf routes
*/

Route::resource('nssf', 'NssfController');
Route::post('nssf/update/{id}', 'NssfController@update');
Route::get('nssf/delete/{id}', 'NssfController@destroy');
Route::get('nssf/edit/{id}', 'NssfController@edit');

/*
* nhif routes
*/

Route::resource('nhif', 'NhifController');
Route::post('nhif/update/{id}', 'NhifController@update');
Route::get('nhif/delete/{id}', 'NhifController@destroy');
Route::get('nhif/edit/{id}', 'NhifController@edit');

/*
* job group routes
*/

Route::resource('job_group', 'JobGroupController');
Route::post('job_group/update/{id}', 'JobGroupController@update');
Route::get('job_group/delete/{id}', 'JobGroupController@destroy');
Route::get('job_group/edit/{id}', 'JobGroupController@edit');

/*
* employee type routes
*/

Route::resource('employee_type', 'EmployeeTypeController');
Route::post('employee_type/update/{id}', 'EmployeeTypeController@update');
Route::get('employee_type/delete/{id}', 'EmployeeTypeController@destroy');
Route::get('employee_type/edit/{id}', 'EmployeeTypeController@edit');

/*
* employees routes
*/

Route::resource('employees', 'EmployeesController');
Route::post('employees/update/{id}', 'EmployeesController@update');
Route::get('employees/delete/{id}', 'EmployeesController@destroy');
Route::get('employees/edit/{id}', 'EmployeesController@edit');

/*
* employee earnings routes
*/

Route::resource('other_earnings', 'EarningsController');
Route::post('other_earnings/update/{id}', 'EarningsController@update');
Route::get('other_earnings/delete/{id}', 'EarningsController@destroy');
Route::get('other_earnings/edit/{id}', 'EarningsController@edit');

/*
* employee reliefs routes
*/

Route::resource('employee_relief', 'EmployeeReliefController');
Route::post('employee_relief/update/{id}', 'EmployeeReliefController@update');
Route::get('employee_relief/delete/{id}', 'EmployeeReliefController@destroy');
Route::get('employee_relief/edit/{id}', 'EmployeeReliefController@edit');

/*
* employee allowances routes
*/

Route::resource('employee_allowances', 'EmployeeAllowancesController');
Route::post('employee_allowances/update/{id}', 'EmployeeAllowancesController@update');
Route::get('employee_allowances/delete/{id}', 'EmployeeAllowancesController@destroy');
Route::get('employee_allowances/edit/{id}', 'EmployeeAllowancesController@edit');

/*
* employee deductions routes
*/

Route::resource('employee_deductions', 'EmployeeDeductionsController');
Route::post('employee_deductions/update/{id}', 'EmployeeDeductionsController@update');
Route::get('employee_deductions/delete/{id}', 'EmployeeDeductionsController@destroy');
Route::get('employee_deductions/edit/{id}', 'EmployeeDeductionsController@edit');

/*
* payroll routes
*/


Route::resource('payroll', 'PayrollController');
Route::post('deleterow', 'PayrollController@del_exist');
Route::post('payroll/preview', 'PayrollController@create');


/*
* employees routes
*/
Route::resource('employees', 'EmployeesController');
Route::get('employees/show/{id}', 'EmployeesController@show');
Route::group(['before' => 'create_employee'], function() {
Route::get('employees/create', 'EmployeesController@create');
});
Route::get('employees/edit/{id}', 'EmployeesController@edit');
Route::post('employees/update/{id}', 'EmployeesController@update');
Route::get('employees/delete/{id}', 'EmployeesController@destroy');





Route::get('payrollReports', function(){

    return View::make('employees.payrollreports');
});

Route::get('statutoryReports', function(){

    return View::make('employees.statutoryreports');
});

Route::get('email/payslip', 'payslipEmailController@index');
Route::post('email/payslip/employees', 'payslipEmailController@sendEmail');

Route::get('reports/employeelist', 'ReportsController@employees');
Route::get('employee/select', 'ReportsController@emp_id');
Route::post('reports/employee', 'ReportsController@individual');
Route::get('payrollReports/selectPeriod', 'ReportsController@period_payslip');
Route::post('payrollReports/payslip', 'ReportsController@payslip');
Route::get('payrollReports/selectAllowance', 'ReportsController@employee_allowances');
Route::post('payrollReports/allowances', 'ReportsController@allowances');
Route::get('payrollReports/selectDeduction', 'ReportsController@employee_deductions');
Route::post('payrollReports/deductions', 'ReportsController@deductions');
Route::get('payrollReports/selectPayePeriod', 'ReportsController@period_paye');
Route::post('payrollReports/payeReturns', 'ReportsController@payeReturns');
Route::get('payrollReports/selectRemittancePeriod', 'ReportsController@period_rem');
Route::post('payrollReports/payRemittances', 'ReportsController@payeRems');
Route::get('payrollReports/selectSummaryPeriod', 'ReportsController@period_summary');
Route::post('payrollReports/payrollSummary', 'ReportsController@paySummary');
Route::get('payrollReports/selectNssfPeriod', 'ReportsController@period_nssf');
Route::post('payrollReports/nssfReturns', 'ReportsController@nssfReturns');
Route::get('payrollReports/selectNhifPeriod', 'ReportsController@period_nhif');
Route::post('payrollReports/nhifReturns', 'ReportsController@nhifReturns');

/*
*##########################ERP REPORTS#######################################
*/

Route::get('erpReports', function(){

    return View::make('erpreports.erpReports');
});

Route::get('erpReports/clients', 'ErpReportsController@clients');
Route::get('erpReports/selectClientsPeriod', 'ErpReportsController@selectClientsPeriod');




Route::post('erpReports/items', 'ErpReportsController@items');
Route::get('erpReports/selectItemsPeriod', 'ErpReportsController@selectItemsPeriod');

Route::post('erpReports/expenses', 'ErpReportsController@expenses');
Route::get('erpReports/selectExpensesPeriod', 'ErpReportsController@selectExpensesPeriod');


Route::get('erpReports/paymentmethods', 'ErpReportsController@paymentmethods');

Route::get('erpReports/payments', 'ErpReportsController@payments');
Route::get('erpReports/selectPaymentsPeriod', 'ErpReportsController@selectPaymentsPeriod');

Route::get('erpReports/invoice/{id}', 'ErpReportsController@invoice');
Route::get('erpReports/customerstatement/{id}', 'ErpReportsController@customerstatement');
Route::get('erpReports/delivery_note/{id}', 'ErpReportsController@delivery_note');


Route::post('erpReports/sales', 'ErpReportsController@sales');
Route::get('erpReports/sales_summary', 'ErpReportsController@sales_Summary');
Route::get('erpReports/selectSalesPeriod', 'ErpReportsController@selectSalesPeriod');
Route::get('erpReports/selectSalesComparisonPeriod', 'ErpReportsController@selectSalesComparisonPeriod');
Route::post('erpReports/getComparisonReport', 'ErpReportsController@getSalesComparison');
Route::get('erpReports/selectSalesSummaryMonth', 'ErpReportsController@getSelectSummaryMonth');
Route::post('erpReports/customerSalesSummary', 'ErpReportsController@customerSalesSummary');



Route::post('erpReports/purchases', 'ErpReportsController@purchases');
Route::get('erpReports/selectPurchasesPeriod', 'ErpReportsController@selectPurchasesPeriod');



Route::get('erpReports/quotation/{id}', 'ErpReportsController@quotation');
Route::get('erpReports/pricelist', 'ErpReportsController@pricelist');
Route::post('erpReports/receipt/{id}', 'ErpReportsController@receipt');
Route::get('erpReports/PurchaseOrder/{id}', 'ErpReportsController@PurchaseOrder');

Route::get('erpReports/locations', 'ErpReportsController@locations');

Route::get('erpReports/stocks', 'ErpReportsController@stock');
Route::get('erpReports/selectStockPeriod', 'ErpReportsController@selectStockPeriod');


Route::get('erpReports/accounts', 'ErpReportsController@accounts');

Route::post('erpReports/vehicles', 'ErpReportsController@vehicles');
Route::get('erpReports/selectVehiclesPeriod', 'ErpReportsController@selectVehiclesPeriod');
Route::get('erpReports/mergedReport', 'ErpReportsController@mergedReport');




Route::resource('taxes', 'TaxController');
Route::post('taxes/update/{id}', 'TaxController@update');
Route::get('taxes/delete/{id}', 'TaxController@destroy');
Route::get('taxes/edit/{id}', 'TaxController@edit');


Route::resource('salestargets', 'SalestargetController');
Route::post('salestargets/update/{id}', 'SalestargetController@update');
Route::get('salestargets/delete/{id}', 'SalestargetController@destroy');
Route::get('salestargets/edit/{id}', 'SalestargetController@edit');




/*
*#################################################################
*/
Route::group(['before' => 'process_payroll'], function() {

    


Route::get('payrollmgmt', function(){

     $employees = Employee::all();

  return View::make('payrollmgmt', compact('employees'));

});

});

Route::group(['before' => 'leave_mgmt'], function() {

Route::get('leavemgmt', function(){

  $leaveapplications = Leaveapplication::all();

  return View::make('leavemgmt', compact('leaveapplications'));

});

});


Route::get('erpmgmt', function(){

  return View::make('erpmgmt');

});



Route::get('cbsmgmt', function(){


      if(Confide::user()->user_type == 'admin'){

            $members = Member::all();

            //print_r($members);

            return View::make('cbsmgmt', compact('members'));

        } 

        if(Confide::user()->user_type == 'teller'){

            $members = Member::all();

            return View::make('tellers.dashboard', compact('members'));

        } 


        if(Confide::user()->user_type == 'member'){

            $loans = Loanproduct::all();
            $products = Product::all();

            $rproducts = Product::getRemoteProducts();

            
            return View::make('shop.index', compact('loans', 'products', 'rproducts'));

        } 


  



});





/*
* #####################################################################################################################
*/









Route::get('import', function(){

    return View::make('import');
});


Route::get('automated/loans', function(){

    
    $loanproducts = Loanproduct::all();

    return View::make('autoloans', compact('loanproducts'));
});

Route::get('automated/savings', function(){

    
   $savingproducts = Savingproduct::all();

    return View::make('automated', compact('savingproducts'));
});



Route::post('automated', function(){

    $members = DB::table('members')->where('is_active', '=', true)->get();


    $category = Input::get('category');


    
    
    if($category == 'savings'){

        $savingproduct_id = Input::get('savingproduct');

        $savingproduct = Savingproduct::findOrFail($savingproduct_id);

        

            foreach($savingproduct->savingaccounts as $savingaccount){

                if(($savingaccount->member->is_active) && (Savingaccount::getLastAmount($savingaccount) > 0)){

                    
                    $data = array(
                        'account_id' => $savingaccount->id,
                        'amount' => Savingaccount::getLastAmount($savingaccount), 
                        'date' => date('Y-m-d'),
                        'type'=>'credit'
                        );

                    Savingtransaction::creditAccounts($data);
                    

                    

                }
 
                

            

    }

       Autoprocess::record(date('Y-m-d'), 'saving', $savingproduct); 
      

        

    } else {

        $loanproduct_id = Input::get('loanproduct');

        $loanproduct = Loanproduct::findOrFail($loanproduct_id);


        

        

            foreach($loanproduct->loanaccounts as $loanaccount){

                if(($loanaccount->member->is_active) && (Loanaccount::getEMP($loanaccount) > 0)){

                    
                    
                    $data = array(
                        'loanaccount_id' => $loanaccount->id,
                        'amount' => Loanaccount::getEMP($loanaccount), 
                        'date' => date('Y-m-d')
                        
                        );


                    Loanrepayment::repayLoan($data);
                    

                    
                   

                    

                }
            }


             Autoprocess::record(date('Y-m-d'), 'loan', $loanproduct);
            

    }


    

    return Redirect::back()->with('notice', 'successfully processed');
    

    
});






Route::get('loanrepayments/offprint/{id}', 'LoanrepaymentsController@offprint');



Route::resource('members', 'MembersController');
Route::post('members/update/{id}', 'MembersController@update');
Route::get('members/delete/{id}', 'MembersController@destroy');
Route::get('members/edit/{id}', 'MembersController@edit');

Route::get('members/show/{id}', 'MembersController@show');
Route::get('members/loanaccounts/{id}', 'MembersController@loanaccounts');
Route::get('memberloans', 'MembersController@loanaccounts2');
Route::group(['before' => 'limit'], function() {

    Route::get('members/create', 'MembersController@create');
});

Route::resource('kins', 'KinsController');
Route::post('kins/update/{id}', 'KinsController@update');
Route::get('kins/delete/{id}', 'KinsController@destroy');
Route::get('kins/edit/{id}', 'KinsController@edit');
Route::get('kins/show/{id}', 'KinsController@show');
Route::get('kins/create/{id}', 'KinsController@create');





Route::resource('charges', 'ChargesController');
Route::post('charges/update/{id}', 'ChargesController@update');
Route::get('charges/delete/{id}', 'ChargesController@destroy');
Route::get('charges/edit/{id}', 'ChargesController@edit');
Route::get('charges/show/{id}', 'ChargesController@show');
Route::get('charges/disable/{id}', 'ChargesController@disable');
Route::get('charges/enable/{id}', 'ChargesController@enable');

Route::resource('savingproducts', 'SavingproductsController');
Route::post('savingproducts/update/{id}', 'SavingproductsController@update');
Route::get('savingproducts/delete/{id}', 'SavingproductsController@destroy');
Route::get('savingproducts/edit/{id}', 'SavingproductsController@edit');
Route::get('savingproducts/show/{id}', 'SavingproductsController@show');




Route::resource('savingaccounts', 'SavingaccountsController');
Route::get('savingaccounts/create/{id}', 'SavingaccountsController@create');
Route::get('member/savingaccounts/{id}', 'SavingaccountsController@memberaccounts');



Route::get('savingtransactions/show/{id}', 'SavingtransactionsController@show');
Route::resource('savingtransactions', 'SavingtransactionsController');
Route::get('savingtransactions/create/{id}', 'SavingtransactionsController@create');
Route::get('savingtransactions/receipt/{id}', 'SavingtransactionsController@receipt');
Route::get('savingtransactions/statement/{id}', 'SavingtransactionsController@statement');

Route::post('savingtransactions/import', 'SavingtransactionsController@import');

//Route::resource('savingpostings', 'SavingpostingsController');



Route::resource('shares', 'SharesController');
Route::post('shares/update/{id}', 'SharesController@update');
Route::get('shares/delete/{id}', 'SharesController@destroy');
Route::get('shares/edit/{id}', 'SharesController@edit');
Route::get('shares/show/{id}', 'SharesController@show');



Route::get('sharetransactions/show/{id}', 'SharetransactionsController@show');
Route::resource('sharetransactions', 'SharetransactionsController');
Route::get('sharetransactions/create/{id}', 'SharetransactionsController@create');





Route::post('license/key', 'OrganizationsController@generate_license_key');
Route::post('license/activate', 'OrganizationsController@activate_license');
Route::get('license/activate/{id}', 'OrganizationsController@activate_license_form');



Route::resource('loanproducts', 'LoanproductsController');
Route::post('loanproducts/update/{id}', 'LoanproductsController@update');
Route::get('loanproducts/delete/{id}', 'LoanproductsController@destroy');
Route::get('loanproducts/edit/{id}', 'LoanproductsController@edit');
Route::get('loanproducts/show/{id}', 'LoanproductsController@show');



Route::resource('loanguarantors', 'LoanguarantorsController');
Route::post('loanguarantors/update/{id}', 'LoanguarantorsController@update');
Route::get('loanguarantors/delete/{id}', 'LoanguarantorsController@destroy');
Route::get('loanguarantors/edit/{id}', 'LoanguarantorsController@edit');
Route::get('loanguarantors/create/{id}', 'LoanguarantorsController@create');
Route::get('loanguarantors/css/{id}', 'LoanguarantorsController@csscreate');

Route::post('loanguarantors/cssupdate/{id}', 'LoanguarantorsController@cssupdate');
Route::get('loanguarantors/cssdelete/{id}', 'LoanguarantorsController@cssdestroy');
Route::get('loanguarantors/cssedit/{id}', 'LoanguarantorsController@cssedit');



Route::resource('loans', 'LoanaccountsController');
Route::get('loans/apply/{id}', 'LoanaccountsController@apply');
Route::post('loans/apply', 'LoanaccountsController@doapply');
Route::post('loans/application', 'LoanaccountsController@doapply2');


Route::get('loantransactions/statement/{id}', 'LoantransactionsController@statement');
Route::get('loantransactions/receipt/{id}', 'LoantransactionsController@receipt');

Route::get('loans/application/{id}', 'LoanaccountsController@apply2');
Route::post('shopapplication', 'LoanaccountsController@shopapplication');

Route::get('loans/edit/{id}', 'LoanaccountsController@edit');
Route::post('loans/update/{id}', 'LoanaccountsController@update');

Route::get('loans/approve/{id}', 'LoanaccountsController@approve');
Route::post('loans/approve/{id}', 'LoanaccountsController@doapprove');


Route::get('loans/reject/{id}', 'LoanaccountsController@reject');
Route::post('loans/reject/{id}', 'LoanaccountsController@doreject');

Route::get('loans/disburse/{id}', 'LoanaccountsController@disburse');
Route::post('loans/disburse/{id}', 'LoanaccountsController@dodisburse');

Route::get('loans/show/{id}', 'LoanaccountsController@show');

Route::post('loans/amend/{id}', 'LoanaccountsController@amend');

Route::get('loans/reject/{id}', 'LoanaccountsController@reject');
Route::post('loans/reject/{id}', 'LoanaccountsController@rejectapplication');


Route::get('loanaccounts/topup/{id}', 'LoanaccountsController@gettopup');
Route::post('loanaccounts/topup/{id}', 'LoanaccountsController@topup');

Route::get('memloans/{id}', 'LoanaccountsController@show2');

Route::resource('loanrepayments', 'LoanrepaymentsController');

Route::get('loanrepayments/create/{id}', 'LoanrepaymentsController@create');
Route::get('loanrepayments/offset/{id}', 'LoanrepaymentsController@offset');
Route::post('loanrepayments/offsetloan', 'LoanrepaymentsController@offsetloan');





Route::get('reports', function(){

    return View::make('members.reports');
});

Route::get('reports/combined', function(){

    $members = Member::all();

    return View::make('members.combined', compact('members'));
});


Route::get('loanreports', function(){

    $loanproducts = Loanproduct::all();

    return View::make('loanaccounts.reports', compact('loanproducts'));
});


Route::get('savingreports', function(){

    $savingproducts = Savingproduct::all();

    return View::make('savingaccounts.reports', compact('savingproducts'));
});


Route::get('financialreports', function(){

    

    return View::make('pdf.financials.reports');
});



Route::get('reports/listing', 'ReportsController@members');
Route::get('reports/remittance', 'ReportsController@remittance');
Route::get('reports/blank', 'ReportsController@template');
Route::get('reports/loanlisting', 'ReportsController@loanlisting');

Route::get('reports/loanproduct/{id}', 'ReportsController@loanproduct');

Route::get('reports/savinglisting', 'ReportsController@savinglisting');

Route::get('reports/savingproduct/{id}', 'ReportsController@savingproduct');

Route::post('reports/financials', 'ReportsController@financials');



Route::get('portal', function(){

    $members = DB::table('members')->where('is_active', '=', TRUE)->get();
    return View::make('css.members', compact('members'));
});

Route::get('portal/activate/{id}', 'MembersController@activateportal');
Route::get('portal/deactivate/{id}', 'MembersController@deactivateportal');
Route::get('css/reset/{id}', 'MembersController@reset');








/*
* Vendor controllers
*/
Route::resource('vendors', 'VendorsController');
Route::get('vendors/create', 'VendorsController@create');
Route::post('vendors/update/{id}', 'VendorsController@update');
Route::get('vendors/edit/{id}', 'VendorsController@edit');
Route::get('vendors/delete/{id}', 'VendorsController@destroy');
Route::get('vendors/products/{id}', 'VendorsController@products');
Route::get('vendors/orders/{id}', 'VendorsController@orders');

/*
* products controllers
*/
Route::resource('products', 'ProductsController');
Route::post('products/update/{id}', 'ProductsController@update');
Route::get('products/edit/{id}', 'ProductsController@edit');
Route::get('products/create', 'ProductsController@create');
Route::get('products/delete/{id}', 'ProductsController@destroy');
Route::get('products/orders/{id}', 'ProductsController@orders');
Route::get('shop', 'ProductsController@shop');

/*
* orders controllers
*/
Route::resource('orders', 'OrdersController');
Route::post('orders/update/{id}', 'OrdersControler@update');
Route::get('orders/edit/{id}', 'OrdersControler@edit');
Route::get('orders/delete/{id}', 'OrdersControler@destroy');




/*
* purchase orders controllers
*/
Route::resource('purchases', 'PurchasesController');
Route::post('purchases/update/{id}', 'PurchasesController@update');
Route::get('purchases/edit/{id}', 'PurchasesController@edit');
Route::get('purchases/delete/{id}', 'PurchasesController@destroy');


/*
* purchase orders controllers
*/
Route::resource('quotations', 'QuotationsController');
Route::post('quotations/update/{id}', 'QuotationsController@update');
Route::get('quotations/edit/{id}', 'QuotationsController@edit');
Route::get('quotations/delete/{id}', 'QuotationsController@destroy');




Route::get('savings', function(){

    $mem = Confide::user()->username;

   

    $memb = DB::table('members')->where('membership_no', '=', $mem)->pluck('id');

    $member = Member::find($memb);

    
    

    return View::make('css.savingaccounts', compact('member'));
});


Route::post('loanguarantors', function(){

    
    $mem_id = Input::get('member_id');

        $member = Member::findOrFail($mem_id);

        $loanaccount = Loanaccount::findOrFail(Input::get('loanaccount_id'));


        $guarantor = new Loanguarantor;

        $guarantor->member()->associate($member);
        $guarantor->loanaccount()->associate($loanaccount);
        $guarantor->amount = Input::get('amount');
        $guarantor->save();
        


        return Redirect::to('memloans/'.$loanaccount->id);

});




Route::get('backups', function(){

   
    //$backups = Backup::getRestorationFiles('../app/storage/backup/');

    return View::make('backup');

});


Route::get('backups/create', function(){

    echo '<pre>';

    $instance = Backup::getBackupEngineInstance();

    print_r($instance);

    //Backup::setPath(public_path().'/backups/');

   //Backup::export();
    //$backups = Backup::getRestorationFiles('../app/storage/backup/');

    //return View::make('backup');

});


Route::get('memtransactions/{id}', 'MembersController@savingtransactions');


/*
* This route is for testing how license conversion works. its purely for testing purposes
*/
Route::get('convert', function(){




// get the name of the organization from the database
//$org_id = Confide::user()->organization_id;

$organization = Organization::findorfail(1);



$string =  $organization->name;

echo "Organization: ". $string."<br>";


$organization = new Organization;






$license_code = $organization->encode($string);

echo "License Code: ".$license_code."<br>";


$name2 = $organization->decode($license_code, 7);

echo "Decoded L code: ".$name2."<br>";





$license_key = $organization->license_key_generator($license_code);

echo "License Key: ".$license_key."<br>";

echo "__________________________________________________<br>";

$name4 = $organization->license_key_validator($license_key,$license_code,$string);

echo "Decoded L code: ".$name4."<br>";



});




/* ########################  ERP ROUTES ################################ */

/* 
* items routes here 
*/
Route::resource('items', 'ItemsController');


/*
* client routes come here
*/

Route::resource('clients', 'ClientsController');


Route::resource('paymentmethods', 'PaymentmethodsController');


Route::resource('locations', 'LocationsController');
Route::get('locations/edit/{id}', 'LocationsController@edit');
Route::get('locations/delete/{id}', 'LocationsController@destroy');
Route::post('locations/update/{id}', 'LocationsController@update');


Route::resource('expenses', 'ExpensesController');

Route::resource('erporders', 'ErpordersController');
Route::resource('erppurchases', 'ErppurchasesController');
Route::resource('erpquotations', 'ErpquotationsController');


Route::resource('erporderitems', 'ErporderitemsController');
Route::resource('erppurchaseitems', 'ErppurchaseitemsController');
Route::resource('erpquotationitems', 'ErpquotationitemsController');

Route::resource('payments', 'PaymentsController');
// GET DAILY PAYMENTS RECEIVED & GENERATE PDF
Route::get('daily_payments/today', 'PaymentsController@dailyPayments');
Route::get('daily_payments/pdf', 'ErpReportsController@dailyPaymentsPDF');


// Route::get('erppurchases/payment/{id}',    'ErppurchasesController@payment');
// Route::post('erppurchases/payment/{id}',    'ErppurchasesController@recordpayment');

Route::resource('vehicles', 'VehiclesController');
Route::get('vehicles/edit/{id}', 'VehiclesController@edit');
Route::get('vehicles/delete/{id}', 'VehiclesController@destroy');
Route::post('vehicles/update/{id}', 'VehiclesController@update');
Route::get('vehicles/show/{id}', 'VehiclesController@show');

Route::resource('drivers', 'DriversController');
Route::get('drivers/edit/{id}', 'DriversController@edit');
Route::get('drivers/delete/{id}', 'DriversController@destroy');
Route::post('drivers/update/{id}', 'DriversController@update');
Route::get('drivers/show/{id}', 'DriversController@show');

Route::resource('assigndrivers', 'AssigndriversController');
Route::get('assigndrivers/edit/{id}', 'AssigndriversController@edit');
Route::get('assigndrivers/delete/{id}', 'AssigndriversController@destroy');
Route::post('assigndrivers/update/{id}', 'AssigndriversController@update');
Route::get('assigndrivers/show/{id}', 'AssigndriversController@show');


Route::get('salesorders', function(){

  $orders = Erporder::all();
  $items = Item::all();
  $locations = Location::all();

  return View::make('erporders.index', compact('items', 'locations', 'orders'));
});



Route::get('purchaseorders', function(){

  $purchases = Erporder::all();
  $items = Item::all();
  $locations = Location::all();


  return View::make('erppurchases.index', compact('items', 'locations', 'purchases'));
});



Route::get('quotationorders', function(){

  $quotations = Erporder::all();
  $items = Item::all();
  $locations = Location::all();
  $items = Item::all();
  $locations = Location::all();

  return View::make('erpquotations.index', compact('items', 'locations', 'quotations'));
});


Route::get('salesorders/create', function(){

  $count = DB::table('erporders')->count();
  $order_number = date("Y/m/d/").str_pad($count+1, 4, "0", STR_PAD_LEFT);
  $items = Item::all();
  $locations = Location::all();

  $clients = Client::all();

  return View::make('erporders.create', compact('items', 'locations', 'order_number', 'clients'));
});


Route::get('purchaseorders/create', function(){

  $count = DB::table('erporders')->count();
  $order_number = date("Y/m/d/").str_pad($count+1, 4, "0", STR_PAD_LEFT);
  $items = Item::all();
  $locations = Location::all();

  $clients = Client::all();

  return View::make('erppurchases.create', compact('items', 'locations', 'order_number', 'clients'));
});


Route::get('quotationorders/create', function(){

  $count = DB::table('erporders')->count();
  $order_number = date("Y/m/d/").str_pad($count+1, 4, "0", STR_PAD_LEFT);;
  $items = Item::all();
  $locations = Location::all();

  $clients = Client::all();

  return View::make('erpquotations.create', compact('items', 'locations', 'order_number', 'clients'));
});

Route::post('erporders/create', function(){

  $data = Input::all();

  $client = Client::findOrFail(array_get($data, 'client'));

/*
  $erporder = array(
    'order_number' => array_get($data, 'order_number'), 
    'client' => $client,
    'date' => array_get($data, 'date')

    );
  */

  Session::put( 'erporder', array(
    'order_number' => array_get($data, 'order_number'), 
    'client' => $client,
    'date' => array_get($data, 'date'),
    'payment_type' => array_get($data, 'payment_type'),
    'percentage_discount' => array_get($data, 'percentage_discount')

    )
    );
  Session::put('orderitems', []);

  $orderitems =Session::get('orderitems');

 /*
  $erporder = new Erporder;

  $erporder->date = date('Y-m-d', strtotime(array_get($data, 'date')));
  $erporder->order_number = array_get($data, 'order_number');
  $erporder->client()->associate($client);
  $erporder->payment_type = array_get($data, 'payment_type');
  $erporder->type = 'sales';
  $erporder->save();

  */

  $items = Item::all();
  $locations = Location::all();
  $taxes = Tax::all();

  return View::make('erporders.orderitems', compact('erporder', 'items', 'locations', 'taxes','orderitems'));

});



Route::post('erppurchases/create', function(){

  $data = Input::all();

  $client = Client::findOrFail(array_get($data, 'client'));

/*
  $erporder = array(
    'order_number' => array_get($data, 'order_number'), 
    'client' => $client,
    'date' => array_get($data, 'date')

    );
  */

  Session::put( 'erporder', array(
    'order_number' => array_get($data, 'order_number'), 
    'client' => $client,
    'date' => array_get($data, 'date')

    )
    );
  Session::put('purchaseitems', []);

  $orderitems =Session::get('purchaseitems');

 /*
  $erporder = new Erporder;

  $erporder->date = date('Y-m-d', strtotime(array_get($data, 'date')));
  $erporder->order_number = array_get($data, 'order_number');
  $erporder->client()->associate($client);
  $erporder->payment_type = array_get($data, 'payment_type');
  $erporder->type = 'sales';
  $erporder->save();

  */

  $items = Item::all();
  $locations = Location::all();
  $taxes = Tax::all();

  return View::make('erppurchases.purchaseitems', compact('items', 'locations','taxes','orderitems'));

});





Route::post('erpquotations/create', function(){

  $data = Input::all();

  $client = Client::findOrFail(array_get($data, 'client'));

/*
  $erporder = array(
    'order_number' => array_get($data, 'order_number'), 
    'client' => $client,
    'date' => array_get($data, 'date')

    );
  */

  Session::put( 'erporder', array(
    'order_number' => array_get($data, 'order_number'), 
    'client' => $client,
    'date' => array_get($data, 'date'),
    'percentage_discount' => array_get($data, 'percentage_discount')

    )
    );
  Session::put('quotationitems', []);

  $orderitems =Session::get('quotationitems');

 /*
  $erporder = new Erporder;

  $erporder->date = date('Y-m-d', strtotime(array_get($data, 'date')));
  $erporder->order_number = array_get($data, 'order_number');
  $erporder->client()->associate($client);
  $erporder->payment_type = array_get($data, 'payment_type');
  $erporder->type = 'sales';
  $erporder->save();

  */

  $items = Item::all();
  $locations = Location::all();
  $taxes = Tax::all();

  return View::make('erpquotations.quotationitems', compact('items', 'locations','taxes','orderitems'));

});







Route::post('orderitems/create', function(){

  $data = Input::all();

  $item = Item::findOrFail(array_get($data, 'item'));

  $item_name = $item->name;
  $price = $item->selling_price;
  $quantity = Input::get('quantity');
  $duration = Input::get('duration');
  $item_id = $item->id;
  $location = Input::get('location');
  $discount_amount = Input::get('percentage_discount');

   Session::push('orderitems', [
      'itemid' => $item_id,
      'item' => $item_name,
      'price' => $price,
      'quantity' => $quantity,
      'duration' => $duration,
      'location' =>$location,
      'discount_amount'=>$discount_amount
    ]);



  $orderitems = Session::get('orderitems');

   $items = Item::all();
  $locations = Location::all();
  $taxes = Tax::all();

  return View::make('erporders.orderitems', compact('items', 'locations', 'taxes','orderitems'));

});






Route::post('purchaseitems/create', function(){

  $data = Input::all();

  $item = Item::findOrFail(array_get($data, 'item'));

  $item_name = $item->name;
  $price = $item->purchase_price;
  $quantity = Input::get('quantity');
  $duration = Input::get('duration');
  $item_id = $item->id;

   Session::push('purchaseitems', [
      'itemid' => $item_id,
      'item' => $item_name,
      'price' => $price,
      'quantity' => $quantity,
      'duration' => $duration
    ]);



  $orderitems = Session::get('purchaseitems');

   $items = Item::all();
  $locations = Location::all();
  $taxes = Tax::all();

  return View::make('erppurchases.purchaseitems', compact('items', 'locations', 'taxes','orderitems'));

});






Route::post('quotationitems/create', function(){

  $data = Input::all();

  $item = Item::findOrFail(array_get($data, 'item'));

  $item_name = $item->name;
  $price = $item->selling_price;
  $quantity = Input::get('quantity');
  $duration = Input::get('duration');
  $item_id = $item->id;
  $discount_amount = Input::get('percentage_discount');

   Session::push('quotationitems', [
      'itemid' => $item_id,
      'item' => $item_name,
      'price' => $price,
      'quantity' => $quantity,
      'duration' => $duration,
      'discount_amount'=>$discount_amount

    ]);



  $orderitems = Session::get('quotationitems');
  $items = Item::all();
  $locations = Location::all();
  $taxes = Tax::all();

  return View::make('erpquotations.quotationitems', compact('items', 'locations', 'taxes','orderitems'));

});




/**
 * STOCKS
 */
Route::resource('stocks', 'StocksController');

Route::get('stock/tracking', function(){
  $stocks = Stock::all();
  $items = Item::all();
  $clients = Client::all();
  $location = Location::all();
  $leased = ItemTracker::all();

  return View::make('stocks/track', compact('stocks', 'items', 'clients', 'location', 'leased'));
});


/**
 * LEASE AN ITEM
 */
Route::post('stock/lease', function(){
  $client_id = Input::get('client');
  $item_id = Input::get('item');
  $location_id = Input::get('location');
  $quantity = Input::get('lease_qty');

  $items = Item::findOrfail($item_id);
  $timestamp = date("Y-m-d H:i:s");
  $location = Location::findorfail($location_id);

  if($quantity > Stock::getStockAmount($items)){
    return "Quantity Exceeds Total Stocks!";
  } else if($client_id === "" || $item_id === "" || $quantity === ""){
    return 'Enter all the fields!';
  } else{

    $track = new ItemTracker;
    $track->item_id = $item_id;
    $track->items_leased = $quantity;
    $track->location_id = $location_id;
    $track->client_id = $client_id;
    $track->status = "$quantity Item(s) Leased";
    $track->date_leased = date("Y-m-d");
    $track->save();

    Stock::removeStock($items, $location, $quantity, $timestamp);
    return Redirect::back()->with('message', 'Item(s) successfully leased.');
  }

});


/**
 * RETURN LEASED ITEM(S)
 */
Route::post('stock/return', function(){
  $id = Input::get('track_id');
  $qty = Input::get('qty_returned');

  
  $timestamp = date("Y-m-d H:i:s");
  $location = Location::findorfail(ItemTracker::where('id', $id)->pluck('location_id'));
  
  $returned = ItemTracker::findOrfail($id);
  $returned->increment('items_returned', $qty);
  $returned->status = "$qty Item(s) returned";
  $returned->date_returned = date("Y-m-d");
  $returned->update();

  $items = Item::findOrfail($returned->item_id);

  Stock::addStock($items, $location, $qty, $timestamp);
  return Redirect::back()->with('message', 'Item(s) successfully returned.');

});



Route::resource('erporders', 'ErporderssController');






Route::post('erporder/commit', function(){

  $erporder = Session::get('erporder');

  $erporderitems = Session::get('orderitems');
  
   $total = Input::all();

 // $client = Client: :findorfail(array_get($erporder, 'client'));

 // print_r($total);


  $order = new Erporder;
  $order->order_number = array_get($erporder, 'order_number');
  $order->client()->associate(array_get($erporder, 'client'));
  $order->date = date('Y-m-d', strtotime(array_get($erporder, 'date')));
  $order->status = 'new';
  $order->discount_amount = array_get($total, 'discount');
  $order->type = 'sales';  
  $order->payment_type = array_get($erporder, 'payment_type');
  $order->save();
  

  foreach($erporderitems as $item){


    $itm = Item::findOrFail($item['itemid']);

    $ord = Erporder::findOrFail($order->id);


    
    $location_id = $item['location'];

     $location = Location::find($location_id);    
    
    $date = date('Y-m-d', strtotime(array_get($erporder, 'date')));

    $orderitem = new Erporderitem;
    $orderitem->erporder()->associate($ord);
    $orderitem->item()->associate($itm);
    $orderitem->price = $item['price'];
    $orderitem->quantity = $item['quantity'];
    $orderitem->duration = $item['duration'];
    $orderitem->client_discount = $item['discount_amount'] * $item['quantity'];
    $orderitem->save();



   Stock::removeStock($itm, $location, $item['quantity'], $date);



  }
 

  $tax = Input::get('tax');
  $rate = Input::get('rate');





  for($i=0; $i < count($rate);  $i++){

    $txOrder = new TaxOrder;

    $txOrder->tax_id = $rate[$i];
    $txOrder->order_number = array_get($erporder, 'order_number');
    $txOrder->amount = $tax[$i];
    $txOrder->save();
    
  }
  
 
//Session::flush('orderitems');
//Session::flush('erporder');  
 
    

return Redirect::to('salesorders')->withFlashMessage('Order Successfully Placed!');



});


Route::get('erppurchase/commit', function(){

  //$orderitems = Session::get('erppurchase');

  $erporder = Session::get('erporder');

  $orderitems = Session::get('purchaseitems');
  
   $total = Input::all();

 // $client = Client: :findorfail(array_get($erporder, 'client'));

 // print_r($total);


  $order = new Erporder;
  $order->order_number = array_get($erporder, 'order_number');
  $order->client()->associate(array_get($erporder, 'client'));
  $order->date = date('Y-m-d', strtotime(array_get($erporder, 'date')));
  $order->status = 'new';
  //$order->discount_amount = array_get($total, 'discount');
  $order->type = 'purchases';
  $order->save();
  

  foreach($orderitems as $item){


    $itm = Item::findOrFail($item['itemid']);

    $ord = Erporder::findOrFail($order->id);

    $orderitem = new Erporderitem;
    $orderitem->erporder()->associate($ord);
    $orderitem->item()->associate($itm);
    $orderitem->price = $item['price'];
    $orderitem->quantity = $item['quantity'];
    //s$orderitem->duration = $item['duration'];
    $orderitem->save();
  }
  
 
//Session::flush('orderitems');
//Session::flush('erporder');
return Redirect::to('purchaseorders');



});


Route::post('erpquotation/commit', function(){

  $erporder = Session::get('erporder');

  $erporderitems = Session::get('quotationitems');
  
   $total = Input::all();

 // $client = Client: :findorfail(array_get($erporder, 'client'));

 // print_r($total);


  $order = new Erporder;
  $order->order_number = array_get($erporder, 'order_number');
  $order->client()->associate(array_get($erporder, 'client'));
  $order->date = date('Y-m-d', strtotime(array_get($erporder, 'date')));
  $order->status = 'new';
  $order->discount_amount = array_get($total, 'discount');
  $order->type = 'quotations';  
  $order->save();
  

  foreach($erporderitems as $item){


    $itm = Item::findOrFail($item['itemid']);

    $ord = Erporder::findOrFail($order->id);


    
    //$location_id = $item['location'];

     //$location = Location::find($location_id);    
    
    $date = date('Y-m-d', strtotime(array_get($erporder, 'date')));

    $orderitem = new Erporderitem;
    $orderitem->erporder()->associate($ord);
    $orderitem->item()->associate($itm);
    $orderitem->price = $item['price'];
    $orderitem->quantity = $item['quantity'];
    $orderitem->client_discount = $item['discount_amount'] * $item['quantity'];
    $orderitem->save();

     }
 

  $tax = Input::get('tax');
  $rate = Input::get('rate');





  for($i=0; $i < count($rate);  $i++){

    $txOrder = new TaxOrder;

    $txOrder->tax_id = $rate[$i];
    $txOrder->order_number = array_get($erporder, 'order_number');
    $txOrder->amount = $tax[$i];
    $txOrder->save();
    
  }
  
 
//Session::flush('orderitems');
//Session::flush('erporder');  
 
    

return Redirect::to('quotationorders');


});


Route::get('erporders/cancel/{id}', function($id){

  $order = Erporder::findorfail($id);



  $order->status = 'cancelled';
  $order->update();

  return Redirect::to('salesorders');
  
});


Route::get('erporders/delivered/{id}', function($id){

  $order = Erporder::findorfail($id);

  $order->status = 'delivered';
  $order->update();

  return Redirect::to('salesorders');
  
});


Route::get('erppurchases/cancel/{id}', function($id){

  $order = Erporder::findorfail($id);

  $order->status = 'cancelled';
  $order->update();

  return Redirect::to('purchaseorders');
  
});



Route::get('erppurchases/delivered/{id}', function($id){

  $order = Erporder::findorfail($id);

  $order->status = 'delivered';
  $order->update();

  return Redirect::to('purchaseorders');
  
});




Route::get('erpquotations/cancel/{id}', function($id){

  $order = Erporder::findorfail($id);

  $order->status = 'cancelled';
  $order->update();

  return Redirect::to('quotationorders');
  
});




Route::get('erporders/show/{id}', function($id){

  $order = Erporder::findorfail($id);

  $orders = DB::table('erporders')
                ->join('erporderitems', 'erporders.id', '=', 'erporderitems.erporder_id')
                ->join('items', 'erporderitems.item_id', '=', 'items.id')
                ->join('clients', 'erporders.client_id', '=', 'clients.id')
                ->where('erporders.id','=',$id)
                ->select('clients.name as client','items.name as item','quantity','clients.address as address',
                  'clients.phone as phone','clients.email as email','erporders.id as id',
                  'discount_amount','erporders.order_number as order_number','price','description')
                ->first();

  $driver = Driver::all();
    //return $driver;

  return View::make('erporders.show', compact('order', 'driver', 'orders'));
  
});



Route::get('erppurchases/show/{id}', function($id){

  $order = Erporder::findorfail($id);

  return View::make('erppurchases.show', compact('order'));
  
});


Route::get('erppurchases/payment/{id}', function($id){

  $payments = Payment::all();

  $purchase = Erporder::findorfail($id);    

  $account = Accounts::all();

  return View::make('erppurchases.payment', compact('payments', 'purchase', 'account'));
  
});



Route::get('erpquotations/show/{id}', function($id){

  $order = Erporder::findorfail($id);

  return View::make('erpquotations.show', compact('order'));
  
});


/**
 * 
 * EDITING AND DELETING OF QUOTATIONS AND ORDERS (PURCHASES, SALES)
 * =================================================================
 * === QUOTATIONS ===
 * === EDITING ITEMS IN SESSION (IN CART) ===
 *** Deleting a session item 
 */
Route::get('quotationitems/remove/{count}', function($count){
  $items = Session::get('quotationitems');
  unset($items[$count]);
  $newItems = array_values($items);
  Session::put('quotationitems', $newItems);


  $orderitems = Session::get('quotationitems');
  $items = Item::all();
  $locations = Location::all();
  $taxes = Tax::all();

  return View::make('erpquotations.quotationitems', compact('items', 'locations', 'taxes','orderitems'));
  //return Session::get('quotationitems')[$count];
});


/**
 * EDITING QUOTATION ITEMS IN SESSION
 */
Route::get('quotationitems/edit/{count}', function($count){
  $editItem = Session::get('quotationitems')[$count];

  return View::make('erpquotations.sessionedit', compact('editItem', 'count'));
});


Route::post('erpquotations/sessionedit/{count}', function($sesItemID){
  $quantity = Input::get('qty');
  $price = (float) Input::get('price');

  $ses = Session::get('quotationitems');
  
  $ses[$sesItemID]['quantity']=$quantity;
  $ses[$sesItemID]['price']=$price;
  Session::put('quotationitems', $ses);

  $orderitems = Session::get('quotationitems');
  $items = Item::all();
  $locations = Location::all();
  $taxes = Tax::all();

  return View::make('erpquotations.quotationitems', compact('items', 'locations', 'taxes','orderitems'));
});


/**
 * === EDITING SALES ORDER ===
 * Deleing items from order session
 */
Route::get('orderitems/remove/{count}', function($count){
  $items = Session::get('orderitems');
  unset($items[$count]);
  $newItems = array_values($items);
  Session::put('orderitems', $newItems);


  $orderitems = Session::get('orderitems');
  dd($orderitems);
  $items = Item::all();
  $locations = Location::all();
  $taxes = Tax::all();

  return View::make('erporders.orderitems', compact('items', 'locations', 'taxes','orderitems'));
});


/**
 * EDITING SALES ORDER IN SESSION
 */
Route::get('orderitems/edit/{count}', function($count){
  $editItem = Session::get('orderitems')[$count];

  return View::make('erporders.edit', compact('editItem', 'count'));
});

Route::post('orderitems/edit/{count}', function($sesItemID){
  $quantity = Input::get('qty');
  $price = (float) Input::get('price');
  //return $data['qty'].' - '.$data['price'];

  $ses = Session::get('orderitems');
  //unset($ses);
  $ses[$sesItemID]['quantity']=$quantity;
  $ses[$sesItemID]['price']=$price;
  Session::put('orderitems', $ses);

  $orderitems = Session::get('orderitems');
  $items = Item::all();
  $locations = Location::all();
  $taxes = Tax::all();

  return View::make('erporders.orderitems', compact('items', 'locations', 'taxes','orderitems'));
  
});


/**
 * === EDITING PURCHASE ORDERS === 
 * Deleting items from purchase order session
 */
Route::get('purchaseitems/remove/{count}', function($count){
  $items = Session::get('purchaseitems');
  unset($items[$count]);
  $newItems = array_values($items);
  Session::put('purchaseitems', $newItems);


  $orderitems = Session::get('purchaseitems');
  $items = Item::all();
  $locations = Location::all();
  $taxes = Tax::all();

  return View::make('erppurchases.purchaseitems', compact('items', 'locations', 'taxes','orderitems'));
});


/**
 * EDIT PURCHASE ITEMS IN SESSION
 */
Route::get('purchaseitems/edit/{count}', function($count){
  $editItem = Session::get('purchaseitems')[$count];

  return View::make('erppurchases.edit', compact('editItem', 'count'));
});

Route::post('erppurchases/edit/{count}', function($sesItemID){
  $quantity = Input::get('qty');
  $price = (float) Input::get('price');
  //return $data['qty'].' - '.$data['price'];

  $ses = Session::get('purchaseitems');
  //unset($ses);
  $ses[$sesItemID]['quantity']=$quantity;
  $ses[$sesItemID]['price']=$price;
  Session::put('purchaseitems', $ses);

  $orderitems = Session::get('purchaseitems');
  $items = Item::all();
  $locations = Location::all();
  $taxes = Tax::all();

  return View::make('erppurchases.purchaseitems', compact('items', 'locations', 'taxes','orderitems'));
  
});


/**
 * === END EDITING AND DELETING ===
 */


/**
 * QUOTATION ACTIONS (APPROVE, REJECT, MAIL)
 * === APPROVE QUOTATION 'X' ===
 */
Route::post('/erpquotations/approve', function(){
  $id = Input::get('order_id');
  $comment = Input::get('comment');

  $order = Erporder::findorfail($id);

  $order->status = 'APPROVED';
  if($comment === ''){
    $order->comment = 'No comment.';
  } else{
    $order->comment = $comment;
  }

  $order->update();

  return Redirect::to('erpquotations/show/'.$id);
});


/**
 * REJECT QUOTATION 'X'
 */
Route::post('/erpquotations/reject', function(){
  $id = Input::get('order_id');
  $comment = Input::get('comment');

  $order = Erporder::findorfail($id);

  $order->status = 'REJECTED';
  if($comment === ''){
    $order->comment = 'No comment.';
  } else{
    $order->comment = $comment;
  }

  $order->update();

  return Redirect::to('erpquotations/show/'.$id);
});


/**
 * MAIL ERP QUOTATION TO CLIENT 'X'
 */
Route::post('erpquotations/mail', 'ErpReportsController@sendMail_quotation');


/**
 * EDIT QUOTATION 'X'
 */
Route::get('erpquotations/edit/{id}', function($id){
  $order = Erporder::findorfail($id);
  $items = Item::all();
  $taxes = Tax::all();
  $tax_orders = TaxOrder::where('order_number', $order->order_number)->orderBy('tax_id', 'ASC')->get();

  //return $tax_orders;
  return View::make('erpquotations.editquotation', compact('order', 'items', 'taxes', 'tax_orders'));

});


/**
 * ADD ITEMS TO EXISTING ORDER
 */
Route::post('erpquotations/edit/add', function(){
    $order_id = Input::get('order_id');
    $item_id = Input::get('item_id');
    $quantity = Input::get('quantity');
    
    $item = Item::findorfail($item_id);
    $item_price = $item->selling_price;

    $itemId = Erporderitem::where('erporder_id', $order_id)->where('item_id', $item_id)->get();
    
    if(count($itemId) > 0){
        return Redirect::back()->with('error', "Item already exists! You can edit the existing item.");
    } else{
        $order_item = new Erporderitem;
        
        $order_item->item_id = $item_id;
        $order_item->quantity = $quantity;
        $order_item->erporder_id = $order_id;   
        $order_item->price = $item_price;
        $order_item->save();

        return Redirect::back(); 
    }
});


/**
 * COMMIT CHANGES
 */
Route::post('erpquotations/edit/{id}', function($id){
    $order = Erporder::findOrFail($id);

    foreach($order->erporderitems as $orderitem){
        $val = Input::get('newQty'.$orderitem->item_id);
        $price = Input::get('newPrice'.$orderitem->item_id);
        
        $orderitem->price = $price;
        $orderitem->quantity = $val;
        $orderitem->save();
    }  

    $discount = Input::get('discount');
    $order->discount_amount = $discount;

    $tax = Input::get('tax');
    $rate = Input::get('rate');

    for($i=0; $i < count($rate);  $i++){
        if(count(TaxOrder::getAmount($rate[$i],$order->order_number)) > 0){
            $txOrder = TaxOrder::findOrfail($rate[$i]);
            $txOrder->amount = $tax[$i];
            $txOrder->update();
        } else{
            $txOrder = new TaxOrder;
            $txOrder->tax_id = $rate[$i];
            $txOrder->order_number = array_get($order, 'order_number');
            $txOrder->amount = $tax[$i];
            $txOrder->save();
        }
    }

    $order->status = 'EDITED';
    $order->update();
    return View::make('erpquotations.show', compact('order'));
});









Route::get('api/getrate', function(){
    $id = Input::get('option');
    $tax = Tax::find($id);
    return $tax->rate;
});

Route::get('api/getdiscount', function(){
    $id = Input::get('option');
    $cid = Input::get('client');

    $price = Price::where('client_id',$cid)->where('Item_id',$id)->first();
    $count = Price::where('client_id',$cid)->where('Item_id',$id)->count();
   if($count == 0){
    return 0;
   }else{
    return $price->Discount;
  }
});

Route::get('api/getsellingprice', function(){
    $id = Input::get('option');
    $item = Item::find($id);
    return $item->selling_price;
});

Route::get('api/getcontact', function(){
    $id = Input::get('option');
    $driver = Driver::find($id);
    return $driver->contact;
});

Route::get('api/getmodel', function(){
    $id = Input::get('option');
    $vehicle = Vehicle::find($id);
    return $vehicle->model;
});

// Route::get('api/getpurchased', function(){
//     $id = Input::get('option');
//     $erporderitems = Erporderitem::find($id);
//     return $erporderitems->quantity;
// });

Route::get('api/getmax', function(){
    $id = Input::get('option');
    $stock_in = DB::table('stocks')
         ->join('items', 'stocks.item_id', '=', 'items.id')
         ->where('item_id',$id)
         ->sum('quantity_in');

    $stock_out = DB::table('stocks')
         ->join('items', 'stocks.item_id', '=', 'items.id')
         ->where('item_id',$id)
         ->sum('quantity_out');
    return $stock_in-$stock_out;
});


Route::get('api/total', function(){
    $id = Input::get('option');
    $tax = Tax::find($id);
    $client = Client::find($id);
    $order = 0;
    

          if($client->type == 'Customer'){
            $order = DB::table('erporders')
                   ->join('erporderitems','erporders.id','=','erporderitems.erporder_id')
                   ->join('clients','erporders.client_id','=','clients.id')           
                   ->where('clients.id',$id)
                   ->where('erporders.type','=','sales')
                   ->where('erporders.status','!=','cancelled')
                   ->selectRaw('SUM(price * quantity)-COALESCE(SUM(discount_amount),0)- COALESCE(SUM(erporderitems.client_discount),0)  as total')
                   ->pluck('total');
          } else{
            $order = DB::table('erporders')
                   ->join('erporderitems','erporders.id','=','erporderitems.erporder_id')
                   ->join('clients','erporders.client_id','=','clients.id')           
                   ->where('clients.id',$id)
                   ->where('erporders.status', '!=', 'cancelled')
                   ->selectRaw('SUM(price * quantity)as total')
                   ->pluck('total');
          }

    $paid = DB::table('clients')
           ->join('payments','clients.id','=','payments.client_id')
           ->where('clients.id',$id) ->selectRaw('COALESCE(SUM(amount_paid),0) as due')
           ->pluck('due');

   /* $discount = DB::table('erporders')
              ->join('erporderitems','erporders.id','=','erporderitems.erporder_id')
              ->join('clients','erporders.client_id','=','clients.id') 
              ->select ('discount_amount')
              ->get();*/

    return number_format($order-$paid, 2);
});

Route::get('email/send', 'ErpReportsController@sendMail');
Route::get('email/send_sales', 'ErpReportsController@sendMail_sales');
Route::get('email/send_sales_summary', 'ErpReportsController@sendMail_sales_summary');
Route::get('email/send_purchases', 'ErpReportsController@sendMail_purchases');
Route::get('email/send_expenses', 'ErpReportsController@sendMail_expenses');
Route::get('email/send_payments', 'ErpReportsController@sendMail_payments');
Route::get('email/send_stock', 'ErpReportsController@sendMail_stock');
Route::get('email/send_account', 'ErpReportsController@sendMail_account');
Route::get('email/send_merged','ErpReportsController@sendMail_MergedReport');

// Send Merged Report
Route::get('sendMergedMail', 'ErpReportsController@sendMailTo');


Route::resource('mails', 'MailsController');
Route::get('mailtest', 'MailsController@test');


Route::get('seedmail', function(){

  $mail = new Mailsender;

  $mail->driver = 'smtp';
  $mail->save();
});