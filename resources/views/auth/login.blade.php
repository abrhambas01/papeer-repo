@extends('layouts.master')


@section('title', 'Login to your Account')
@section('content')


<div class="text-center">

<div class="inline-block w-1/4 mt-10">

<div class="flex w-full font-sans mb-8">

	<div class="w-1/2 bg-blue shadow-md p-2 border mb-2 mr-2 text-3xl border-grey-lighter login-button ">
		<a href="/login" class="no-underline text-white font-bold login-button">Login</<a>
	</div>

		<div class="w-1/2 bg-white p-2 mb-2 text-xl shadow-md register-button">
			<a href="/register" class="no-underline text-black mt-4 register-button">Create An Account</a>
		</div>
	</div>


	<div class="w-full max-w-md">
		<div id="loginForm">
			<form action="{{ route('postLogin') }}" method="POST" class="bg-white w-full shadow-md rounded px-8 pt-6 pb-8 mb-4">

				{{  csrf_field() }}

				<div class="mb-4 pt-4">
					<label class="font-sans block text-grey-darker text-sm font-bold mb-2" for="username">
						Username  / Email
					</label>
					<input name="pin" class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker leading-tight focus:outline-none focus:shadow-outline" id="username" type="text" placeholder="Username">
				</div>
				<div class="mb-6">
					<label class="block text-grey-darker text-sm font-bold mb-2" for="password">
						Password
					</label>
					<input name="password" class="shadow appearance-none border border-grey rounded w-full py-2 px-3 text-grey-darker mb-3 leading-tight focus:outline-none focus:shadow-outline" id="password" type="password" placeholder="******************">
				</div>

				
				@if ($errors->any())
				<div class="container" id="loginError">
					<div class="bg-red p-3 mb-4" >
						<p class="text-white mb-2 mt-4 text-lg">
							These credentials do not match our records
						</p>

					</div>
				</div>
				@endif

				<div class="flex items-center justify-between">
					<button type="submit" class="bg-blue hover:bg-blue-dark text-white font-bold py-3 px-6 rounded focus:outline-none focus:shadow-outline">
						Sign In
					</button>
					<a class="inline-block align-baseline font-bold text-sm text-blue hover:text-blue-darker" href="#">
						Forgot Password?
					</a>
				</div>

			</form>
		</div>	


		<p class="text-center text-grey-darker text-xs">
			©2019 Papeer All rights reserved.
		</p>
	</div>
</div>
</div>

@endsection
