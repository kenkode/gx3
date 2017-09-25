<?php

/*
|--------------------------------------------------------------------------
| Application & Route Filters
|--------------------------------------------------------------------------
|
| Below you will find the "before" and "after" events for the application
| which may be used to do any work before or after a request into your
| application. Here you may also register your custom route filters.
|
*/

App::before(function($request)
{
	
});


App::after(function($request, $response)
{
	//
});




Event::listen('audit', function($entity, $action, $description) {
    
    $audit = new Audit;

    $audit->date = date('Y-m-d');
    $audit->description = $description;
    $audit->user = Confide::user()->username;
    $audit->entity = $entity;
    $audit->action = $action;
    $audit->save();
});





Route::filter('limit', function(){

	$organization = Organization::find(1);


	$members = count(Member::all());

	if($organization->licensed <= $members){

		return View::make('members.memberlimit');
	}

});


Route::filter('license', function(){

$organization = Organization::find(1);

$string = $organization->name;
$license_key =$organization->license_key;
$license_code = $organization->license_code;

$validate = $organization->license_key_validator($license_key,$license_code,$string);

if($validate){

	return View::make('activate', compact('organization'))->withErrors('License activation failed. License Key not valid');


	}

});

/*
|--------------------------------------------------------------------------
| Authentication Filters
|--------------------------------------------------------------------------
|
| The following filters are used to verify that the user of the current
| session is logged into this application. The "basic" filter easily
| integrates HTTP Basic authentication for quick, simple checking.
|
*/

Route::filter('auth', function()
{
	if (Auth::guest())
	{
		if (Request::ajax())
		{
			return Response::make('Unauthorized', 401);
		}
		else
		{
			return Redirect::guest('login');
		}
	}
});


Route::filter('auth.basic', function()
{
	return Auth::basic();
});

/*
|--------------------------------------------------------------------------
| Guest Filter
|--------------------------------------------------------------------------
|
| The "guest" filter is the counterpart of the authentication filters as
| it simply checks that the current user is not logged in. A redirect
| response will be issued if they are, which you may freely change.
|
*/

Route::filter('guest', function()
{
	if (Auth::check()) return Redirect::to('/');
});

/*
|--------------------------------------------------------------------------
| CSRF Protection Filter
|--------------------------------------------------------------------------
|
| The CSRF filter is responsible for protecting your application against
| cross-site request forgery attacks. If this special token in a user
| session does not match the one given in this request, we'll bail.
|
*/

Route::filter('csrf', function()
{
	if (Session::token() !== Input::get('_token'))
	{
		throw new Illuminate\Session\TokenMismatchException;
	}
});



//Entrust::routeNeedsPermission( 'payrollmgmt', 'process_payroll' );

Route::filter('process_payroll', function()
{
    if (! Entrust::can('process_payroll') ) // Checks the current user
    {
        return Redirect::to('dashboard')->with('notice', 'you do not have access to this resource. Contact your system admin');
    }
});

Route::filter('manage_earning', function()
{
    if (! Entrust::can('manage_earning') ) // Checks the current user
    {
        return Redirect::to('dashboard')->with('notice', 'you do not have access to this resource. Contact your system admin');
    }
});

Route::filter('manage_deduction', function()
{
    if (! Entrust::can('manage_deduction') ) // Checks the current user
    {
        return Redirect::to('dashboard')->with('notice', 'you do not have access to this resource. Contact your system admin');
    }
});

Route::filter('manage_allowance', function()
{
    if (! Entrust::can('manage_allowance') ) // Checks the current user
    {
        return Redirect::to('dashboard')->with('notice', 'you do not have access to this resource. Contact your system admin');
    }
});


Route::filter('view_application', function()
{
    if (! Entrust::can('view_applications') ) // Checks the current user
    {
        return Redirect::to('dashboard')->with('notice', 'you do not have access to this resource. Contact your system admin');
    }
});


Route::filter('amend_application', function()
{
    if (! Entrust::can('amend_application') ) // Checks the current user
    {
        return Redirect::to('dashboard')->with('notice', 'you do not have access to this resource. Contact your system admin');
    }
});

Route::filter('reject_application', function()
{
    if (! Entrust::can('reject_application') ) // Checks the current user
    {
        return Redirect::to('dashboard')->with('notice', 'you do not have access to this resource. Contact your system admin');
    }
});




Route::filter('leave_mgmt', function()
{
    if (! Entrust::can('view_application') ) // Checks the current user
    {
        return Redirect::to('dashboard')->with('notice', 'you do not have access to this resource. Contact your system admin');
    }
});


Route::filter('create_employee', function()
{
    if (! Entrust::can('create_employee') ) // Checks the current user
    {
        return Redirect::to('dashboard')->with('notice', 'you do not have access to this resource. Contact your system admin');
    }
});



Route::filter('manage_organization', function()
{
    if (! Entrust::can('manage_organization') ) // Checks the current user
    {
        return Redirect::to('dashboard')->with('notice', 'you do not have access to this resource. Contact your system admin');
    }
});

Route::filter('manage_branch', function()
{
    if (! Entrust::can('manage_branch') ) // Checks the current user
    {
        return Redirect::to('dashboard')->with('notice', 'you do not have access to this resource. Contact your system admin');
    }
});

Route::filter('manage_group', function()
{
    if (! Entrust::can('manage_group') ) // Checks the current user
    {
        return Redirect::to('dashboard')->with('notice', 'you do not have access to this resource. Contact your system admin');
    }
});

Route::filter('manage_settings', function()
{
    if (! Entrust::can('manage_settings') ) // Checks the current user
    {
        return Redirect::to('dashboard')->with('notice', 'you do not have access to this resource. Contact your system admin');
    }
});


Route::filter('manage_users', function()
{
    if (! Entrust::can('manage_user') ) // Checks the current user
    {
        return Redirect::to('dashboard')->with('notice', 'you do not have access to this resource. Contact your system admin');
    }
});

Route::filter('manage_roles', function()
{
    if (! Entrust::can('manage_role') ) // Checks the current user
    {
        return Redirect::to('dashboard')->with('notice', 'you do not have access to this resource. Contact your system admin');
    }
});

Route::filter('manage_audits', function()
{
    if (! Entrust::can('manage_audit') ) // Checks the current user
    {
        return Redirect::to('dashboard')->with('notice', 'you do not have access to this resource. Contact your system admin');
    }
});

Route::filter('manage_leavetypes', function()
{
    if (! Entrust::can('manage_leave') ) // Checks the current user
    {
        return Redirect::to('dashboard')->with('notice', 'you do not have access to this resource. Contact your system admin');
    }
});

