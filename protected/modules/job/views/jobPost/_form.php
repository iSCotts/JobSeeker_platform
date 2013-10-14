<div class="form">


<?php $form = $this->beginWidget('GxActiveForm', array(
	'id' => 'job-post-form',
	'enableAjaxValidation' => false,
        'method'=>'post',
        'htmlOptions'=>array('enctype'=>'multipart/form-data'),
));
?>

	<p class="note">
		<?php echo Yii::t('app', 'Fields with'); ?> <span class="required">*</span> <?php echo Yii::t('app', 'are required'); ?>.
	</p>

		<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model, 'name', array('maxlength' => 45)); ?>
		<?php echo $form->error($model,'name'); ?>
		</div><!-- row -->
		<div class="row">
		<div class="row">
		<?php echo $form->labelEx($model,'skill_id'); ?>
		<?php echo $form->dropDownList($model, 'skill_id', GxHtml::listDataEx(Skill::model()->findAllAttributes(null, true)),
                        array(
                            'prompt'=>'Select A Skill',
                            'ajax'=>array(
                                'type'=>'POST',
                                'url'=>array('/job/jobPost/dynamicUserWithSkill'),
                                'update'=>'#inviteList',
                            )
                        )); ?>
		<?php echo $form->error($model,'skill_id'); ?>
		</div><!-- row -->
		<?php echo CHtml::label('Invite users','inviteList');?>
		<?php echo CHtml::listBox('inviteList','', array(),array('multiple'=>'multiple')); ?>
                <p class="hint">Hold <code>Ctrl</code> and click on desired workers <b>if selecting more than one</b> worker</p>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'Desc'); ?>
		<?php echo $form->textArea($model, 'Desc'); ?>
		<?php echo $form->error($model,'Desc'); ?>
		</div><!-- row -->
                <div class="row">
		<?php echo $form->labelEx($model,'file'); ?>
		<?php $this->widget('CMultiFileUpload', array(
                    'name' => 'images',
                    'model'=> $model,
                    'attribute' => 'file',
                    'accept' => 'jpeg|jpg|gif|png', //verifying files
                    'duplicate' => 'Duplicate file!',
                    'denied' => 'Invalid file type', 
                ));?>
		<?php echo $form->error($model,'file'); ?>
		</div><!-- row -->
                <div class="row">
                
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
                                'minDate'   =>  0,
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
                                'minDate'   =>  0,
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
                                'minDate'   =>  0,
				),
			));
; ?>
		<?php echo $form->error($model,'job_end_date'); ?>
		</div><!-- row -->
                <?php if(!$model->isNewRecord):  ?>
		<div class="row">
                    <?php echo $form->labelEx($model,'close_applications'); ?>
                    <?php echo $form->checkBox($model, 'close_applications'); ?>
                    <?php echo $form->error($model,'close_applications'); ?>
                    </div><!-- row -->
                <?php endif; ?>
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
		<?php echo $form->textArea($model, 'extra_directions'); ?>
		<?php echo $form->error($model,'extra_directions'); ?>
		</div><!-- row -->
                <div class="row">
                <?php echo GxHtml::submitButton(Yii::t('app', 'Post'));?>
                </div>
<?php $this->endWidget(); ?>
</div><!-- form -->