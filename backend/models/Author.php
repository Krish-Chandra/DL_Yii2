<?php

namespace backend\models;

use Yii;
use yii\data\ActiveDataProvider;

/**
 * This is the model class for table "author".
 *
 * @property string $id
 * @property string $authorname
 * @property string $address
 * @property string $city
 * @property string $state
 * @property string $zip
 * @property string $email_id
 * @property string $phone
 *
 * @property Book[] $books
 */
class Author extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'author';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['authorname', 'address', 'city', 'state', 'zip', 'email_id', 'phone'], 'required'],
            [['authorname'], 'string', 'max' => 128],
            [['address'], 'string', 'max' => 255],
            [['city', 'email_id'], 'string', 'max' => 50],
            [['state', 'zip'], 'string', 'max' => 10],
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
            'authorname' => 'Name',
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
        return $this->hasMany(Book::className(), ['author_id' => 'id']);
    }
    
    public static function getAll()
    {
		return self::find()->all();		    	
    }
    
    public static function getActiveDataQuery()
    {
        $query = Author::find();

        return new ActiveDataProvider(['query' => $query]);
    }
    
}
