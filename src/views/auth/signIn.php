<?php
$breadTitle = 'Sign in';
$breadDesc = 'Sign in to your account';
require __DIR__ . '/../../components/BreadCrumb.php'; ?>

<script src="https://unpkg.com/just-validate@latest/dist/just-validate.production.min.js"></script>
<section class="flex flex-col justify-center px-6 lg:px-8 items-center mt-4">
	<div class="md:flex-row  bg-white p-4 shadow-md flex flex-col items-center justify-center gap-4 rounded-xl ">
		<form class="space-y-6 w-[80vw] md:w-1/2" action="signIn" method="POST">
			<h2 class="text-center text-2xl/9 font-bold tracking-tight text-gray-900 ">Sign in to your account</h2>
			<?php
			require __DIR__ . '/../../components/WarningAlert.php';
			require __DIR__ . '/../../components/SuccessAlert.php';
			?>
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
			<p class="mt-10 text-center text-sm/6 text-gray-500">
				Not a member?
				<a href="signUp" class="font-semibold text-sky-600 hover:text-sky-500">Create a free account</a>
			</p>
		</form>

		<img src="assets/images/2.webp" alt="hotel2" width="380px" height="700px"
			class="md:w-1/2 w-full rounded-lg object-cover md:h-[500px]" />
	</div>
	<div>

	</div>

</section>


<script>
	document.addEventListener('DOMContentLoaded', function() {
		const validation = new JustValidate('form', {
			errorFieldCssClass: 'is-invalid',
			errorLabelCssClass: 'text-red-600 text-sm mt-1 fade-in', // Clase CSS para animación
			focusInvalidField: true, // Hace que el campo inválido reciba el foco
		});

		// Configuración de las reglas de validación
		const fields = [{
				id: '#email',
				rules: [{
						rule: 'required',
						errorMessage: 'Email is required'
					},
					{
						rule: 'email',
						errorMessage: 'Invalid email address'
					},
				],
			},
			{
				id: '#password',
				rules: [{
						rule: 'required',
						errorMessage: 'Password is required'
					},
					{
						rule: 'minLength',
						value: 6,
						errorMessage: 'At least 6 characters'
					},
				],
			},
		];

		// Agregar validaciones dinámicamente con un bucle
		fields.forEach(field => {
			validation.addField(field.id, field.rules);
		});

		// Manejar envío exitoso
		validation.onSuccess((event) => {
			console.log('Formulario válido, se envía');
			event.target.submit(); // Enviar formulario
		});

		// Manejar envío fallido
		validation.onFail(() => {
			console.log('Formulario no válido, no se envía');
		});



	});
</script>