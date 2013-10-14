<div class="form">


<?php $form = $this->beginWidget('GxActiveForm', array(
	'id' => 'user-skill-form',
	'enableAjaxValidation' => false,
));
?>

	<p class="note">
		<?php echo Yii::t('app', 'Fields with'); ?> <span class="required">*</span> <?php echo Yii::t('app', 'are required'); ?>.
	</p>

	<?php echo $form->errorSummary($model); ?>

		<div class="row">
		<?php echo $form->labelEx($model,'user_id'); ?>
		<?php echo $form->dropDownList($model, 'user_id', GxHtml::listDataEx(User::model()->findAllAttributes(null, true))); ?>
		<?php echo $form->error($model,'user_id'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'skills_id'); ?>
		<?php echo $form->dropDownList($model, 'skills_id', GxHtml::listDataEx(Skill::model()->findAllAttributes(null, true))); ?>
		<?php echo $form->error($model,'skills_id'); ?>
		</div><!-- row -->
                <div class="row">
                <?php echo GxHtml::submitButton(Yii::t('app', 'Save')); ?> 
                </div>
<?php $this->endWidget(); ?>
</div><!-- form -->