<?php $this->pageTitle=UserModule::t("Edit Profile");
$this->breadcrumbs=array(
	UserModule::t("Profile")=>array('profile'),
	UserModule::t("Edit"),
);
?><h2><?php echo UserModule::t('Edit profile'); ?></h2>
<?php echo $this->renderPartial('menu'); ?>

<?php if(Yii::app()->user->hasFlash('profileMessage')): ?>
<div class="success">
<?php echo Yii::app()->user->getFlash('profileMessage'); ?>
</div>
<?php endif; ?>
<div class="form">
<?php $form=$this->beginWidget('UActiveForm', array(
	'id'=>'profile-form',
	'enableAjaxValidation'=>true,
	'htmlOptions' => array('enctype'=>'multipart/form-data', 'class'=>'pull-left'),
)); ?>

	<p class="note"><?php echo UserModule::t('Fields with <span class="required">*</span> are required.'); ?></p>

	<?php echo $form->errorSummary(array($model,$profile)); ?>

<?php /*
		$profileFields=$profile->getFields();
		
                if ($profileFields) {
			foreach($profileFields as $field) {
			?>
	<div class="row">
		<?php echo $form->labelEx($profile,$field->varname);
		
		if ($field->widgetEdit($profile)) {
			echo $field->widgetEdit($profile);
		} elseif ($field->range) {
			echo $form->dropDownList($profile,$field->varname,Profile::range($field->range));
		} elseif ($field->field_type=="TEXT") {
			echo $form->textArea($profile,$field->varname,array('rows'=>6, 'cols'=>50));
		} else {
			echo $form->textField($profile,$field->varname,array('size'=>60,'maxlength'=>(($field->field_size)?$field->field_size:255)));
		}
		echo $form->error($profile,$field->varname); ?>
	</div>	
			<?php 
			}
		}//*/
?>
	<div class="row">
		<?php echo $form->labelEx($profile,'firstname'); ?>
		<?php echo $form->textField($profile,'firstname',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($profile,'firstname'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($profile,'lastname'); ?>
		<?php echo $form->textField($profile,'lastname',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($profile,'lastname'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'username'); ?>
		<?php echo $form->textField($model,'username',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'username'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>128)); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>
        <div class="row">
		<?php echo $form->labelEx($profile,'is_job_seeker'); ?>
		<?php echo $form->dropDownList($profile,'is_job_seeker', array(1=>'Yes', 0=>'No')); ?>
		<?php echo $form->error($profile,'is_job_seeker'); ?>
	</div>
        <div class="row">
		<?php echo $form->labelEx($profile,'has_selected_skills'); ?>
		<?php echo $form->dropDownList($profile,'has_selected_skills', array(1=>'Yes', 0=>'No')); ?>
		<?php echo $form->error($profile,'has_selected_skills'); ?>
	</div>   
	<div class="row">
		<?php echo $form->labelEx($profile,'birthday'); ?>
		<?php $form->widget('zii.widgets.jui.CJuiDatePicker', array(
			'model' => $profile,
			'attribute' => 'birthday',
			'options' => array(
				'showButtonPanel' => true,
				'changeYear' => true,
				'dateFormat' => 'yy-mm-dd',
				),
			));
                ?>
		<?php echo $form->error($profile,'birthday'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? UserModule::t('Create') : UserModule::t('Save')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
