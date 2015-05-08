<form action="Register" method="POST">
	<fieldset class="col-md-6 col-xs-12 col-lg-4 col-lg-offset-4 col-md-offset-3">
		<legend> Register </legend>
		<label for="username" >Username</label>
		<input type="text" name="username" id="username" class="form-control">
		<label for="password" >Password</label>
		<input type="password" name="password" class="form-control" id="password">
		<label for="password">Repeat Password</label>
		<input type="password" name="repeat-password" class="form-control" id="repeat-password">
		<label for="email" name="email">Email</label>
		<input type="input" class="form-control" id="email">
		<button type="submit" class="btn btn-primary">Register</button>
		<button type="reset" class="btn btn-danger">Reset</button>
	</fieldset>
</form>