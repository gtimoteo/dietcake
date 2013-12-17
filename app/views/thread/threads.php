<!-- #########  VIEW  ######### -->


<div class="row fluid">	
	<div class="span8">
		<h1>All threads</h1>        
        <span class="label label-info" style="font-size:110%"><?php eh($current_page) ?> of <?php eh($number_of_pages) ?> pages</span>
		<!--obtains all comments from db by looping through thread variable-->
        <div style="height:210px;">
            <table class="table table-hover" style="width:410px;">
                <thead><th>Title</th><th>No. of Comments</th></thead>
                <?php foreach($threads as $v): ?>
                    <tr>
                        <td style="width:250px;">
                        <a href="<?php eh(url('thread/view', array('thread_id' => $v->id, 'page' => 1))) ?>">
                                <?php eh($v->title) ?>
                        </a>
                        </td>
                        <td>
                        <?php eh($comments[$v->id]) ?> comments
                        </td>
                    </tr>
                <?php endforeach ?>
            </table>
        </div>
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
	<div class="span4">
		<h4>
			<span class="label label-default" style="font-size:140%;"> Welcome, <?php echo $_SESSION['username']; ?>! </span>
		</h4>
		<a class="btn btn-small btn-primary" href="<?php eh(url('thread/logout')) ?>">Logout</a>
	</div>	
</div>

