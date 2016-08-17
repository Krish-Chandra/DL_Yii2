<?php

namespace app\models;

use Yii;

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
     /*
    public function rules()
    {
        return [
            [['authorname', 'address', 'city', 'state', 'zip', 'email_id', 'phone'], 'required'],
            [['authorname'], 'string', 'max' => 50],
            [['address'], 'string', 'max' => 100],
            [['city', 'email_id'], 'string', 'max' => 25],
            [['state', 'zip'], 'string', 'max' => 10],
            [['phone'], 'string', 'max' => 20]
        ];
    }
    */
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'authorname' => 'Authorname',
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
}
