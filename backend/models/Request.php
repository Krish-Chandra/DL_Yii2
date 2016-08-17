<?php

namespace backend\models;

use Yii;
use common\models\User;

/**
 * This is the model class for table "request".
 *
 * @property string $id
 * @property string $book_id
 * @property integer $user_id
 * @property string $request_date
 *
 * @property Book $book
 * @property User $user
 */
class Request extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'request';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['book_id', 'user_id', 'request_date'], 'required'],
            [['book_id', 'user_id'], 'integer'],
            [['request_date'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'book_id' => 'Book ID',
            'user_id' => 'User ID',
            'request_date' => 'Requested On',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBook()
    {
        return $this->hasOne(Book::className(), ['id' => 'book_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
    
    public function addRequest($bookId)
    {
        $this->request_date = date("y/m/d");
        $this->user_id = Yii::$app->user->identity->id;
        $this->book_id = $bookId;
        return $this->save();
    }
    
}
