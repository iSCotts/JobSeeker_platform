<?php $this->pageTitle=UserModule::t("Create Account");
$this->breadcrumbs=array(
	UserModule::t("Create Account"),
);
?>

<h1><?php echo UserModule::t("Create Account"); ?></h1>

<?php if(Yii::app()->user->hasFlash('registration')): ?>
<div class="success">
<?php echo Yii::app()->user->getFlash('registration'); ?>
</div>
<?php else: ?>

<div class="form">
<?php $form=$this->beginWidget('UActiveForm', array(
	'id'=>'registration-form',
	'enableAjaxValidation'=>true,
	'disableAjaxValidationAttributes'=>array('RegistrationForm_verifyCode'),
	'htmlOptions' => array('enctype'=>'multipart/form-data'),
)); ?>

	<p class="note"><?php echo UserModule::t('Fields with <span class="required">*</span> are required.'); ?></p>
	
	<?php //echo $form->errorSummary(array($model,$profile)); ?>
        
	<div class="row">
	<?php echo $form->labelEx($profile,'firstname'); ?>
	<?php echo $form->textField($profile,'firstname',array('placeholder'=>'eg. Will')); ?>
	<?php echo $form->error($profile,'firstname'); ?>
	</div>
        
	<div class="row">
	<?php echo $form->labelEx($profile,'lastname'); ?>
	<?php echo $form->textField($profile,'lastname',array('placeholder'=>'eg. Salas')); ?>
	<?php echo $form->error($profile,'lastname'); ?>
	</div>
        
	<div class="row">
	<?php echo $form->labelEx($model,'username'); ?>
	<?php echo $form->textField($model,'username',array('placeholder'=>'eg. user10')); ?>
	<?php echo $form->error($model,'username'); ?>
	</div>
	
	<div class="row">
	<?php echo $form->labelEx($model,'password'); ?>
	<?php echo $form->passwordField($model,'password'); ?>
	<?php echo $form->error($model,'password'); ?>
	<p class="hint">
	The minimum password length is 6 symbols.<br>
        Your password must have at least one number in it.
	</p>
	</div>
	
	<div class="row">
	<?php echo $form->labelEx($model,'verifyPassword'); ?>
	<?php echo $form->passwordField($model,'verifyPassword'); ?>
	<?php echo $form->error($model,'verifyPassword'); ?>
	</div>
        <div class="row">
	<?php echo $form->labelEx($model,'phone_number'); ?>
	<?php echo $form->textField($model,'phone_number',array('placeholder'=>'eg. 0820000000')); ?>
	<?php echo $form->error($model,'phone_number'); ?>
	</div>
	<div class="row">
	<?php echo $form->labelEx($model,'email'); ?>
	<?php echo $form->textField($model,'email',array('placeholder'=>'eg. user10@email.com')); ?>
	<?php echo $form->error($model,'email'); ?>
	</div>
        
	<div class="row">
	<?php //echo $form->labelEx($profile,'is_job_seeker'); ?>
	<?php echo $form->radioButtonList($profile,'is_job_seeker',array('1'=>'I am a Job Seeker','0'=>'I am a Job Giver'), array('separator'=>' ')); ?>
	<?php echo $form->error($profile,'is_job_seeker'); ?>
	</div>
        
	<?php if (UserModule::doCaptcha('registration')): ?>
	<div class="row">
		<?php echo $form->labelEx($model,'verifyCode'); ?>
		<p class="hint">Please enter the letters as they are shown in the image below.<br>
                Letters are not case-sensitive.</p>
                <div style="right:0;top:0;position:absolute;max-width:109px">
                <?php $this->widget('CCaptcha'); ?>
                </div>
		<?php echo $form->textField($model,'verifyCode'); ?>
		<?php echo $form->error($model,'verifyCode'); ?>
	</div>
	<?php endif; ?>
	
	<div class="row submit">
		<?php echo CHtml::submitButton(UserModule::t("Create Account")); ?>
	</div>
        <!--script type="text/javascript">
           $(document).ready(function() {
               $(':text').focus(function() {
                   $(this).val('');
               });
               $(":contains('eg. ')").css('color', 'red');
            });
        </script-->

<?php $this->endWidget(); ?>
</div><!-- form -->
<?php endif; ?>