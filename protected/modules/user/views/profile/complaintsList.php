<?php $this->pageTitle=Yii::app()->name . ' - '.UserModule::t("List complaints");
$this->breadcrumbs=array(
        UserModule::t("Profile")=>array('profile'),
        UserModule::t("List complaints"),
);
?>
<div class="row-fluid profile-wrapper">
    <div class="span9">
    <?php if(count($complaints) == 0): ?>
    <div class="well">
        <div class="hero-strapline">
            <div class="page-header">
                <h4><?php echo UserModule::t('You dont have complaints {s}', array('{s}'=>Yii::app()->createAbsoluteUrl('user/profile'))); ?></h4>
            </div>
            <a href="<?php echo Yii::app()->createUrl('/user/profile'); ?>" class="btn btn-large btn-info">
                <i class="icon-home icon-white"></i> <?php echo UserModule::t('Cabinet of user'); ?>
            </a>
        </div>
    </div>
    <?php else: ?>
        <div class="well"> 
            <table class="table table-striped complaint">
                    <thead>
                        <tr>
                          <th></th>
                          <th><?php echo ApartmentsModule::t('Title apartment');?></th>
                          <th><?php echo Yii::t('common', 'Complains'); ?></th>
                          <td></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($complaints as $complaint) {  ?>
                                <tr>
                                  <td><?php echo date("m.d.Y", strtotime($complaint->date_created));  ?></td>
                                  
                                  <td>
                                    <a href="<?php echo Yii::app()->createUrl('/apartments/main/view', array('id' => $complaint->apartment_id, 'title' => setTranslite($complaint->description->title))); ?>" class="some_link"><?php echo $complaint->description->title; ?></a>
                                  </td>
                                  <td>
                                    <?php echo $complaint->message;  ?> 
                                  </td>
                                 
                                </tr>
                        <?php } ?>
                    </tbody>
                  </table>
            </div>
     <?php endif; ?>
     </div>
     <?php echo $this->renderPartial('profile/menu'); ?>       
</div>
<?php   Yii::app()->clientScript->registerScript('common', "
                function complaintResponse(id, complaint_id, item) {
                    message = $('textarea#responceForm').val()

                    if(message) {
                                $.ajax({
                                    type: 'post',
                                    data: 'id='+id+'&complaint_id='+complaint_id+'&message='+message,
                                    url: '".Yii::app()->createAbsoluteUrl('user/profile/responceComplaint')."',
                                    beforeSend: function() {
                                        $(item).addClass('yt-uix-button-toggled disabled')
                                    },
                                    success: function() {
                                        $('textarea#responceForm').val('')
                                        $(item).removeClass('yt-uix-button-toggled disabled')
                                    }
                                })
                    }
                }
	", CClientScript::POS_END);
?>
