<?php

namespace backend\models;

use Yii;
use yii\data\ActiveDataProvider;


/**
 * This is the model class for table "publisher".
 *
 * @property string $id
 * @property string $publishername
 * @property string $address
 * @property string $city
 * @property string $state
 * @property string $zip
 * @property string $email_id
 * @property string $phone
 *
 * @property Book[] $books
 */
class Publisher extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'publisher';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['publishername', 'address', 'city', 'state', 'zip', 'email_id', 'phone'], 'required'],
            [['publishername'], 'string', 'max' => 128],
            [['address'], 'string', 'max' => 255],
            [['city', 'email_id'], 'string', 'max' => 50],
            [['state', 'zip'], 'string', 'max' => 10],
            // [['zip'], 'string', 'max' => 10],
            [['phone'], 'string', 'max' => 15]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'publishername' => 'Name',
            'address' => 'Address',
            'city' => 'City',
            'state' => 'State',
            'zip' => 'Zip',
            'email_id' => 'Email ID',
            'phone' => 'Phone',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBooks()
    {
        return $this->hasMany(Book::className(), ['publisher_id' => 'id']);
    }

    public static function getAll()
    {
		return Self::find()->all();
	}

    public static function getActiveDataQuery()
    {
        $query = Publisher::find();

        return new ActiveDataProvider(['query' => $query]);
    }
    
}
