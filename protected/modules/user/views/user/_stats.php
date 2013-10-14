<div class="view">

	<?php echo GxHtml::link(GxHtml::tag('h2', array(), $data->jobPost .
                    GxHtml::tag('span', array('class'=>'legend-view', 'style'=> 'width:'.number_format(17*$data->avg, 0).'px;'), '')
                ), array('/job/jobPost/view', 'id' => $data->id)
        ); ?>

	<b><?php echo GxHtml::encode($data->getAttributeLabel('from_user_id')); ?>:</b>
            <?php echo GxHtml::encode($data->fromUser->profile->firstname); ?><br/>
	<b><?php echo GxHtml::encode($data->getAttributeLabel('to_user_id')); ?>:</b>
            <?php echo GxHtml::encode($data->toUser->profile->firstname); ?><br/>
	<b><?php echo GxHtml::encode($data->getAttributeLabel('quality')); ?>:</b>
            <?php echo GxHtml::encode($data->quality); ?><br/>
	<b><?php echo GxHtml::encode($data->getAttributeLabel('cost')); ?>:</b>
            <?php echo GxHtml::encode($data->cost); ?><br/>
	<b><?php echo GxHtml::encode($data->getAttributeLabel('expertise')); ?>:</b>
            <?php echo GxHtml::encode($data->expertise); ?><br/>
	<b><?php echo GxHtml::encode($data->getAttributeLabel('schedule')); ?>:</b>
            <?php echo GxHtml::encode($data->schedule); ?><br/>
	<b><?php echo GxHtml::encode($data->getAttributeLabel('response')); ?>:</b>
            <?php echo GxHtml::encode($data->response); ?><br/>
	<b><?php echo GxHtml::encode($data->getAttributeLabel('professionalism')); ?>:</b>
            <?php echo GxHtml::encode($data->professionalism); ?><br/>
	<b><?php echo GxHtml::encode($data->getAttributeLabel('review')); ?>:</b>
            <?php echo GxHtml::encode($data->review); ?>
</div>