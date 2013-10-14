<div class="form">


<?php $form = $this->beginWidget('GxActiveForm', array(
	'id' => 'notifications-form',
	'enableAjaxValidation' => false,
));
?>

	<p class="note">
		<?php echo Yii::t('app', 'Fields with'); ?> <span class="required">*</span> <?php echo Yii::t('app', 'are required'); ?>.
	</p>

	<?php echo $form->errorSummary($model); ?>

		<div class="row">
		<?php echo $form->labelEx($model,'receiver_id'); ?>
		<?php echo $form->dropDownList($model, 'receiver_id', GxHtml::listDataEx(User::model()->findAllAttributes(null, true))); ?>
		<?php echo $form->error($model,'receiver_id'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'job_post_id'); ?>
		<?php echo $form->dropDownList($model, 'job_post_id', GxHtml::listDataEx(JobPost::model()->findAllAttributes(null, true))); ?>
		<?php echo $form->error($model,'job_post_id'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'notification_type_id'); ?>
		<?php echo $form->dropDownList($model, 'notification_type_id', GxHtml::listDataEx(NotificationType::model()->findAllAttributes(null, true))); ?>
		<?php echo $form->error($model,'notification_type_id'); ?>
		</div><!-- row -->
<?php
echo GxHtml::submitButton(Yii::t('app', 'Save'));
$this->endWidget();
?>
</div><!-- form -->