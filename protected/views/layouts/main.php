<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />
        <link rel="icon" type="image/png" href="favicon.png">
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" />
        <!--[if lt IE 9]>
            <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
        <![endif]-->
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/adjusted_bootstrap.css" />
	<!--link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/turbine/css.php?files=default.cssp;form.cssp" /-->
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/default.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/menu.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/_form.css" />
        
	<title><?php echo Yii::app()->name . ' :: ' . CHtml::encode($this->pageTitle); ?></title>
</head>

<body>
<?php //echo md5('demo');?>
<div id="mainmenu"><a id="logo" href="index.php"><img src="images/jseeker.png"/></a>
    <?php $this->widget('zii.widgets.CMenu',array(
            'items'=>array(
                    array('url'=>Yii::app()->getModule('user')->registrationUrl, 'label'=>Yii::app()->getModule('user')->t("Create Account"), 'visible'=>Yii::app()->user->isGuest, 'linkOptions' => array('class'=>'jsmen')),
                    array('url'=>Yii::app()->getModule('user')->viewContractorsUrl, 'label'=>Yii::app()->getModule('user')->t("View Contractors"), 'visible'=>!Yii::app()->user->isGuest, 'linkOptions' => array('class'=>'jsmen')),
                    array('url'=>Yii::app()->getModule('user')->loginUrl, 'label'=>Yii::app()->getModule('user')->t("Login"), 'visible'=>Yii::app()->user->isGuest, 'linkOptions' => array('id'=>'login', 'class'=>'jsmen arw')),
                    array('url'=>Yii::app()->getModule('message')->inboxUrl,'label'=>'Messages '. Yii::app()->getModule('message')->getNewMessageCount(), 'visible'=>!Yii::app()->user->isGuest, 'linkOptions' => array('class'=>'jsmen')),
                    array('url'=>Yii::app()->getModule('user')->mySkillsUrl, 'label'=>'My Skills', 'visible'=>!Yii::app()->user->isGuest, 'linkOptions' => array('class'=>'jsmen arw'),
                        'items'=>array(
                            array('url'=>Yii::app()->getModule('user')->mySkillsUrl, 'label'=>'View Skills', 'visible'=>!Yii::app()->user->isGuest),
                            array('url'=>Yii::app()->getModule('user')->skillUrl, 'label'=>'Select Skill', 'visible'=>!Yii::app()->user->isGuest),   
                        ),
                    ),
                    
                    array('url'=>Yii::app()->getModule('job')->viewJobPosts, 'label'=>'Job Posts', 'visible'=>!Yii::app()->user->isGuest, 'linkOptions' => array('class'=>'jsmen arw'),
                        'items'=>array(
                            array('url'=>Yii::app()->getModule('job')->viewMyJobPosts, 'label'=>'View My job Posts', 'visible'=>!Yii::app()->user->isGuest),
                            //array('url'=>Yii::app()->getModule('job')->viewJobPosts, 'label'=>'View Posts', 'visible'=>!Yii::app()->user->isGuest),
                            array('url'=>Yii::app()->getModule('job')->createJobPost, 'label'=>'Create Post', 'visible'=>!Yii::app()->user->isGuest),
                            array('url'=>Yii::app()->getModule('job')->jobsForMe, 'label'=>'Find Jobs For Me', 'visible'=>!Yii::app()->user->isGuest),
                        ),
                    ),
                    /*array('url'=>Yii::app()->getModule('user')->viewAccount, 'label'=>'Manage Accounts', 'visible'=>!Yii::app()->user->isGuest, 'linkOptions' => array('class'=>'jsmen arw'),
                            'items'=>array(
                                array('url'=>Yii::app()->getModule('user')->makeDeposit, 'label'=>'Deposit to Account', 'visible'=>!Yii::app()->user->isGuest),
                                //array('url'=>Yii::app()->getModule('job')->viewJobPosts, 'label'=>'View Posts', 'visible'=>!Yii::app()->user->isGuest),
                                array('url'=>Yii::app()->getModule('user')->managePayments, 'label'=>'Manage payments', 'visible'=>!Yii::app()->user->isGuest),
                                //array('url'=>Yii::app()->getModule('user')->jobsForMe, 'label'=>'Find Jobs For Me', 'visible'=>!Yii::app()->user->isGuest),
                            ),
                        ),*/
                    array('url'=>Yii::app()->getModule('user')->notificationUrl,'label'=>'Notifications ' . Yii::app()->getModule('user')->getNotificationCount(), 'visible'=>!Yii::app()->user->isGuest, 'linkOptions' => array('class'=>'jsmen')),
                    array('url'=>Yii::app()->getModule('user')->profileUrl, 'label'=>Yii::app()->getModule('user')->t("Profile"), 'visible'=>!Yii::app()->user->isGuest, 'linkOptions' => array('id'=>'login', 'class'=>'jsmen arw'),
                        'items'=>array(
                            array('label'=>Yii::app()->getModule('user')->getUserName()),
                            array('url'=>Yii::app()->getModule('user')->logoutUrl, 'label'=>Yii::app()->getModule('user')->t("Logout"), 'visible'=>!Yii::app()->user->isGuest),
                        ),
                    ),
            ),'encodeLabel'=>false
    )); ?>
</div><!-- mainmenu -->
<div id="page">

	<div id="header">
	</div><!-- header -->
	<?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('zii.widgets.CBreadcrumbs', array(
			'links'=>$this->breadcrumbs,
		)); ?><!-- breadcrumbs -->
	<?php endif?>

	<?php echo $content; ?>

	<div class="clear"></div>

	<div id="footer">
            <?php echo CHtml::link('Help Guide', array('/site/helpguide'), array('target'=>'blank')); ?>  	&#8226;
            developed by The Community
	</div><!-- footer -->

</div><!-- page -->

</body>
</html>
