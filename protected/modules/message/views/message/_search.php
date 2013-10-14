<div class="wide form">

<?php $form = $this->beginWidget('GxActiveForm', array(
	'action' => Yii::app()->createUrl($this->route),
	'method' => 'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model, 'id'); ?>
		<?php echo $form->textField($model, 'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'title'); ?>
		<?php echo $form->textField($model, 'title', array('maxlength' => 45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'message'); ?>
		<?php echo $form->textArea($model, 'message'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'sender_id'); ?>
		<?php echo $form->dropDownList($model, 'sender_id', GxHtml::listDataEx(User::model()->findAllAttributes(null, true)), array('prompt' => Yii::t('app', 'All'))); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'receiver_id'); ?>
		<?php echo $form->dropDownList($model, 'receiver_id', GxHtml::listDataEx(User::model()->findAllAttributes(null, true)), array('prompt' => Yii::t('app', 'All'))); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'time_sent'); ?>
		<?php echo $form->textField($model, 'time_sent'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'updated_message_time'); ?>
		<?php echo $form->textField($model, 'updated_message_time'); ?>
	</div>

	<div class="row">
		<?php echo GxHtml::submitButton(Yii::t('app', 'Search')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->
