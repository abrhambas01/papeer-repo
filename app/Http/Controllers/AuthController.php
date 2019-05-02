<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth ;
use App\Http\Requests\RegistrationRequest;
use App\User ; 

class AuthController extends Controller
{
	// use SendsEmails ; 

	public function postLogin()
	{
		// Validate the request. 
		$this->validate(request(), [
			'pin' => 'required|string',
			'password' => 'required|string',
		]);

		$pin = request()->get('pin');
		
		$field = filter_var(request()->get('pin'), FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

		$remember_me = request()->get('remember');
		
		$password = request()->get('password');

				// if (Auth::attempt([$field => $field,'password' => $password], $remember_me)){
		if (Auth::attempt([$field => $pin ,'password' => $password])){

			/*the roles would be determined in the future.*/	

			return redirect()->route('home');

			/*switch(auth()->user()->role_id){
				case 1 : return redirect()->route("admin.dashboard");
				case 2 : return redirect()->route("admin.dashboard");
				default : 
			}*/
			
		}

		
		return redirect()->back()->withErrors([
			'email' => 'No records were found on those input.'
		])->withInput(request(['pin']));

	}

	public function postRegister(RegistrationRequest $request)
	{

	// just insert everything as of the moment
		$firstName = request()->get("first_name");
		$lastName = request()->get("last_name");

		$user = User::firstOrCreate([
			'account_type' => '0' , 
			'full_name' => $firstName ." " .$lastName,
			'email' => request('email'),
			'password' => bcrypt(request('password')),
			'role_id' => request('role_id'),
			'confirmation_code' => md5(microtime())
			// maybe add this in the future
            // 'confirmation_token' => str_random()  // verify/email/dd332sskk?user=3
		]);	


		if (request('role_id') == 1) {
				// attach to the students.. relationship...
        		$user->student()->create([
        			'user_id' => $user->id
        		]) ;
		}

	// maybe in the future implement this..

     	// $this->sendVerificationEmail($user->email, $user->confirmation_token); 

		return redirect()->to("login")
		->with('flash','You\'re now registered');

	}



	public function logout()
	{
		auth()->guard()->logout();
		request()->session()->invalidate();
		return redirect()->back() ;
	}

}
