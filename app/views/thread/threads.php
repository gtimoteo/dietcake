<!-- #########  VIEW  ######### -->


<div class="row fluid">	
	<div class="span6">
		<h1>All threads</h1>
		<ul>
		<!--obtains all comments from db by looping through thread variable-->
			<?php foreach($threads as $v): ?>
				<li>
					<a href="<?php eh(url('thread/view', array('thread_id' => $v->id))) ?>">
							<?php eh($v->title) ?>
					</a>
				</li>
			<?php endforeach ?>
		</ul>
		<a class="btn btn-large btn-primary" href="<?php eh(url('thread/create')) ?>">Create</a>
	</div>
	<div class="span6">
		<h4>
			<span class="label label-default" style="font-size:140%;"> Welcome, <?php echo $_SESSION['username']; ?>! </span>
		</h4>
		<a class="btn btn-small btn-primary" href="<?php eh(url('thread/logout')) ?>">Logout</a>
	</div>	
</div>


