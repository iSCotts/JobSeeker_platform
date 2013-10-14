<?php

$this->breadcrumbs = array(
	Account::label(2),
);

$this->menu = array(
	array('label'=>Yii::t('app', 'Create') . ' ' . Account::label(), 'url' => array('create')),
	array('label'=>Yii::t('app', 'Manage') . ' ' . Account::label(2), 'url' => array('admin')),
);
?>

<h1><?php echo GxHtml::encode(Account::label(2)); ?></h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); 