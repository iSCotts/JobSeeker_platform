<div class="form">


<?php $form = $this->beginWidget('GxActiveForm', array(
	'id' => 'select-skill-form',
	'enableAjaxValidation' => false,
));
?>
    <label><?php echo GxHtml::encode($model->getRelationLabel('tblUsers')); ?></label>
    <?php echo $form->checkBoxList($model, 'tblUsers', GxHtml::encodeEx(GxHtml::listDataEx(User::model()->findAllAttributes(null, true)), false, true)); ?>

<?php
echo GxHtml::submitButton(Yii::t('app', 'Save'));
$this->endWidget();
?>
</div><!-- form -->