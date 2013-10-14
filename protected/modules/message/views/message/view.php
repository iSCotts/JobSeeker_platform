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
'title',
'message',
array(
			'name' => 'sender',
			'type' => 'raw',
			'value' => $model->sender !== null ? GxHtml::link(GxHtml::encode(GxHtml::valueEx($model->sender)), array('user/view', 'id' => GxActiveRecord::extractPkValue($model->sender, true))) : null,
			),
array(
			'name' => 'receiver',
			'type' => 'raw',
			'value' => $model->receiver !== null ? GxHtml::link(GxHtml::encode(GxHtml::valueEx($model->receiver)), array('user/view', 'id' => GxActiveRecord::extractPkValue($model->receiver, true))) : null,
			),
'time_sent',
'updated_message_time',
	),
)); ?>
<div id="comments">

    <?php $this->renderPartial('_response',array('response'=>$model->responses,)); ?>

    <h3>Send A Reply</h3>
    <?php if(Yii::app()->user->hasFlash('success')||Yii::app()->user->hasFlash('error')): ?>
    <div class="alert-success ">
    <?php echo Yii::app()->user->getFlash('success'); ?>
    </div>
    <?php $this->renderPartial('/response/_form',array(
    'model'=>$response,
    )); ?>
    <?php else: ?>
    <?php $this->renderPartial('/response/_form',array(
    'model'=>$response,
    )); ?>
    <?php endif; ?>
</div>