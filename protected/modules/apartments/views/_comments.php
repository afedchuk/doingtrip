<?php foreach($comments as $comment){ ?>
<div class="comment">
    <div class="respond__mark">
        <span><?php echo CommentsModule::t('score'); ?></span>
        <div><?php echo $comment->rating; ?></div>
    </div>
    <div class="name comments-exist"><h4>
            <?php echo CHtml::encode($comment->name).' <span class="date">'. strftime('%B, %Y', strtotime('1-'.$comment->month.'-'.$comment->year)).'</span>'; ?></h4>
            <div class="body">
                    <?php echo CHtml::encode($comment->body); ?>
            </div>
    </div>
</div>
<?php } ?>
