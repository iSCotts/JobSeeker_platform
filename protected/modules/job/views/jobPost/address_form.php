<div class="form">


<?php $form = $this->beginWidget('GxActiveForm', array(
	'id' => 'job-address-form',
	'enableAjaxValidation' => false,
));
?>

	<p class="note">
		<?php echo Yii::t('app', 'Fields with'); ?> <span class="required">*</span> <?php echo Yii::t('app', 'are required'); ?>.
	</p>

	<?php echo $form->errorSummary($model); ?>

		<div class="row">
		<?php echo $form->labelEx($model,'city'); ?>
		<?php echo $form->textField($model, 'city', array('maxlength' => 45)); ?>
		<?php echo $form->error($model,'city'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'town'); ?>
		<?php echo $form->textField($model, 'town', array('maxlength' => 45)); ?>
		<?php echo $form->error($model,'town'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'suburb'); ?>
		<?php echo $form->textField($model, 'suburb', array('maxlength' => 45)); ?>
		<?php echo $form->error($model,'suburb'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'street'); ?>
		<?php echo $form->textField($model, 'street', array('maxlength' => 45)); ?>
		<?php echo $form->error($model,'street'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'street_num'); ?>
		<?php echo $form->textField($model, 'street_num', array('maxlength' => 10)); ?>
		<?php echo $form->error($model,'street_num'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'extra_directions'); ?>
		<?php echo $form->textField($model, 'extra_directions', array('maxlength' => 255)); ?>
		<?php echo $form->error($model,'extra_directions'); ?>
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