<div class="flex min-h-[500px] h-[85vh] flex-col justify-center px-6 lg:px-8">
	<div class="sm:mx-auto sm:w-full sm:max-w-sm">
		<!-- <img class="mx-auto h-10 w-auto" src="https://tailwindui.com/plus/img/logos/mark.svg?color=sky&shade=600"
			alt="Your Company"> -->
		<h2 class="mt-10 text-center text-2xl/9 font-bold tracking-tight text-gray-900">Sign in to your account</h2>
	</div>

	<div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
		<form class="space-y-6" action="#" method="POST">
			<div>
				<label for="email" class="block text-sm/6 font-medium text-gray-900">Email address</label>
				<div class="mt-2">
					<input type="email" name="email" id="email" autocomplete="email" required placeholder="name@example.com"
						class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-sky-600 sm:text-sm/6">
				</div>
			</div>

			<div>
				<div class="flex items-center justify-between">
					<label for="password" class="block text-sm/6 font-medium text-gray-900">Password</label>
					<!-- <div class="text-sm">
						<a href="#" class="font-semibold text-sky-600 hover:text-sky-500">Forgot password?</a>
					</div> -->
				</div>
				<div class="mt-2">
					<input type="password" name="password" id="password" autocomplete="current-password" required
						class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-sky-600 sm:text-sm/6">
				</div>
			</div>

			<div>
				<button type="submit"
					class="flex w-full justify-center rounded-md duration-300 bg-sky-600 px-3 py-1.5 text-sm/6 font-semibold text-white shadow-sm hover:bg-sky-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-sky-600">Sign
					in</button>
			</div>
		</form>

		<p class="mt-10 text-center text-sm/6 text-gray-500">
			Not a member?
			<a href="signUp" class="font-semibold text-sky-600 hover:text-sky-500">Create a free account</a>
		</p>
	</div>
</div>