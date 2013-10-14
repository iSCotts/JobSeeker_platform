<div class="form">


<?php $form = $this->beginWidget('GxActiveForm', array(
	'id' => 'message-form',
	'enableAjaxValidation' => false,
));
?>

	<p class="note">
		<?php echo Yii::t('app', 'Fields with'); ?> <span class="required">*</span> <?php echo Yii::t('app', 'are required'); ?>.
	</p>

	<?php echo $form->errorSummary($model); ?>

		<div class="row">
		<?php echo $form->labelEx($model,'title'); ?>
		<?php echo $form->textField($model, 'title', array('maxlength' => 45)); ?>
		<?php echo $form->error($model,'title'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'message'); ?>
		<?php echo $form->textArea($model, 'message'); ?>
		<?php echo $form->error($model,'message'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'receiver_id'); ?>
		<?php echo $form->dropDownList($model, 'receiver_id', GxHtml::listDataEx(User::model()->findAllAttributes(null, true))); ?>
		<?php echo $form->error($model,'receiver_id'); ?>
		</div><!-- row -->
<?php
echo GxHtml::submitButton(Yii::t('app', 'Send'));
$this->endWidget();
?>
</div><!-- form -->