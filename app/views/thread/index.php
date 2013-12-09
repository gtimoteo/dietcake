<!-- #########  VIEW  ######### -->
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