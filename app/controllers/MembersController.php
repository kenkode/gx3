<?php

class MembersController extends \BaseController {




	/**
	 * Display a listing of members
	 *
	 * @return Response
	 */
	public function index()
	{
		$members = Member::all();

		

		return View::make('members.index', compact('members'));
	}


	public function members(){

		//$members = Member::all();

		$pdf = PDF::loadView('pdf.blank')->setPaper('a4')->setOrientation('potrait');
 	
		return $pdf->stream('MemberList.pdf');
		
	}

	
	/**
	 * Show the form for creating a new member
	 *
	 * @return Response
	 */
	public function create()
	{


		
		
		$this->beforeFilter('limit');

		
		$branches = Branch::all();
		$groups = Group::all();
		$savingproducts = Savingproduct::all();

		return View::make('members.create', compact('branches', 'groups', 'savingproducts'));
	}

	/**
	 * Store a newly created member in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Validator::make($data = Input::all(), Member::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}


		$member = new Member;

		if(Input::get('branch_id') != null){

			$branch = Branch::findOrFail(Input::get('branch_id'));
			$member->branch()->associate($branch);
		}
		
		if(Input::get('group_id') != null){

			$group = Group::findOrFail(Input::get('group_id'));
			$member->group()->associate($group);
		}

		

		

		


		if(Input::hasFile('photo')){

			$destination = public_path().'/uploads/photos';

			$filename = str_random(12);

			$ext = Input::file('photo')->getClientOriginalExtension();
			$photo = $filename.'.'.$ext;
			
			
			Input::file('photo')->move($destination, $photo);

			
			$member->photo = $photo;
			
		}


		if(Input::hasFile('signature')){

			$destination = public_path().'/uploads/photos';

			$filename = str_random(12);

			$ext = Input::file('signature')->getClientOriginalExtension();
			$photo = $filename.'.'.$ext;
			
			
			Input::file('signature')->move($destination, $photo);

			
			$member->signature = $photo;
			
		}


		$member->name = Input::get('name');
		$member->id_number = Input::get('id_number');
		$member->membership_no = Input::get('membership_no');
		$member->phone = Input::get('phone');
		$member->email = Input::get('email');
		$member->address = Input::get('address');
		$member->monthly_remittance_amount = Input::get('monthly_remittance_amount');
		$member->gender = Input::get('gender');
		if(Input::get('active') == '1'){

			

			$member->is_active = TRUE;
		} else {

			$member->is_active = FALSE;
		}

		$member->save();


		$member_id = $member->id;


		

		
		if(Input::get('share_account') == '1'){

			

			Shareaccount::createAccount($member_id);
		}
	
		Audit::logAudit(date('Y-m-d'), Confide::user()->username, 'member creation', 'Member', '0');


		return Redirect::route('members.index');
	}

	/**
	 * Display the specified member.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$member = Member::findOrFail($id);

		$savingaccounts = $member->savingaccounts;
		$shareaccount = $member->shareaccount;

		return View::make('members.show', compact('member', 'savingaccounts', 'shareaccount'));
	}

	/**
	 * Show the form for editing the specified member.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$member = Member::find($id);
		$branches = Branch::all();
		$groups = Group::all();

		return View::make('members.edit', compact('member', 'branches', 'groups'));
	}

	/**
	 * Update the specified member in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$member = Member::findOrFail($id);

		$validator = Validator::make($data = Input::all(), Member::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		if(Input::get('branch_id') != null){

			$branch = Branch::findOrFail(Input::get('branch_id'));
			$member->branch()->associate($branch);
		}
		
		if(Input::get('group_id') != null){

			$group = Group::findOrFail(Input::get('group_id'));
			$member->group()->associate($group);
		}

		//$member->photo = Input::get('photo');
		//$member->signature = Input::get('signature');

		if(Input::hasFile('photo')){

			$destination = public_path().'/uploads/photos';

			$filename = str_random(12);

			$ext = Input::file('photo')->getClientOriginalExtension();
			$photo = $filename.'.'.$ext;
			
			
			Input::file('photo')->move($destination, $photo);

			
			$member->photo = $photo;

			
			
		}


		if(Input::hasFile('signature')){

			$destination = public_path().'/uploads/photos';

			$filename = str_random(12);

			$ext = Input::file('signature')->getClientOriginalExtension();
			$photo = $filename.'.'.$ext;
			
			
			Input::file('signature')->move($destination, $photo);

			
			$member->signature = $photo;
			
		}

		
		$member->name = Input::get('name');
		$member->id_number = Input::get('id_number');
		$member->membership_no = Input::get('membership_no');
		$member->phone = Input::get('phone');
		$member->email = Input::get('email');
		$member->address = Input::get('address');
		$member->monthly_remittance_amount = Input::get('monthly_remittance_amount');
		$member->gender = Input::get('gender');
		$member->update();

		return Redirect::route('members.index');
	}

	/**
	 * Remove the specified member from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Member::destroy($id);

		return Redirect::route('members.index');
	}



	public function loanaccounts($id)
	{
		$member = Member::findOrFail($id);

		return View::make('members.loanaccounts', compact('member'));
	}


	public function activateportal($id){

		$member = Member::find($id);


		$password = strtoupper(Str::random(8));

		

$email = $member->email;
$name = $member->name;
		
		if($email != null){

		DB::table('users')->insert(
	array('email' => $member->email, 
	  'username' => $member->membership_no,
	  'password' => Hash::make($password),
	  'user_type'=>'member',
	  'confirmation_code'=> md5(uniqid(mt_rand(), true)),
	  'confirmed'=> 1
		)
);

		$member->is_css_active = true;
		$member->update();





	Mail::send( 'emails.password', array('password'=>$password, 'name'=>$name), function( $message ) use ($member)
{
    $message->to($member->email )->subject( 'Self Service Portal Credentials' );
});


		


		return Redirect::back()->with('notice', 'Member has been activated and login credentials emailed');

}

else{

	return Redirect::back()->with('notice', 'Member has not been activated kindly update email address');

}





		

	}



	public function deactivateportal($id){

		
		$member = Member::find($id);

		DB::table('users')->where('username', '=', $member->membership_no)->delete();

		$member->is_css_active = false;
		$member->update();


		return Redirect::back()->with('notice', 'Member has been deactivated');;

		
	}



	public function savingtransactions($acc_id){

		 $account = Savingaccount::findorfail($acc_id);

		 $balance = Savingaccount::getAccountBalance($account);



    	return View::make('css.savingtransactions', compact('account', 'balance'));
	}



	public function loanaccounts2()
	{

		$mem = Confide::user()->username;

		$id = DB::table('members')->where('membership_no', '=', $mem)->pluck('id');
		$member = Member::findOrFail($id);

		return View::make('css.loanaccounts', compact('member'));
	}
	
	
	public function reset($id){
		
		//$id = DB::table('members')->where('membership_no', '=', $mem)->pluck('id');
		$member = Member::findOrFail($id);
		
		$user_id = DB::table('users')->where('username', '=', $member->membership_no)->pluck('id');
		
		$user = User::findOrFail($user_id);
		
		$user->password = Hash::make('tacsix123');
		$user->update();
		
		return Redirect::back();
		
	}

	


	

}
