<?php
$this->breadcrumbs=array(
	'Responses'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Response', 'url'=>array('index')),
	array('label'=>'Create Response', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('response-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Responses</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'response-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'message_id',
		'message',
		'sender_id',
		'receiver_id',
		'time_sent',
		/*
		'deleted_by_sender',
		'deleted_by_receiver',
		'new_response',
		'read_by_sender',
		'read_by_receiver',
		'starred',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
