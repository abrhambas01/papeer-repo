<div class="bg-white-2 shadow" id="nonStudentMenu">
	<div class="flex px-4 py-4 pb-4 pt-4 font-sans">
		<svg xmlns="http://www.w3.org/2000/svg" class="fill-current mr-2 text-grey-darkest h-6 w-6 ml-10" viewBox="0 0 20 20"><path d="M8 20H3V10H0L10 0l10 10h-3v10h-5v-6H8v6z"/></svg>
		<a href="{{ route('home') }}" class="mr-8 text-2xl no-underline font-normal text-grey-darkest font-sans-2">Home</a>

		<svg class="fill-current text-grey-darkest h-6 w-6 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M0 3h20v2H0V3zm0 4h20v2H0V7zm0 4h20v2H0v-2zm0 4h20v2H0v-2z"/>
		</svg>
		<a href="{{ route('papers.index') }}" class="mr-8  no-underline text-2xl font-normal text-grey-darkest font-sans-2">Browse Papers</a>
		
		<svg class="fill-current text-grey-darkest h-6 w-6 mr-2"  xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M149.333 216v80c0 13.255-10.745 24-24 24H24c-13.255 0-24-10.745-24-24v-80c0-13.255 10.745-24 24-24h101.333c13.255 0 24 10.745 24 24zM0 376v80c0 13.255 10.745 24 24 24h101.333c13.255 0 24-10.745 24-24v-80c0-13.255-10.745-24-24-24H24c-13.255 0-24 10.745-24 24zM125.333 32H24C10.745 32 0 42.745 0 56v80c0 13.255 10.745 24 24 24h101.333c13.255 0 24-10.745 24-24V56c0-13.255-10.745-24-24-24zm80 448H488c13.255 0 24-10.745 24-24v-80c0-13.255-10.745-24-24-24H205.333c-13.255 0-24 10.745-24 24v80c0 13.255 10.745 24 24 24zm-24-424v80c0 13.255 10.745 24 24 24H488c13.255 0 24-10.745 24-24V56c0-13.255-10.745-24-24-24H205.333c-13.255 0-24 10.745-24 24zm24 264H488c13.255 0 24-10.745 24-24v-80c0-13.255-10.745-24-24-24H205.333c-13.255 0-24 10.745-24 24v80c0 13.255 10.745 24 24 24z"/></svg>
		<a href="{{ route('papers.followed',$id) }}" class="mr-8 no-underline text-2xl font-normal text-grey-darkest font-sans-2">Followed Papers</a>

		<svg class="fill-current text-grey-darkest h-6 w-6 mr-2"  xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M10 20a10 10 0 1 1 0-20 10 10 0 0 1 0 20zm2-2.25a8 8 0 0 0 4-2.46V9a2 2 0 0 1-2-2V3.07a7.95 7.95 0 0 0-3-1V3a2 2 0 0 1-2 2v1a2 2 0 0 1-2 2v2h3a2 2 0 0 1 2 2v5.75zm-4 0V15a2 2 0 0 1-2-2v-1h-.5A1.5 1.5 0 0 1 4 10.5V8H2.25A8.01 8.01 0 0 0 8 17.75z"/></svg>
		<a href="{{ route('activity') }}" class="mr-8 no-underline text-2xl font-normal text-grey-darkest font-sans-2">Activities
		</a>


		<svg class="fill-current text-grey-darkest h-6 w-6 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M5 5a5 5 0 0 1 10 0v2A5 5 0 0 1 5 7V5zM0 16.68A19.9 19.9 0 0 1 10 14c3.64 0 7.06.97 10 2.68V20H0v-3.32z"/></svg>
		
		<a href="{{ route('profiles.user',$id)}}" class="mr-8 no-underline text-2xl font-normal text-grey-darkest font-sans-2">My Profile</a>

		<svg  class="fill-current text-grey-darkest h-6 w-6 mr-2"  xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M497 273L329 441c-15 15-41 4.5-41-17v-96H152c-13.3 0-24-10.7-24-24v-96c0-13.3 10.7-24 24-24h136V88c0-21.4 25.9-32 41-17l168 168c9.3 9.4 9.3 24.6 0 34zM192 436v-40c0-6.6-5.4-12-12-12H96c-17.7 0-32-14.3-32-32V160c0-17.7 14.3-32 32-32h84c6.6 0 12-5.4 12-12V76c0-6.6-5.4-12-12-12H96c-53 0-96 43-96 96v192c0 53 43 96 96 96h84c6.6 0 12-5.4 12-12z"/></svg>

		<a href="{{ route('logout') }}" class="mr-8 no-underline text-2xl font-normal text-grey-darkest font-sans-2">Logout</a>

	</div>
</div>