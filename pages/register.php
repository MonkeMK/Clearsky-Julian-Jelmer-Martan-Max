<?php $ERROR = register(); ?>
<div class="unstyled-container register">
	<form method="POST">

		<h3 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Registeren</h3>

		<?php
		if (isset($ERROR)) {
			echo '<div class="alert alert-danger">' . $ERROR . '</div>';
		}
		?>

		<div class="form-outline mb-4">
			<input type="text" id="form2Example28" class="form-control form-control-lg"
				name="name"/>
			<label class="form-label" for="form2Example28">Naam</label>
		</div>

		<div class="form-outline mb-4">
			<input type="email" id="form2Example18" class="form-control form-control-lg"
				name="email"/>
			<label class="form-label" for="form2Example18">Email adres</label>
		</div>

		<div class="form-outline mb-4">
			<input type="password" id="form2Example28" class="form-control form-control-lg"
				name="password"/>
			<label class="form-label" for="form2Example28">Wachtwoord</label>
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
				name="phone"/>
			<label class="form-label" for="form2Example28">Telefoonnummer</label>
		</div>

		<div class="pt-1 mb-4">
			<button class="btn btn-info btn-lg btn-block" type="submit">Registeer</button>
		</div>

		<a href="login">
			<div class="pt-12 mb-4">
				<button class="btn btn-info btn-lg btn-block" type="submit">Terug naar login</button>
			</div>
		</a>
	</form>
</div>
