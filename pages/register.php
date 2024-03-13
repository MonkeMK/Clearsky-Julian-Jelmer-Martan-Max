<div class="unstyled-container register">
	<form method="POST" action='formHandler'>

		<input type='hidden' name='action' value='register'>

		<h3 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Registeren</h3>

		<?php if (isset($_SESSION['ERROR']) && isset($_SESSION['ERROR']['REGISTER_ERROR'])): ?>
			<h4 class='form-error'><?= $_SESSION['ERROR']['REGISTER_ERROR'] ?></h4>
		<?php 
			$_SESSION['ERROR']['REGISTER_ERROR'] = null;
			endif; 
		?>

		<div class="form-outline mb-4">
			<input type="text" id="form2Example28" class="form-control form-control-lg"
				name="firstname"/>
			<label class="form-label" for="form2Example28">Naam</label>
		</div>

		<div class="form-outline mb-4">
			<input type="text" id="form2Example28" class="form-control form-control-lg"
				name="lastname"/>
			<label class="form-label" for="form2Example28">Naam</label>
		</div>

		<div class="form-outline mb-4">
			<input type="email" id="form2Example18" class="form-control form-control-lg"
				name="email"/>
			<label class="form-label" for="form2Example18">Email adres</label>
		</div>

		<div class="form-outline mb-4">
			<input type="text" id="form2Example28" class="form-control form-control-lg"
				name="address" />
			<label class="form-label" for="form2Example28">Adres</label>
		</div>

		<div class="form-outline mb-4">
			<input type="text" id="form2Example28" class="form-control form-control-lg"
				name="zipcode"/>
			<label class="form-label" for="form2Example28">Postcode</label>
		</div>

		<div class="form-outline mb-4">
			<input type="tel" id="form2Example28" class="form-control form-control-lg"
				name="phonenumber"/>
			<label class="form-label" for="form2Example28">Telefoonnummer</label>
		</div>

		<div class="form-outline mb-4">
			<input type="password" id="form2Example28" class="form-control form-control-lg"
				name="password"/>
			<label class="form-label" for="form2Example28">Wachtwoord</label>
		</div>

		<div class="form-outline mb-4">
			<input type="password" id="form2Example28" class="form-control form-control-lg"
				name="password-confirm"/>
			<label class="form-label" for="form2Example28">Wachtwoord confirm</label>
		</div>

		<div class="pt-1 mb-4">
			<button class="btn btn-info btn-lg btn-block" type="submit">Registeer</button>
		</div>

		<a href="login">Terug naar login</a>
	</form>
</div>
