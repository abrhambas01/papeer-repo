@extends('layouts.master')

@section('title', 'Register')

@section('content')

<div class="text-center">

@php
$roles  = \App\Role::all() ; 
@endphp

<div class="inline-block w-1/4 mt-10">

<div class="flex w-full font-sans mb-8">

<div class="w-1/2 bg-white shadow-md p-2 border mb-2 mr-2 text-xl border-grey-lighter login-button ">
  <a href="/login" class="no-underline text-black login-button">Login
    </<a>
    </div>

    <div class="w-full bg-blue p-2 mb-2 text-3xl shadow-md register-button">
      <a href="/register" class="no-underline font-bold text-white mt-4 register-button">Create An Account</a>
    </div>
  </div>


  <form class="w-full max-w-md bg-white px-6 pt-4 py-8 shadow-md" action="{{ route('postRegister') }}" method="POST">

    {{ csrf_field() }}

    <div class="flex flex-wrap -mx-3 mb-6">
      <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
        <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2" for="grid-first-name">
          First Name
        </label>
        <input  name="first_name" class="appearance-none block w-full bg-grey-lighter text-grey-darker border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" id="grid-first-name" type="text" placeholder="Jane">
      </div>
      <div class="w-full md:w-1/2 px-3">
        <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2" for="grid-last-name">
          Last Name
        </label>
        <input name="last_name"  class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-grey" id="grid-last-name" type="text" placeholder="Doe">
      </div>
    </div>


    <div class="flex flex-wrap -mx-3 mb-6">
      <div class="w-full px-3">
        <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2" for="grid-password">
          Email
        </label>
        <input name="email" class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-grey" id="grid-password" type="email" >
      </div>
    </div>


    <div class="flex flex-wrap -mx-3 mb-6">
      <div class="w-full px-3">
        <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2" for="grid-password">
          Password
        </label>
        <input name="password" class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-grey" id="grid-password" type="password" placeholder="******************">
        <p class="text-grey-dark text-xs italic">Make it as long and as crazy as you'd like</p>
      </div>
    </div>

    <div class="flex flex-wrap -mx-3 mb-6">


      <div class="w-full md:w-full px-3 mb-6 md:mb-0">
        <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2" for="grid-state">
          Sign up as
        </label>
        <div class="relative">
          <select name="role_id" class="block appearance-none w-full bg-grey-lighter border border-grey-lighter text-grey-darker py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-grey" id="grid-state">

            @foreach ($roles as $role)
            {{-- expr --}}
            <option value="{{  $role->id }}">{{ str_singular($role->title) }}</option>

            @endforeach

          </select>
          <div class="pointer-events-none absolute pin-y pin-r flex items-center px-2 text-grey-darker">
            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
          </div>
        </div>
      </div>
    </div>

    @if ($errors->any())
    <div class="container">
      <div class="bg-color-error p-3 mb-4">
        <h2 class="text-white mb-2">
          There {{ $errors->count() == 1 ? 'is' : 'are' }} {{ $errors->count() }} {{ str_plural('error', $errors->count() )}} with this input
        </h2>
        <ul class="bullet-list text-white">
          @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    </div>
    @endif

    <div class="flex flex-wrap mb-1">
      <div class="w-full md:w-full">
        <button class="bg-green-dark py-3 px-8 w-full text-white font-bold ">SIGN UP</button>
      </div>
    </form>
  </div>
</div>


@endsection
