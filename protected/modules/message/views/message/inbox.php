<?php
$this->breadcrumbs=array(
	'Inbox',
);

$this->renderPartial('_messageMenu');
?>

<h1>My Inbox</h1>
<?php
//$data = $messageData->getUnread();
//$messageData = MessageData::model()->findAll('user_id = :uid',array(':uid'=>yii::app()->user->id));
$this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
       // 'viewData'=>array('data'=>$messageData,),
        //'template'=>"{items}\n{pager}\n{summary}",
)); ?>
