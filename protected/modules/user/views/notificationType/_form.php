<div class="form">


<?php $form = $this->beginWidget('GxActiveForm', array(
	'id' => 'notification-type-form',
	'enableAjaxValidation' => false,
));
?>

	<p class="note">
		<?php echo Yii::t('app', 'Fields with'); ?> <span class="required">*</span> <?php echo Yii::t('app', 'are required'); ?>.
	</p>

	<?php echo $form->errorSummary($model); ?>

		<div class="row">
		<?php echo $form->labelEx($model,'type'); ?>
		<?php echo $form->textField($model, 'type', array('maxlength' => 45)); ?>
		<?php echo $form->error($model,'type'); ?>
		</div><!-- row -->

		<label><?php echo GxHtml::encode($model->getRelationLabel('notifications')); ?></label>
		<?php echo $form->checkBoxList($model, 'notifications', GxHtml::encodeEx(GxHtml::listDataEx(Notifications::model()->findAllAttributes(null, true)), false, true)); ?>

<?php
echo GxHtml::submitButton(Yii::t('app', 'Save'));
$this->endWidget();
?>
</div><!-- form -->