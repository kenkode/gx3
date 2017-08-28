<?php

class LoanguarantorsController extends \BaseController {

	/**
	 * Display a listing of loanguarantors
	 *
	 * @return Response
	 */
	public function index()
	{
		$loanguarantors = Loanguarantor::all();

		return View::make('loanguarantors.index', compact('loanguarantors'));
	}

	/**
	 * Show the form for creating a new loanguarantor
	 *
	 * @return Response
	 */
	public function create($id)
	{
		$loanaccount = Loanaccount::findOrFail($id);
		$members = DB::table('members')->where('is_active', '=', TRUE)->get();
		return View::make('loanguarantors.create', compact('members', 'loanaccount'));
	}


	public function csscreate($id)
	{
		$loanaccount = Loanaccount::findOrFail($id);
		$members = DB::table('members')->where('is_active', '=', TRUE)->get();
		return View::make('css.guarantors', compact('members', 'loanaccount'));
	}

	/**
	 * Store a newly created loanguarantor in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Validator::make($data = Input::all(), Loanguarantor::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$mem_id = Input::get('member_id');

		$member = Member::findOrFail($mem_id);

		$loanaccount = Loanaccount::findOrFail(Input::get('loanaccount_id'));


		$guarantor = new Loanguarantor;

		$guarantor->member()->associate($member);
		$guarantor->loanaccount()->associate($loanaccount);
		$guarantor->amount = Input::get('amount');
		$guarantor->save();
		


		return Redirect::to('loans/show/'.$loanaccount->id);
	}

	/**
	 * Display the specified loanguarantor.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$loanguarantor = Loanguarantor::findOrFail($id);

		return View::make('loanguarantors.show', compact('loanguarantor'));
	}

	/**
	 * Show the form for editing the specified loanguarantor.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$loanguarantor = Loanguarantor::find($id);
		$members = DB::table('members')->where('is_active', '=', TRUE)->get();

		return View::make('loanguarantors.edit', compact('loanguarantor', 'members'));
	}


	public function cssedit($id)
	{
		$loanguarantor = Loanguarantor::find($id);
		$members = DB::table('members')->where('is_active', '=', TRUE)->get();

		return View::make('css.editguarantors', compact('loanguarantor', 'members'));
	}


	/**
	 * Update the specified loanguarantor in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{

		$mem_id = Input::get('member_id');

		$member = Member::findOrFail($mem_id);

		$loanaccount = Loanaccount::findOrFail(Input::get('loanaccount_id'));

		$guarantor = Loanguarantor::findOrFail($id);

		$validator = Validator::make($data = Input::all(), Loanguarantor::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}



		$guarantor->member()->associate($member);
		$guarantor->loanaccount()->associate($loanaccount);
		$guarantor->amount = Input::get('amount');
		$guarantor->save();

		return Redirect::to('loans/show/'.$loanaccount->id);
	}


	public function cssupdate($id)
	{

		$mem_id = Input::get('member_id');

		$member = Member::findOrFail($mem_id);

		$loanaccount = Loanaccount::findOrFail(Input::get('loanaccount_id'));

		$guarantor = Loanguarantor::findOrFail($id);

		$validator = Validator::make($data = Input::all(), Loanguarantor::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}



		$guarantor->member()->associate($member);
		$guarantor->loanaccount()->associate($loanaccount);
		$guarantor->amount = Input::get('amount');
		$guarantor->save();

		return Redirect::to('memloans/'.$loanaccount->id);
	}

	/**
	 * Remove the specified loanguarantor from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Loanguarantor::destroy($id);

		return Redirect::to('loans/show/'.$id);
	}


	public function cssdestroy($id)
	{

		$guarantor = Loanguarantor::findOrFail($id);


		Loanguarantor::destroy($id);

		 return Redirect::to('memloans/'.$guarantor->loanaccount->id);
	}

}
