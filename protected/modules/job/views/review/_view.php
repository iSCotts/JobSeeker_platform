<div class="view">
	<?php echo GxHtml::link(GxHtml::tag('h2', array(), $data->jobPost .
                    GxHtml::tag('span', array('class'=>'legend-view', 'style'=> 'width:'.number_format(17*$data->avg, 0).'px;'), '')
                ), array('view', 'id' => $data->id)
        ); ?>

	<b><?php echo GxHtml::encode($data->getAttributeLabel('from_user_id')); ?>:</b>
            <?php echo GxHtml::encode(GxHtml::valueEx($data->fromUser)); ?><br/>
	<b><?php echo GxHtml::encode($data->getAttributeLabel('to_user_id')); ?>:</b>
            <?php echo GxHtml::encode($data->toUser); ?><br/>
	<b><?php echo GxHtml::encode($data->getAttributeLabel('job_post_id')); ?>:</b>
            <?php echo GxHtml::encode(GxHtml::valueEx($data->jobPost)); ?><br/>
        <b><?php echo GxHtml::encode($data->getAttributeLabel('avg')); ?>:</b>   
            <?php echo number_format($data->avg, 2); ?>
</div>