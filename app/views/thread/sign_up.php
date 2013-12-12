<h1>Sign up</h1>

<?php if ($user->hasError()): ?>
	<div class="alert alert-block">
		<h4 class="alert-heading">Validation error!</h4>
		
		<?php if (!empty($user->validation_errors['username']['length'])): ?>
			<div><em>Your name</em> must be between
				<?php eh($user->validation['username']['length'][1]) ?> and
				<?php eh($user->validation['username']['length'][2]) ?> characters in length.
			</div>
		<?php endif ?>
		
		<?php if (!empty($user->validation_errors['password']['length'])): ?>
			<div><em>Password</em> must be between
				<?php eh($user->validation['password']['length'][1]) ?> and
				<?php eh($user->validation['password']['length'][2]) ?> characters in length.
			</div>		
		<?php endif ?>
	</div>	
<?php endif ?>

<?php if (isset($is_textbox_empty)): ?>
    <div class="alert alert-block">
        <h4 class="alert-heading">Validation error!</h4>
        <?php if(strlen($username) == 0): ?>
            <div>Please enter <em>Username</em>.</div>
        <?php endif ?>
        <?php if(strlen($password) == 0): ?>
            <div>Please enter <em>Password</em>.</div>
        <?php endif ?>
    </div>
<?php endif ?>

<?php if (isset($password_mismatched)): ?>
	<div class="alert alert-block">
		<h4 class="alert-heading">Registration Error!</h4>
		<div><em>Password</em> did not matched</div>
	</div>
<?php endif ?>

<?php if (isset($user_exists_error)): ?>
	<div class="alert alert-block">
		<h4 class="alert-heading">Registration Error!</h4>
		<div><em>Account already exists!</em></div>
	</div>
<?php endif ?>



<form method="post" action="<?php eh(url('thread/sign_up')) ?>">
	<label>Username</label>
	<input type="text" name="username" value="<?php eh(Param::get('username')) ?>"/>
	<label>Password</label>
	<input type="password" name="password" />
	<label>Re-type Password</label>
	<input type="password" name="retype_password" />
	<input type="hidden" name="page_next" value="sign_up_end">
	<br/>
	<button type="submit" class="btn btn-primary">Register</button>
</form>
<br/>
Already have an account? Click 
	<a href="<?php eh(url('thread/index')) ?>">here</a>
	
