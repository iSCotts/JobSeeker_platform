<?php Yii::app()->getClientScript()->registerCssFile('assets/rating/jquery.rating.css', 'screen');
$this->breadcrumbs = array(
	'User Stats'
);?>
<h1>My Stats</h1>
<? if ($average!=null){echo 'The average for this user is '. $average;} ?>
<?php

$this->widget('zii.widgets.CListView', array(
                'dataProvider'=>$dataProvider,
                'itemView'=>'_stats',
        ));