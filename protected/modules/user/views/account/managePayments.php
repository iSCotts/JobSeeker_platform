<?php

$this->breadcrumbs = array(
	$model->label(2) => array('index'),
	Yii::t('app', 'Manage Payments'),
);?>
<h1>Manage Payments</h1>
<?php
$this->menu = array(
		array('label'=>Yii::t('app', 'List') . ' ' . $model->label(2), 'url'=>array('index')),
		array('label'=>Yii::t('app', 'Create') . ' ' . $model->label(), 'url'=>array('create')),
	);

Yii::app()->clientScript->registerScript('searchx', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('job-post-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>
<div class="wide form">
<?php //echo CHtml::beginForm(array('/user/Account/makePayment'),'post',array('id'=>'payment-form')); ?>
    <?php 
    $form=$this->beginWidget('CActiveForm', array(
        'id'=>'campaign-search-form',
        'enableAjaxValidation'=>false,
        'htmlOptions'=>array('enctype' => 'multipart/form-data')
));
?>
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id' => 'job-post-grid',
	'dataProvider' => $model->searchMyPosts(),
	'filter' => $model,
        'selectableRows'=>2,
	'columns' => array(
		array(
                                'class'=>'CCheckBoxColumn',
                                'value'=>$model->id,
                                'id'=>'checkBoxValue',
                ),
		array(
				//'name'=>'user_id',
				'value'=>'GxHtml::valueEx($data->user)',
				//'filter'=>GxHtml::listDataEx(User::model()->findAllAttributes(null, true)),
				),
		array(
				'name'=>'skill_id',
				'value'=>'GxHtml::valueEx($data->skill)',
				'filter'=>GxHtml::listDataEx(Skill::model()->findAllAttributes(null, true)),
				),
		'name',
		'Desc',
		'budget',
		/*
		array(
				'name'=>'awarded_to',
				'value'=>'GxHtml::valueEx($data->awardedTo)',
				'filter'=>GxHtml::listDataEx(JobResponse::model()->findAllAttributes(null, true)),
				),
		array(
					'name' => 'negotiable',
					'value' => '($data->negotiable === 0) ? Yii::t(\'app\', \'No\') : Yii::t(\'app\', \'Yes\')',
					'filter' => array('0' => Yii::t('app', 'No'), '1' => Yii::t('app', 'Yes')),
					),
		'response_cut_date',
		'hours_per_day',
		'job_start_date',
		'job_end_date',
		array(
					'name' => 'close_applications',
					'value' => '($data->close_applications === 0) ? Yii::t(\'app\', \'No\') : Yii::t(\'app\', \'Yes\')',
					'filter' => array('0' => Yii::t('app', 'No'), '1' => Yii::t('app', 'Yes')),
					),
		'city',
		'town',
		'suburb',
		'street',
		'street_num',
		'extra_directions',
		*/
		array(
			'class' => 'CButtonColumn',
		),
	),
)); ?>

<?php echo CHtml::submitButton('Make Payment(s)'); ?>
    <?php $this->endWidget(); ?>
<?php //echo CHtml::endForm(); ?>
</div>