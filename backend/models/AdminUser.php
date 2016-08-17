<?php
	namespace backend\models;
	use Yii;
	use common\models\User;
	use yii\data\ActiveDataProvider;

	class AdminUser extends User
	{
		public  $password = "";
	    public static function tableName()
	    {
	        return '{{%admin_user}}';
	    }

	    public function rules()
	    {

	        return [
	            ['active', 'default', 'value' => parent::STATUS_ACTIVE],
	            ['active', 'in', 'range' => [parent::STATUS_ACTIVE, parent::STATUS_INACTIVE]],
	            [['username', 'email', 'role_id'],  'required'],
	            ['username', 'filter', 'filter' => 'trim'],
	            ['username', 'unique', 'message' => 'This username has already been taken!'],
            	['username', 'string', 'min' => 2, 'max' => 128],
            	['email', 'email'],
            	['email', 'unique', 'message' => 'This email address has already been taken!'],
	            ['email', 'string', 'max' => 50],
                ['password', 'required', 'on' => 'Create'],
				['password', 'match', 'pattern' => '/^[a-zA-Z0-9]*$/', 'message' => 'Password can contain only alphanumeric characters!']
				
	        ];
	    }

	    public function attributeLabels()
	    {
	        return [
	            'role_id' => 'Role',
	        ];
	    }

	    public function getUser()
	    {
	        if ($this->_user === false) {
	            $this->_user = static::findByUsername($this->username);
	        }

	        return $this->_user;
	    }

	    public static function getActiveDataQuery()
	    {
	        $query = self::find();

	        return new ActiveDataProvider(['query' => $query]);
	    }
	    
	    public function getRole()
	    {
	        return $this->hasOne(Role::className(), ['id' => 'role_id']);
	    }

	}
