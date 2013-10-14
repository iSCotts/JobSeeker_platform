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
		<?php echo $form->labelEx($model,'sender_id'); ?>
		<?php echo $form->dropDownList($model, 'sender_id', GxHtml::listDataEx(User::model()->findAllAttributes(null, true))); ?>
		<?php echo $form->error($model,'sender_id'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'receiver_id'); ?>
		<?php echo $form->dropDownList($model, 'receiver_id', GxHtml::listDataEx(User::model()->findAllAttributes(null, true))); ?>
		<?php echo $form->error($model,'receiver_id'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'time_sent'); ?>
		<?php echo $form->textField($model, 'time_sent'); ?>
		<?php echo $form->error($model,'time_sent'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'updated_message_time'); ?>
		<?php echo $form->textField($model, 'updated_message_time'); ?>
		<?php echo $form->error($model,'updated_message_time'); ?>
		</div><!-- row -->

		<label><?php echo GxHtml::encode($model->getRelationLabel('responses')); ?></label>
		<?php echo $form->checkBoxList($model, 'responses', GxHtml::encodeEx(GxHtml::listDataEx(Response::model()->findAllAttributes(null, true)), false, true)); ?>

<?php
echo GxHtml::submitButton(Yii::t('app', 'Save'));
$this->endWidget();
?>
</div><!-- form -->