<div class="view">
    
	<!--?php echo GxHtml::encode($data->getAttributeLabel('id')); ?>:-->
	<?php echo GxHtml::link('<h2>' . GxHtml::encode($data->name).'<span>#'.GxHtml::encode($data->id).'</span></h2>', array('/job/jobPost/view', 'id' => $data->id)); ?>

        <b><?php echo GxHtml::encode($data->getAttributeLabel('user_id')); ?>:</b>
		<?php echo GxHtml::encode(GxHtml::valueEx($data->user)); ?>
	<b><?php echo GxHtml::encode($data->getAttributeLabel('skill_id')); ?>:</b>
		<?php echo GxHtml::encode(GxHtml::valueEx($data->skill)); ?>
	<b><?php echo GxHtml::encode($data->getAttributeLabel('budget')); ?>:</b>
	<?php
                if(isset($data->budget))
                {
                    echo 'R '.GxHtml::encode($data->budget);
                }
                else
                {
                    echo "Not Set";
                }
            ;
         ?>
	<br />
<!--	<?php echo GxHtml::encode($data->getAttributeLabel('name')); ?>: *Name below, no h1*>
	<br /-->
	<b><?php echo GxHtml::encode($data->getAttributeLabel('Description')); ?>:</b>
	<?php echo GxHtml::encode($data->Desc); ?>
	<br />

	<b><?php echo GxHtml::encode($data->getAttributeLabel('awarded_to')); ?>:</b>
		<?php echo GxHtml::encode(GxHtml::valueEx($data->awardedTo)); ?>
	<br />
	<?php /*
	<?php echo GxHtml::encode($data->getAttributeLabel('negotiable')); ?>:
	<?php echo GxHtml::encode($data->negotiable); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('response_cut_date')); ?>:
	<?php echo GxHtml::encode($data->response_cut_date); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('hours_per_day')); ?>:
	<?php echo GxHtml::encode($data->hours_per_day); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('job_start_date')); ?>:
	<?php echo GxHtml::encode($data->job_start_date); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('job_end_date')); ?>:
	<?php echo GxHtml::encode($data->job_end_date); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('close_applications')); ?>:
	<?php echo GxHtml::encode($data->close_applications); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('city')); ?>:
	<?php echo GxHtml::encode($data->city); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('town')); ?>:
	<?php echo GxHtml::encode($data->town); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('suburb')); ?>:
	<?php echo GxHtml::encode($data->suburb); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('street')); ?>:
	<?php echo GxHtml::encode($data->street); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('street_num')); ?>:
	<?php echo GxHtml::encode($data->street_num); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('extra_directions')); ?>:
	<?php echo GxHtml::encode($data->extra_directions); ?>
	<br />
	*/ ?>

</div>