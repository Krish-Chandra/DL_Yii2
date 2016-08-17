<?php

namespace backend\models;

use Yii;
use yii\data\ActiveDataProvider;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "role".
 *
 * @property integer $id
 * @property string $rolename
 * @property string $description
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property User[] $users
 */
class Role extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'role';
    }

	public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['rolename'], 'required'],
            //[['created_at', 'updated_at'], 'integer'],
            [['rolename', 'description'], 'string', 'max' => 50]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [

            'rolename' => 'Rolename',
            'description' => 'Description',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(User::className(), ['role' => 'id']);
    }
    
    public static function getActiveDataQuery()
    {
        $query = Role::find();

        return new ActiveDataProvider(['query' => $query]);
    }
   
    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByRolename($rolename)
    {
        return static::findOne(['rolename' => $rolename]);
    }
    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    public static function getAll()
    {
        return self::find()->all();     
    }
    
    public static function getRolenameById($id)
    {
		return Role::find()->where(['id' => $id])->one()->rolename;
	}

}
