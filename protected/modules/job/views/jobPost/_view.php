<div class="view">
	<?php echo GxHtml::link('<h2>' . $data->name .'</h2>', array('/job/jobPost/view', 'id' => $data->id)); ?>

        <?php echo
            "<span><b>Created by:</b> {$data->user->profile->firstname}</span>",
            "<span><b>{$data->getAttributeLabel('name')}:</b> {$data->skill}</span>",
            "<span><b>{$data->getAttributeLabel('budget')}:</b> "; 

                if(isset($data->budget)) {
                    echo 'R '. GxHtml::encode($data->budget);
                }
                else
                {
                    echo "Not Set";
                }
                echo "</span><span><b>Description:</b> {$data->Desc}</span>"; ?>


	<?php
                if(isset($data->awardedTo))
                {
                    echo 
                        "<span><b>{$data->getAttributeLabel('awarded_to')}:</b> {$data->awardedTo}</span>";
                }
        ?>
        
</div>