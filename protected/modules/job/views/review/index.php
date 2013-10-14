<?php
$this->breadcrumbs = array(
	Review::label(2),
);

$this->menu = array(
	array('label'=>Yii::t('app', 'Create') . ' ' . Review::label(), 'url' => array('create')),
	array('label'=>Yii::t('app', 'Manage') . ' ' . Review::label(2), 'url' => array('admin')),
);
?>

<h1><?php echo GxHtml::encode(Review::label(2)), ' ', CHtml::link('View Help Guide',array('/site/helpguide'), array('target'=>'blank', 'class'=>'button')); ?></h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
        'cssFile'=>'assets/rating/jquery.rating.css'
)); 