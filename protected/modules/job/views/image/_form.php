<div class="form">


<?php $form = $this->beginWidget('GxActiveForm', array(
	'id' => 'image-form',
	'enableAjaxValidation' => false,
));
?>

	<p class="note">
		<?php echo Yii::t('app', 'Fields with'); ?> <span class="required">*</span> <?php echo Yii::t('app', 'are required'); ?>.
	</p>

	<?php echo $form->errorSummary($model); ?>

		<div class="row">
		<?php echo $form->labelEx($model,'id'); ?>
		<?php echo $form->textField($model, 'id'); ?>
		<?php echo $form->error($model,'id'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'image'); ?>
		<?php echo $form->textField($model, 'image'); ?>
		<?php echo $form->error($model,'image'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'file_name'); ?>
		<?php echo $form->textField($model, 'file_name', array('maxlength' => 100)); ?>
		<?php echo $form->error($model,'file_name'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'file_type'); ?>
		<?php echo $form->textField($model, 'file_type', array('maxlength' => 45)); ?>
		<?php echo $form->error($model,'file_type'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'job_post_id'); ?>
		<?php echo $form->dropDownList($model, 'job_post_id', GxHtml::listDataEx(JobPost::model()->findAllAttributes(null, true))); ?>
		<?php echo $form->error($model,'job_post_id'); ?>
		</div><!-- row -->


<?php
echo GxHtml::submitButton(Yii::t('app', 'Save'));
$this->endWidget();
?>
</div><!-- form -->