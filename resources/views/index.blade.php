@extends('layouts.master')

@section('title', 'Welcome Friend')
@section('content')
{{-- expr --}}


<div class="row">
    <div class="w-3/5 h-screen column" id="bg-pattern">
        <section id="features" class="container mx-auto ml-4" style="margin-top:420px;">
            <div class="flex">
                <svg xmlns="http://www.w3.org/2000/svg" class="mt-8 fill-current text-white h-12 w-12 flex items-center" viewBox="0 0 20 20"><path d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM6.7 9.29L9 11.6l4.3-4.3 1.4 1.42L9 14.4l-3.7-3.7 1.4-1.42z"/>
                </svg>
                <h3 class="mt-9 text-white flex text-2xl ml-4">Post your Research Paper online</h3>
            </div>

            <div class="flex mt-4">
              <svg xmlns="http://www.w3.org/2000/svg" class="mt-8 fill-current text-white h-12 w-12 flex items-center" viewBox="0 0 20 20"><path d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM6.7 9.29L9 11.6l4.3-4.3 1.4 1.42L9 14.4l-3.7-3.7 1.4-1.42z"/>
              </svg>
              <h3 class="mt-9 text-white flex text-2xl ml-4">Collaborate with research experts around the world</h3>
          </div>


          <div class="flex mt-4">
           <svg xmlns="http://www.w3.org/2000/svg" class="mt-8 fill-current text-white h-12 w-12 flex items-center" viewBox="0 0 20 20"><path d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM6.7 9.29L9 11.6l4.3-4.3 1.4 1.42L9 14.4l-3.7-3.7 1.4-1.42z"/>
           </svg>
           <h3 class="mt-9 text-white flex text-2xl ml-4">Browse through collection of research papers posted by different students and individuals</h3>
       </div>
   </section>

{{-- 
            <div>
                <svg xmlns="http://www.w3.org/2000/svg" class="mt-8 fill-current text-white h-16 w-20 flex items-center" viewBox="0 0 20 20"><path d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM6.7 9.29L9 11.6l4.3-4.3 1.4 1.42L9 14.4l-3.7-3.7 1.4-1.42z"/>
                </svg>
                <h3 class="mt-9 text-white flex text-3xl ml-4">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Officiis, pariatur.</h3>
            </div>

            <div class="container mx-auto flex">
                <svg xmlns="http://www.w3.org/2000/svg" class="mt-8 fill-current text-white h-16 w-20 flex items-center" viewBox="0 0 20 20"><path d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM6.7 9.29L9 11.6l4.3-4.3 1.4 1.42L9 14.4l-3.7-3.7 1.4-1.42z"/>
                </svg>
                <h3 class="mt-9 text-white flex text-3xl ml-4">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Officiis, pariatur.</h3>
            </div>
            <div class="container mx-auto flex">
                <svg xmlns="http://www.w3.org/2000/svg" class="mt-8 fill-current text-white h-16 w-20 flex items-center" viewBox="0 0 20 20"><path d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM6.7 9.29L9 11.6l4.3-4.3 1.4 1.42L9 14.4l-3.7-3.7 1.4-1.42z"/>
                </svg>
                <h3 class="mt-9 text-white flex text-3xl ml-4">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Officiis, pariatur.</h3>
            </div> --}}

        </div>  


        <section id="right-panel" class="column bg-white">
            <div class="text-center mt-11">
                <div class="inline-block">
                    <div id="logo" class="">
                        <img class="h-48 w-64 mb-4" src="{{ asset('images/logo.jpg') }}" alt="" class="">
                        <h3 class="font-bold text-3xl">Papeer</h3>
                    </div>  

                    <p class="font-bold mt-4 text-2xl">"The comprehensive platform that unites students' research to the real world."
                    </p>

                    <section id="buttons" class="-m-50p mt-10 text-center ">
                        <div class="inline-block">
                            @if (auth()->check() )
                            <button type="button" style="margin-left: -80px; width:260%" class="rounded-full bg-blue p-8 text-white font-bold block"><a href="{{ route('home') }}" class="text-white no-underline">Go to your dashboard</a>
                            </button>
                            @else
                            <div class="ml-1">
                                <button class="mt-4 rounded-full bg-theme-color hover:bg-secondary-color px-8 py-6 text-white font-bold block w-fuller">
                                    <a href="/login" class="text-white no-underline hover:no-underline hover:text-white">Create/Login to an Account</a>
                                </button>

                                <button class="mt-4 rounded-full bg-white border-grey border hover:bg-secondary-color px-8 py-6 font-bold block w-fuller hover:text-white">
                                    <a href="/papers" class="text-black hover:text-white no-underline hover:no-underline">Browse Posted Papers</a>
                                </button>

                            </div>
                            @endif
                        </div>
                    </section>
                </div>
            </div>
        </section>
    </div>

@endsection
