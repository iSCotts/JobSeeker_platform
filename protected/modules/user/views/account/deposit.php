<?php 
$this->breadcrumbs = array(
	$model->label(2) => array('index'),
	'Deposit',
);?>
<h1>Deposit</h1>
<div class="form">


<?php $form = $this->beginWidget('GxActiveForm', array(
	'id' => 'account-form',
	'enableAjaxValidation' => false,
));
?>
	<p class="note">
		<?php echo Yii::t('app', 'Fields with'); ?> <span class="required">*</span> <?php echo Yii::t('app', 'are required'); ?>.
	</p>

	<?php echo $form->errorSummary($model); ?>

		<div class="row">
		<!--?php// echo $form->labelEx($model,'balance'); ?-->
        <?php echo $form->labelEx($model,'Current Balance'); ?>
		R <?php echo $model->balance; ?>
		<?php echo $form->error($model,'balance'); ?>
		</div><!-- row -->
        <div class="row">
		<?php echo $form->labelEx($model,'deposit'); ?>
		<?php echo $form->textField($model, 'deposit'); ?>
		<?php echo $form->error($model,'deposit'); ?>
		</div><!-- row -->

        <div class="row submit">
        <?php echo GxHtml::submitButton(Yii::t('app', 'Make Deposit')); ?>
        </div>
<?php $this->endWidget(); ?>
</div><!-- form -->