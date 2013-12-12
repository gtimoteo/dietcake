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
		
        <div class="pagination">
            <ul>
                <li>
                    <?php $first = $page == 1 ? 1 : $page-1 ?>
                    <a href="<?php eh(url('thread/view', array('thread_id' => $thread_id, 'page' => $first))) ?>">Prev</a>
                </li>
                <?php for($i = 1; $i <= $number_of_pages; $i++): ?>
                    <li class="<?php $current_page == $i ? eh("disabled") : "active" ?>">
                        <a href="<?php eh(url('thread/view', array('thread_id' => $thread_id, 'page' => $i))) ?>"><?php eh($i) ?></a>
                    </li>
                <?php endfor ?>
                <li>
                    <?php $last = $next_page == $number_of_pages ? $number_of_pages : $next_page+1 ?>
                    <a href="<?php eh(url('thread/view', array('thread_id' => $thread_id, 'page' => $last))) ?>">Next</a>
                </li>
            </ul>
        </div>
		
		<?php if ($comment->hasError()): ?>
			<div class="alert alert-block">
				<h4 class="alert-heading">Validation error!</h4>
				
				<?php if (!empty($comment->validation_errors['body']['length'])): ?>
					<div><em>Comment</em> must be between
						<?php eh($comment->validation['body']['length'][1]) ?> and
						<?php eh($comment->validation['body']['length'][2]) ?> characters in length.
					</div>
				<?php endif ?>
			</div>
		<?php endif ?>

		
		<form class="well" method="post" action="<?php eh(url('thread/write')) ?>">
			<label>Comment</label>
			<textarea name="body"><?php eh(Param::get('body')) ?></textarea>
			<br />
			<input type="hidden" name="thread_id" value="<?php eh($thread->id) ?>">
			<input type="hidden" name="page_next" value="write_end">
			<button type="submit" name="submit" class="btn btn-primary">Submit</button>
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
<a href="<?php eh(url('thread/threads', array('page' => 1))) ?>">
	<button class="btn btn-small btn-primary">Go back to threads</button>
</a>
</div>



<div>
	<?php eh($p); ?>
</div>