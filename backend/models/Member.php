<?php
namespace backend\models;

use Yii;
use yii\db\ActiveRecord;
use yii\data\ActiveDataProvider;
use common\models\User;

class Member extends User
{
    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 1;

    public $password = "";

    public static function tableName()
    {
        return 'user';
    }
    public function rules()
    {
        return [
	            ['active', 'default', 'value' => self::STATUS_ACTIVE],
	            ['active', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_INACTIVE]],
				['password', 'match', 'pattern' => '/^[a-zA-Z0-9]*$/', 'message' => 'Password can contain only alphanumeric characters!']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'username' => 'Name',
        ];
    }

    public static function getAll()
    {
		return self::find()->all();		    	
    }
    
    public static function getActiveDataQuery()
    {
        $query = Member::find();

        return new ActiveDataProvider(['query' => $query]);
    }


}