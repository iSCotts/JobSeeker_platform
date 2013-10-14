<?php
Yii::import('application.modules.user.models._base.BaseUser');
class User extends BaseUser
{
	const STATUS_NOACTIVE=0;
	const STATUS_ACTIVE=1;
	const STATUS_BANED=-1;
	
	/**
	 * The followings are the available columns in table 'users':
	 * @var integer $id
	 * @var string $username
	 * @var string $password
	 * @var string $email
	 * @var string $activkey
	 * @var integer $createtime
	 * @var integer $lastvisit
	 * @var integer $superuser
	 * @var integer $status
	 */
        
        public static function model($className=__CLASS__) {
                        return parent::model($className);
                }

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return Yii::app()->getModule('user')->tableUsers;
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		
		return ((Yii::app()->getModule('user')->isAdmin())?array(
			#array('username, password, email', 'required'),
			array('username', 'length', 'max'=>20, 'min' => 6,'message' => UserModule::t("Incorrect username (length between 3 and 20 characters).")),
                        array('password', 'length', 'max'=>128, 'min' => 6,'message' => UserModule::t("Incorrect password (minimal length 4 symbols).")),
			array('email', 'email'),
			array('username', 'unique', 'message' => UserModule::t("This user's name already exists.")),
			array('email', 'unique', 'message' => UserModule::t("This user's email address already exists.")),
			array('username', 'match', 'pattern' => '/^[A-Za-z0-9_]+$/u','message' => UserModule::t("Incorrect symbols (A-z0-9).")),
			array('status', 'in', 'range'=>array(self::STATUS_NOACTIVE,self::STATUS_ACTIVE,self::STATUS_BANED)),
			array('superuser', 'in', 'range'=>array(0,1)),
			array('username, email, createtime, lastvisit, superuser, status', 'required'),
			array('createtime, lastvisit, superuser, status', 'numerical', 'integerOnly'=>true),
                        array('password', 'passwordAlphaNumeric','on'=>'insert'),
                        ):((Yii::app()->user->id==$this->id)?array(
			array('username, email', 'required'),
			array('username', 'length', 'max'=>20, 'min' => 3,'message' => UserModule::t("Incorrect username (length between 3 and 20 characters).")),
			array('email', 'email'),
			array('username', 'unique', 'message' => UserModule::t("This user's name already exists.")),
			array('username', 'match', 'pattern' => '/^[A-Za-z0-9_]+$/u','message' => UserModule::t("Incorrect symbols (A-z0-9).")),
			array('email', 'unique', 'message' => UserModule::t("This user's email address already exists.")),
                        array('password', 'passwordAlphaNumeric','on'=>'insert'),
                      ):array()));
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
                
		$relations = array(
			'profile'=>array(self::HAS_ONE, 'Profile', 'user_id'),
                        'Skills' => array(self::MANY_MANY, 'Skill', 'tbl_user_has_skill(user_id, skill_id)'),
			'account' => array(self::HAS_ONE, 'Account', 'user_id'),
			'invitedUsers' => array(self::HAS_MANY, 'InvitedUser', 'user_id'),
			'jobPosts' => array(self::HAS_MANY, 'JobPost', 'user_id'),
			'jobResponses' => array(self::HAS_MANY, 'JobResponse', 'user_id'),
			'messages' => array(self::HAS_MANY, 'Message', 'sender_id'),
			'messages1' => array(self::HAS_MANY, 'Message', 'receiver_id'),
			'messageDatas' => array(self::HAS_MANY, 'MessageData', 'user_id'),
			'notifications' => array(self::HAS_MANY, 'Notifications', 'receiver_id'),
			'responses' => array(self::HAS_MANY, 'Response', 'sender_id'),
			'responses1' => array(self::HAS_MANY, 'Response', 'receiver_id'),
			'responseDatas' => array(self::HAS_MANY, 'ResponseData', 'user_id'),
			'reviews' => array(self::HAS_MANY, 'Review', 'from_user_id'),
			'reviews1' => array(self::HAS_MANY, 'Review', 'to_user_id'),
			'userSkills' => array(self::HAS_MANY, 'UserSkill', 'user_id'),
		
		);
		if (isset(Yii::app()->getModule('user')->relations)) $relations = array_merge($relations,Yii::app()->getModule('user')->relations);
		return $relations;
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'username'=>UserModule::t("Username"),
			'password'=>UserModule::t("Password"),
			'verifyPassword'=>UserModule::t("Retype Password"),
			'email'=>UserModule::t("E-mail"),
			'verifyCode'=>UserModule::t("Verification Code"),
			'id' => UserModule::t("Id"),
			'activkey' => UserModule::t("activation key"),
			'createtime' => UserModule::t("Registration date"),
			'lastvisit' => UserModule::t("Last visit"),
			'superuser' => UserModule::t("Superuser"),
			'status' => UserModule::t("Status"),
		);
	}
	
	public function scopes()
    {
        return array(
            'active'=>array(
                'condition'=>'status='.self::STATUS_ACTIVE,
            ),
            'notactvie'=>array(
                'condition'=>'status='.self::STATUS_NOACTIVE,
            ),
            'banned'=>array(
                'condition'=>'status='.self::STATUS_BANED,
            ),
            'superuser'=>array(
                'condition'=>'superuser=1',
            ),
            'notsafe'=>array(
            	'select' => 'id, username, password, email, activkey, createtime, lastvisit, superuser, status',
            ),
        );
    }
	
	public function defaultScope()
    {
        return array(
            'select' => 'id, username, email, createtime, lastvisit, superuser, status',
        );
    }
	
	public static function itemAlias($type,$code=NULL) {
		$_items = array(
			'UserStatus' => array(
				self::STATUS_NOACTIVE => UserModule::t('Not active'),
				self::STATUS_ACTIVE => UserModule::t('Active'),
				self::STATUS_BANED => UserModule::t('Banned'),
			),
			'AdminStatus' => array(
				'0' => UserModule::t('No'),
				'1' => UserModule::t('Yes'),
			),
		);
		if (isset($code))
			return isset($_items[$type][$code]) ? $_items[$type][$code] : false;
		else
			return isset($_items[$type]) ? $_items[$type] : false;
	}
        
        public function getSkills() {
            
             $skillsArray=array();
             $skillsArray = CHtml::listdata($this->userSkills,'skills_id','skills_id.name');
             
             return $skillsArray;
        }
        
        public function passwordAlphaNumeric($attribute,$params)
        {
            $numeric = '/[0-9]+/u';
            $aplha = '/[A-Za-z_]+/u';
            if(!preg_match($aplha, $this->$attribute))
            {
                $this->addError($attribute, 'your password must contain some alpha values!');
            }
            else if(!preg_match($numeric, $this->$attribute))
            {
                $this->addError($attribute, 'your password must contain some numeric values!');
            }
            
        }
}