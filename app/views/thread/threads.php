<!-- #########  VIEW  ######### -->


<div class="row fluid">	
	<div class="span6">
		<h1>All threads</h1>        
        <span class="label label-info" style="font-size:110%"><?php eh($current_page) ?> of <?php eh($number_of_pages) ?> pages</span>
		<ul>
		<!--obtains all comments from db by looping through thread variable-->
        <div style="height:90px;">
			<?php foreach($threads as $v): ?>
				<li>
					<a href="<?php eh(url('thread/view', array('thread_id' => $v->id, 'page' => 1))) ?>">
							<?php eh($v->title) ?>
					</a>
				</li>
			<?php endforeach; ?>
        </div>
		</ul>
        <div class="pagination">
              <ul>
                <li>
                    <?php $first = $page == 1 ? 1 : $page-1 ?>
                    <a href="<?php eh(url('thread/threads', array('page' => $first))) ?>">Prev</a>
                </li>
                <?php for($i = 1; $i <= $number_of_pages; $i++): ?>
                    <li class="<?php $current_page == $i ? eh("disabled") : "active" ?>" >
                        <a href="<?php eh(url('thread/threads', array('page' => $i))) ?>"><?php eh($i) ?></a>
                    </li>
                <?php endfor ?>
                <li>
                    <?php $last = $next_page == $number_of_pages ? $number_of_pages : $next_page+1 ?>
                    <a href="<?php eh(url('thread/threads', array('page' => $last))) ?>">Next</a>
                </li>
              </ul>
            </div>
		<a class="btn btn-large btn-primary" href="<?php eh(url('thread/create')) ?>">Create</a>
	</div>
	<div class="span6">
		<h4>
			<span class="label label-default" style="font-size:140%;"> Welcome, <?php echo $_SESSION['username']; ?>! </span>
		</h4>
		<a class="btn btn-small btn-primary" href="<?php eh(url('thread/logout')) ?>">Logout</a>
	</div>	
</div>

