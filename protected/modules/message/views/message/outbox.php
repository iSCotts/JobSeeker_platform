<?php
$this->breadcrumbs=array(
	'Outbox',
);

$this->renderPartial('_messageMenu');
?>

<h1>My Outbox</h1>
<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
