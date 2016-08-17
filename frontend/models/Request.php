<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "request".
 *
 * @property string $id
 * @property string $book_id
 * @property string $user_id
 * @property string $requesteddate
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
            // [['request_date'], 'safe'],
        ];
    }

    public function addRequest($bookId)
    {
        $this->request_date = date("y/m/d");
        $this->user_id = Yii::$app->user->identity->getId();
        $this->book_id = $bookId;
        return $this->save();
    }
}
