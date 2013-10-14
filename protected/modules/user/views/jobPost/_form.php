<div class="form">


<?php $form = $this->beginWidget('GxActiveForm', array(
	'id' => 'job-post-form',
	'enableAjaxValidation' => true,
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
		<?php echo $form->labelEx($model,'skill_id'); ?>
		<?php echo $form->dropDownList($model, 'skill_id', GxHtml::listDataEx(Skill::model()->findAllAttributes(null, true))); ?>
		<?php echo $form->error($model,'skill_id'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model, 'name', array('maxlength' => 45)); ?>
		<?php echo $form->error($model,'name'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'Desc'); ?>
		<?php echo $form->textArea($model, 'Desc'); ?>
		<?php echo $form->error($model,'Desc'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'budget'); ?>
		<?php echo $form->textField($model, 'budget'); ?>
		<?php echo $form->error($model,'budget'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'negotiable'); ?>
		<?php echo $form->checkBox($model, 'negotiable'); ?>
		<?php echo $form->error($model,'negotiable'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'response_cut_date'); ?>
		<?php $form->widget('zii.widgets.jui.CJuiDatePicker', array(
			'model' => $model,
			'attribute' => 'response_cut_date',
			'value' => $model->response_cut_date,
			'options' => array(
				'showButtonPanel' => true,
				'changeYear' => true,
				'dateFormat' => 'yy-mm-dd',
				),
			));
; ?>
		<?php echo $form->error($model,'response_cut_date'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'hours_per_day'); ?>
		<?php echo $form->textField($model, 'hours_per_day', array('maxlength' => 10)); ?>
		<?php echo $form->error($model,'hours_per_day'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'job_start_date'); ?>
		<?php $form->widget('zii.widgets.jui.CJuiDatePicker', array(
			'model' => $model,
			'attribute' => 'job_start_date',
			'value' => $model->job_start_date,
			'options' => array(
				'showButtonPanel' => true,
				'changeYear' => true,
				'dateFormat' => 'yy-mm-dd',
				),
			));
; ?>
		<?php echo $form->error($model,'job_start_date'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'job_end_date'); ?>
		<?php $form->widget('zii.widgets.jui.CJuiDatePicker', array(
			'model' => $model,
			'attribute' => 'job_end_date',
			'value' => $model->job_end_date,
			'options' => array(
				'showButtonPanel' => true,
				'changeYear' => true,
				'dateFormat' => 'yy-mm-dd',
				),
			));
; ?>
		<?php echo $form->error($model,'job_end_date'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'close_applications'); ?>
		<?php echo $form->checkBox($model, 'close_applications'); ?>
		<?php echo $form->error($model,'close_applications'); ?>
		</div><!-- row -->

		<label><?php echo GxHtml::encode($model->getRelationLabel('jobResponses')); ?></label>
		<?php echo $form->checkBoxList($model, 'jobResponses', GxHtml::encodeEx(GxHtml::listDataEx(JobResponse::model()->findAllAttributes(null, true)), false, true)); ?>

<?php
echo GxHtml::submitButton(Yii::t('app', 'Save'));
$this->endWidget();
?>
</div><!-- form -->