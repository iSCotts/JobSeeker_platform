<?php

$this->breadcrumbs = array(
	$model->label(2) => array('index'),
	GxHtml::valueEx($model),
);

$this->menu=array(
	array('label'=>Yii::t('app', 'List') . ' ' . $model->label(2), 'url'=>array('index')),
	array('label'=>Yii::t('app', 'Create') . ' ' . $model->label(), 'url'=>array('create')),
	array('label'=>Yii::t('app', 'Update') . ' ' . $model->label(), 'url'=>array('update', 'id' => $model->id)),
	array('label'=>Yii::t('app', 'Delete') . ' ' . $model->label(), 'url'=>'#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->id), 'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>Yii::t('app', 'Manage') . ' ' . $model->label(2), 'url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('app', 'View') . ' ' . GxHtml::encode($model->label()) . ' ' . GxHtml::encode(GxHtml::valueEx($model)); ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data' => $model,
	'attributes' => array(
'id',
array(
			'name' => 'fromUser',
			'type' => 'raw',
			'value' => $model->fromUser !== null ? GxHtml::link(GxHtml::encode(GxHtml::valueEx($model->fromUser)), array('/user/user/view', 'id' => GxActiveRecord::extractPkValue($model->fromUser, true))) : null,
			),
array(
			'name' => 'toUser',
			'type' => 'raw',
			'value' => $model->toUser !== null ? GxHtml::link(GxHtml::encode(GxHtml::valueEx($model->toUser)), array('/user/user/view', 'id' => GxActiveRecord::extractPkValue($model->toUser, true))) : null,
			),
array(
			'name' => 'jobPost',
			'type' => 'raw',
			'value' => $model->jobPost !== null ? GxHtml::link(GxHtml::encode(GxHtml::valueEx($model->jobPost)), array('jobPost/view', 'id' => GxActiveRecord::extractPkValue($model->jobPost, true))) : null,
			),
'quality',
'cost',
'expertise',
'schedule',
'response',
'professionalism',
'avg',
'review',
'is_paid:boolean',
	),
)); ?>

