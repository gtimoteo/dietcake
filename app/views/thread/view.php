<!-- ##### views/view.php ##### -->
<div class="row fluid">
	<div class="span8">
		<h1><?php eh($thread->title) ?></h1>
		<?php foreach($comments as $k => $v): ?>
			<div class="comment">
				<div class="meta">
					<?php eh($k + 1) ?> : <?php eh($v->username) ?> <?php eh($v->created) ?>
				</div>
				<div>
					<?php eh($v->body) ?>
				</div>
			</div>
		<?php endforeach ?>

		<hr>
		
		<form class="well" method="post" action="<?php eh(url('thread/write')) ?>">
			<label>Comment:</label>
			<textarea name="body"><?php eh(Param::get('body')) ?></textarea>
			<br />
			<input type="hidden" name="thread_id" value="<?php eh($thread->id) ?>">
			<input type="hidden" name="page_next" value="write_end">
			<button type="submit" class="btn btn-primary">Submit</button>
		</form>
	</div>
	<div class="span4">
		<h4>
			<span class="label label-default" style="font-size:140%;"> Welcome, <?php echo $_SESSION['username']; ?>! </span>
		</h4>
		<a class="btn btn-small btn-primary" href="<?php eh(url('thread/logout')) ?>">Logout</a>
	</div>
</div>

<div>
<a href="<?php eh(url('thread/threads')) ?>">
	<button class="btn btn-small btn-primary">Go back to threads</button>
</a>
</div>



