
<div class="row fluid">

	<div class="span8">
		<h1>Create a thread</h1>

		<form class="well" method="post" action="<?php eh(url('')) ?>">
        <div class="row fluid">
            <div class="span3">
                <label>Title</label>
                <input type="text" class="span2" name="title" value="<?php eh(Param::get('title')) ?>">
                <label>Comment</label>
                <textarea name="body"><?php eh(Param::get('body')) ?></textarea>
                <br />
                <input type="hidden" name="page_next" value="create_end">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
            <div class="span4">
                <?php if ($thread->hasError() || $comment->hasError()): ?>
                    <div class="alert alert-error">
                        <h4 class="alert-heading">Validation error!</h4>
                    
                        <?php if (!empty($thread->validation_errors['title']['length'])): ?>
                            <div><em>Title</em> must be between
                                <?php eh($thread->validation['title']['length'][1]) ?> and
                                <?php eh($thread->validation['title']['length'][2]) ?> characters in length.
                            </div>
                        <?php endif ?>
                    
                        <?php if (!empty($comment->validation_errors['body']['length'])): ?>
                            <div><em>Comment</em> must be between
                                <?php eh($comment->validation['body']['length'][1]) ?> and
                                <?php eh($comment->validation['body']['length'][2]) ?> characters in length.
                            </div>
                        <?php endif ?>
                    </div>
                <?php endif ?>
            </div>
        </div>
			
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
