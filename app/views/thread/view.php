<!-- ##### views/view.php ##### -->
<div class="row fluid">
	<div class="span8">
		<h1><?php eh($thread->title) ?></h1>
        <span class="label label-info" style="font-size:110%"><?php eh($current_page) ?> of <?php eh($number_of_pages) ?> pages</span>
        <div style="height:190px;">
		<?php foreach($comments as $k => $v): ?>
            <div class="comment">
				<div class="meta">
					<?php eh($item_num++) ?> : <?php eh($v->username) ?> <?php eh($v->created) ?>
				</div>
				<div>
					<?php eh($v->body) ?>
				</div>
			</div>
		<?php endforeach ?>
        </div>
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
		<hr>
        
		<form class="well" method="post" action="<?php eh(url('thread/view')) ?>">
			<label>Comment:</label>
			<textarea name="body"><?php eh(Param::get('body')) ?></textarea>
			<br />
			<input type="hidden" name="thread_id" value="<?php eh($thread->id) ?>">
            <input type="hidden" name="page" value="<?php eh($number_of_pages) ?>">
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
<a href="<?php eh(url('thread/threads', array('page' => 1))) ?>">
	<button class="btn btn-small btn-primary">Go back to threads</button>
</a>
</div>



