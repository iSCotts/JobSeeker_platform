<?php

$this->breadcrumbs = array(
	$model->label(2) => array('index'),'View'
);

$this->menu=array(
	array('label'=>Yii::t('app', 'List') . ' ' . $model->label(2), 'url'=>array('index')),
	array('label'=>Yii::t('app', 'Create') . ' ' . $model->label(), 'url'=>array('create')),
	array('label'=>Yii::t('app', 'Update') . ' ' . $model->label(), 'url'=>array('update', 'id' => $model->id)),
	array('label'=>Yii::t('app', 'Delete') . ' ' . $model->label(), 'url'=>'#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->id), 'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>Yii::t('app', 'Manage') . ' ' . $model->label(2), 'url'=>array('admin')),
);

    $notificationType = str_replace('_', ' ', $model->notificationType);
    $notificationType =  ucwords($notificationType);
?>

<h1><?php echo $notificationType . ' ' . GxHtml::encode(GxHtml::valueEx($model)); ?></h1>
<?php $this->widget('zii.widgets.CDetailView', array(
	'data' => $model,
	'attributes' => array(
'id',
array(
			'name' => 'receiver',
			'type' => 'raw',
			'value' => $model->receiver !== null ? GxHtml::link(GxHtml::encode(GxHtml::valueEx($model->receiver)), array('user/view', 'id' => GxActiveRecord::extractPkValue($model->receiver, true))) : null,
			),
array(
			'name' => 'jobPost',
			'type' => 'raw',
			'value' => $model->jobPost !== null ? GxHtml::link(GxHtml::encode(GxHtml::valueEx($model->jobPost)), array('/job/jobPost/view', 'id' => GxActiveRecord::extractPkValue($model->jobPost, true))) : null,
			),
array(
			'name' => 'notificationType',
			'type' => 'raw',
			'value' => $model->notificationType !== null ? GxHtml::link(GxHtml::encode(GxHtml::valueEx($model->notificationType)), array('notificationType/view', 'id' => GxActiveRecord::extractPkValue($model->notificationType, true))) : null,
			),
'time_sent',
	),
)); ?>

