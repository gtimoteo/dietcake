<div class="row-fluid">
	<div class="span6">
		<h1>Sign in</h1>
		<hr/>
        
		<?php if (isset($check_textbox)): ?>
			<div class="alert alert-block">
				<h4 class="alert-heading">Sign in Error!</h4>
				<div><em>Username<em> or </em>Password</em> is empty.</div>
				<div>Please try again.</div>
			</div>
		<?php endif ?>
		<?php if (isset($invalid_account)): ?>
			<div class="alert alert-block">
				<h4 class="alert-heading">Sign in Error!</h4>
				<div>Invalid <em>Username<em> or </em>Password.</em></div>
				<div>Please try again.</div>
			</div>
		<?php endif ?>
		
		
		<form action="" method="POST">
			<label>Username</label>
			<input type="text" name="username"/>
			<br/>
			<label>Password</label>
			<input type="password" name="password"/>
			<input type="hidden" name="page_next" value="index_end"/>
			<br/>
			<button type="submit" class="btn btn-primary" name="submit">Sign in</button>
		</form>
		
		Dont' have an account yet? Register 
		<a href="<?php eh(url('thread/sign_up')) ?>">here</a>
	</div>
</div>