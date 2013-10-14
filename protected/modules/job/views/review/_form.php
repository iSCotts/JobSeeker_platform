<div class="form">
	<p class="note">
        <span class="legend-1" title="1 Star">&nbsp;<i>Very Poor</i></span>
        <span class="legend-2" title="2 Stars">&nbsp;<i>Poor</i></span>
        <span class="legend-3" title="3 Stars">&nbsp;<i>Average</i></span>
        <span class="legend-4" title="4 Stars">&nbsp;<i>Good</i></span>
        <span class="legend-5" title="5 Stars">&nbsp;<i>Very Good</i></span>
	</p>

<?php $form = $this->beginWidget('GxActiveForm', array(
	'id' => 'review-form',
	'enableAjaxValidation' => false,
));
?>

	<?php Yii::app()->getClientScript()->registerCssFile('assets/rating/jquery.rating.css', 'screen');
        echo $form->errorSummary($model); ?>
		<div class="row">
		<?php echo $form->labelEx($model,'quality'); ?>
		<?php echo $form->radioButtonList($model, 'quality',Review::ratingScale(),array('separator'=>'','class'=>'star','template'=>'{input}')); ?>
		<?php echo $form->error($model,'quality'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'cost'); ?>
		<?php echo $form->radioButtonList($model, 'cost',Review::ratingScale(),array('separator'=>'','class'=>'star','template'=>'{input}')); ?>
		<?php echo $form->error($model,'cost'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'expertise'); ?>
		<?php echo $form->radioButtonList($model, 'expertise',Review::ratingScale(),array('separator'=>'','class'=>'star','template'=>'{input}')); ?>
		<?php echo $form->error($model,'expertise'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'schedule'); ?>
		<?php echo $form->radioButtonList($model, 'schedule',Review::ratingScale(),array('separator'=>'','class'=>'star','template'=>'{input}')); ?>
		<?php echo $form->error($model,'schedule'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'response'); ?>
		<?php echo $form->radioButtonList($model, 'response',Review::ratingScale(),array('separator'=>'','class'=>'star','template'=>'{input}')); ?>
		<?php echo $form->error($model,'response'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'professionalism'); ?>
		<?php echo $form->radioButtonList($model, 'professionalism',Review::ratingScale(),array('separator'=>'','class'=>'star','template'=>'{input}')); ?>
		<?php echo $form->error($model,'professionalism'); ?>
		</div><!-- row -->
        <?php // if(Yii::app()->user->profile->is_job_seeker): ?>
        <div class="row">
		<?php echo $form->labelEx($model,'is_paid'); ?>
                <?php echo $form->radioButtonList($model, 'is_paid', array(1=>'Yes',0=>'No'), array('template'=>'{label} {input}', 'separator'=>'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;')); ?>
		<?php //echo $form->checkBox($model, 'is_paid'); ?>
		<?php echo $form->error($model,'is_paid'); ?>
		</div><!-- row -->
        <?php //endif; ?>
		<div class="row">
		<?php echo $form->labelEx($model,'review'); ?>
		<?php echo $form->textArea($model, 'review'); ?>
		<?php echo $form->error($model,'review'); ?>
		</div><!-- row -->
            <div class="row">
                <?php echo GxHtml::submitButton(Yii::t('app', 'Save')); ?>
            </div><!-- row -->
<?php $this->endWidget(); ?>
        
</div><!-- form -->
<script type="text/javascript" src="assets/rating/jquery.js"></script>
<script type="text/javascript" src="assets/rating/jquery.rating.pack.js"></script>

<script type="text/javascript">
    $(function(){ // wait for document to load
        $('input.star').rating();
    });
</script>