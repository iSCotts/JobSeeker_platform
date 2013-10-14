<div class="form">


<?php $form = $this->beginWidget('GxActiveForm', array(
	'id' => 'skill-form',
	'enableAjaxValidation' => false,
));
?>

	<p class="note">
		<?php echo Yii::t('app', 'Fields with'); ?> <span class="required">*</span> <?php echo Yii::t('app', 'are required'); ?>.
	</p>

	<?php echo $form->errorSummary($model); ?>

		<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model, 'name', array('maxlength' => 45)); ?>
		<?php echo $form->error($model,'name'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'desc'); ?>
		<?php echo $form->textField($model, 'desc', array('maxlength' => 255)); ?>
		<?php echo $form->error($model,'desc'); ?>
		</div><!-- row -->
                <?php if(UserModule::isAdmin()) { ?>
		<div class="row">
		<?php echo $form->labelEx($model,'approved'); ?>
		<?php echo $form->checkBox($model, 'approved'); ?>
		<?php echo $form->error($model,'approved'); ?>
		</div><!-- row -->
                <?php } ?>
<?php
echo GxHtml::submitButton(Yii::t('app', 'Save'));
$this->endWidget();
?>
</div><!-- form -->