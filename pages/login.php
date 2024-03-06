<?php $ERROR = login(); ?>
<div class="unstyled-container login">
	<form method="POST">
		<h3 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Log in</h3>

		<?php
		if ($error) {
			echo '<div class="alert alert-danger">' . $error . '</div>';
		}
		?>

		<div class="form-outline mb-4">
			<input type="email" id="form2Example18" class="form-control form-control-lg"
				name="email" required />
			<label class="form-label" for="form2Example18">Email adres</label>
		</div>

		<div class="form-outline mb-4">
			<div class="input-group">
				<input type="password" id="form2Example28" class="form-control form-control-lg password-input" name="password" required />
				<button type="button" class="btn btn-light password-toggle-btn bi bi-eye" onclick="togglePasswordVisibility(this)"></button>
			</div>
			<label class="form-label" for="form2Example28">Wachtwoord</label>
		</div>

		<div class="g-recaptcha" data-sitekey="6LdY5YIpAAAAAHdMKJbm3A_QQCN6w_9Qn3oveQnv"></div>
		<div class="pt-1 mb-4">
			<button class="btn btn-info btn-lg btn-block" type="submit">Inloggen</button>
		</div>

		<p class="small mb-5 pb-lg-2"><a href="forgotpassword">Wachtwoord vergeten?</a></p>
		<p>Heb je geen account? <a href="register" class="link">Registeer hier</a></p>
	</form>
</div>

<script>
	function togglePasswordVisibility(passwordToggle) {
		var passwordInput = document.getElementById("form2Example28");

		if (passwordInput.type === "password") {
			passwordInput.type = "text";
			passwordToggle.classList.remove("bi-eye");
			passwordToggle.classList.add("bi-eye-slash");
		} else {
			passwordInput.type = "password";
			passwordToggle.classList.remove("bi-eye-slash");
			passwordToggle.classList.add("bi-eye");
		}
	}
</script>
