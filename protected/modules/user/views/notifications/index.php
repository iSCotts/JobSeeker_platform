<?php

$this->breadcrumbs = array(
	Notifications::label(2),
);

$this->menu = array(
	array('label'=>Yii::t('app', 'Create') . ' ' . Notifications::label(), 'url' => array('create')),
	array('label'=>Yii::t('app', 'Manage') . ' ' . Notifications::label(2), 'url' => array('admin')),
);
?>

<h1><?php echo GxHtml::encode(Notifications::label(2)); ?></h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); 