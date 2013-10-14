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
		<?php echo $form->label($model, 'from_user_id'); ?>
		<?php echo $form->dropDownList($model, 'from_user_id', GxHtml::listDataEx(User::model()->findAllAttributes(null, true)), array('prompt' => Yii::t('app', 'All'))); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'to_user_id'); ?>
		<?php echo $form->dropDownList($model, 'to_user_id', GxHtml::listDataEx(User::model()->findAllAttributes(null, true)), array('prompt' => Yii::t('app', 'All'))); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'job_post_id'); ?>
		<?php echo $form->dropDownList($model, 'job_post_id', GxHtml::listDataEx(JobPost::model()->findAllAttributes(null, true)), array('prompt' => Yii::t('app', 'All'))); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'quality'); ?>
		<?php echo $form->textField($model, 'quality'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'cost'); ?>
		<?php echo $form->textField($model, 'cost'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'expertise'); ?>
		<?php echo $form->textField($model, 'expertise'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'schedule'); ?>
		<?php echo $form->textField($model, 'schedule'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'response'); ?>
		<?php echo $form->textField($model, 'response'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'professionalism'); ?>
		<?php echo $form->textField($model, 'professionalism'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'review'); ?>
		<?php echo $form->textArea($model, 'review'); ?>
	</div>

	<div class="row">
		<?php echo GxHtml::submitButton(Yii::t('app', 'Search')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->
