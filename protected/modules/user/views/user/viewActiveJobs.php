<?php $this->widget('zii.widgets.CListView', array(
        'dataProvider'=>$dataProvider,
        'itemView'=>'job.views.jobPost._view',
		'template'=>'{items}{pager}{summary}',
        'cssFile'=>'ie.css',
    )); ?>