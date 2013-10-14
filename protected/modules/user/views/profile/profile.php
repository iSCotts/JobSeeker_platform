<?php $this->pageTitle=UserModule::t("Profile");
$this->breadcrumbs=array(
	UserModule::t("Profile"),
);
?><h2><?php echo UserModule::t('Your Profile'); ?></h2>


<?php if(Yii::app()->user->hasFlash('profileMessage')): ?>
<div class="success">
<?php echo Yii::app()->user->getFlash('profileMessage'); ?>
</div>
<?php endif; ?>
<!--div class="column s">
    <img id="ppc" src="images/_dp.png" width="60" height="120"/-->
    <?php echo $this->renderPartial('menu'); ?>
<!--/div-->
<div class="column m">
    <h3>Latest Jobs You May Want to Apply For:</h3>
    <?php $this->widget('zii.widgets.CListView', array(
        'dataProvider'=>$jobPostData,
        'itemView'=>'job.views.jobPost._view',
		'template'=>'{items}{pager}{summary}',
        'cssFile'=>'ie.css',
    )); ?>
</div>
<div class="column u">
    <h3>Your Skills:</h3>
    <?php if(Yii::app()->user->hasFlash('success')): ?>
        <div class="alert-success ">
        <?php echo Yii::app()->user->getFlash('success'); ?>
        </div>
    <?php elseif(Yii::app()->user->hasFlash('error')):?>
        <div class="alert-error ">
        <?php echo Yii::app()->user->getFlash('error'); ?>
        </div>
    <?php elseif(Yii::app()->user->hasFlash('info')):?>
        <div class="alert-info ">
        <?php echo Yii::app()->user->getFlash('info'); ?>
        </div>
    <?php endif; ?>
    <?php $this->widget('zii.widgets.CListView', array(
        'dataProvider'=>$skillsData,
        'itemView'=>'user.views.userSkill._view',
		'template'=>'{items}{summary}',
    )); ?>
</div>
