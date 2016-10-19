<?php 
$this->beginWidget('bootstrap.widgets.TbModal', array('id'=>'modal-booking')); ?>
    <?php $form=$this->beginWidget('CActiveForm', array(
    		'id'=>$this->modelName.'-form',
          	'enableAjaxValidation'=>true,
            'clientOptions' => array(
                'validateOnSubmit' => true,
            ),
            'htmlOptions' => array('class' => 'form-horizontal')

    )); ?>
        <div class="modal-header">
            <a class="close" data-dismiss="modal">&times;</a>
            <h2><?php echo CommentsModule::t('Comments'); ?></h2>      
        </div>
     	
        <div class="modal-body">
        	
            <?php if(!empty($comments)) {?>
                     <div class="user-block-comments">
                             <div class="comments">
                                 <ul>
                                     <?php  foreach($comments as $comment) { ?>
                                             <li><strong><?php echo $comment->name; ?></strong><br/> <?php echo $comment->body, 80; ?><a class="response"></a></li>
                                     <?php } ?>
                                 </ul>
                             </div>
                     </div>
            <?php } else {  ?>
            <h4><?php echo CommentsModule::t('There are no comments'); ?></h4>
            <?php }?>
        </div>
    <?php $this->endWidget(); ?>
<?php $this->endWidget(); ?>