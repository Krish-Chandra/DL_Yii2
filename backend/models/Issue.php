<?php

namespace backend\models;

use Yii;
use backend\models\Book;
use common\models\User;

/**
 * This is the model class for table "issue".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $book_id
 * @property string $issue_date
 * @property string $due_date
 *
 * @property Book $book
 * @property User $user
 */
class Issue extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'issue';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'book_id', 'issue_date', 'due_date'], 'required'],
            [['user_id', 'book_id'], 'integer'],
            [['issue_date', 'due_date'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'book_id' => 'Book ID',
            'issue_date' => 'Issue Date',
            'due_date' => 'Due Date',
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
}
