<div class="form">

<?php $form = $this->beginWidget('GxActiveForm', array(
	'id' => 'response-form',
	'enableAjaxValidation' => false,
));
?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<div class="row">
		<?php echo $form->labelEx($model,'message'); ?>
		<?php echo $form->textArea($model, 'message'); ?>
		<?php echo $form->error($model,'message'); ?>
	</div><!-- row -->

	<div class="actions">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array('class'=>'btn primary')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->