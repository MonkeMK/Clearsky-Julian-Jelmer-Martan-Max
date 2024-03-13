<?php handleForgotPassword() ?>
<div class="unstyled-container forgot_password">
	<form method="POST">

		<h3 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Wachtwoord vergeten?</h3>

		<div class="form-outline mb-4">
			<input type="email" id="form2Example18" class="form-control form-control-lg"
				name="email" required />
			<label class="form-label" for="form2Example18">Email adres</label>
		</div>

		<div class="form-outline mb-4">
			<div class="input-group">
				<input type="password" id="form2Example28" class="form-control form-control-lg"
					name="password" required />
				<button type="button" class="btn1 btn-light">
					<i id="passwordToggle" class="far fa-eye"></i>
				</button>
			</div>
			<label class="form-label" for="form2Example28">Nieuw wachtwoord</label>
		</div>

		<div class="pt-1 mb-4">
			<button class="btn btn-info btn-lg btn-block" type="submit">KLAAR!!</button>
		</div>
	</form>
	<a href="login">Back to login</button>
	</a>
</div>
