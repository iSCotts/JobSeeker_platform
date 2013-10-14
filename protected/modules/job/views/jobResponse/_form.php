<div class="form">


<?php $form = $this->beginWidget('GxActiveForm', array(
	'id' => 'job-response-form',
	'enableAjaxValidation' => false,
));
?>

	<p class="note">
		<?php echo Yii::t('app', 'Fields with'); ?> <span class="required">*</span> <?php echo Yii::t('app', 'are required'); ?>.
	</p>

	<?php echo $form->errorSummary($model); ?>

		<div class="row">
		<?php echo $form->labelEx($model,'job_post_id'); ?>
		<?php echo $form->dropDownList($model, 'job_post_id', GxHtml::listDataEx(JobPost::model()->findAllAttributes(null, true))); ?>
		<?php echo $form->error($model,'job_post_id'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'user_id'); ?>
		<?php echo $form->dropDownList($model, 'user_id', GxHtml::listDataEx(User::model()->findAllAttributes(null, true))); ?>
		<?php echo $form->error($model,'user_id'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'ned_budget'); ?>
		<?php echo $form->textField($model, 'ned_budget'); ?>
		<?php echo $form->error($model,'ned_budget'); ?>
		</div><!-- row -->

		<label><?php echo GxHtml::encode($model->getRelationLabel('jobPosts')); ?></label>
		<?php echo $form->checkBoxList($model, 'jobPosts', GxHtml::encodeEx(GxHtml::listDataEx(JobPost::model()->findAllAttributes(null, true)), false, true)); ?>

<?php
echo GxHtml::submitButton(Yii::t('app', 'Save'));
$this->endWidget();
?>
</div><!-- form -->