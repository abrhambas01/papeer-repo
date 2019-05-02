<h1 class="text-white font-bold ml-10 font-sans">Paperus</h1 >

<div id="profile" class="absolute flex text-white" style="right: 1rem;">
	<p class="mt-3 font-basic font-bold mr-4">Lorem ipsum</p> 
	<img id="userAvatar" @click="showSidebar ^= true" class="h-10 w-10 rounded-full mb-2 border-white border-4 avatarImg" src="{{ asset('assets/images/avatar.jpg') }}" alt="Avatar">
	<div v-show="showSidebar" class="dropdown-menu mr-2 h-42 show" style="position: absolute; transform: translate3d(-57px, 34px, 0px); top: 0px; right: -30px; will-change: transform;">
		<nav class="font-medium font-basic ml-3 mt-1">
			<ul class="list-reset p-2">
				<li class="listStyle"><a href="/account"  class="hover:text-red">Account</a></li>
				<li class="listStyle"><a href="/profile" class="hover:text-red">Profile</a></li>
				<li class="listStyle"><a href="/logout"  class="hover:text-red">Logout</a></li>
			</ul>
		</nav>
	</div>
</div>