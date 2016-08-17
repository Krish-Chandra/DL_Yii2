<?php

namespace app\models;

use Yii;
use yii\data\ActiveDataProvider;


/**
 * This is the model class for table "book".
 *
 * @property string $id
 * @property string $title
 * @property string $category_id
 * @property string $author_id
 * @property string $publisher_id
 * @property string $isbn
 * @property string $total_copies
 * @property string $available_copies
 *
 * @property Author $author
 * @property Category $category
 * @property Publisher $publisher
 */
class Book extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'book';
    }

    /**
     * @inheritdoc
     */
/*
    public function rules()
    {
        return [
            [['title', 'author_id', 'publisher_id', 'isbn', 'total_copies', 'available_copies'], 'required'],
            [['category_id', 'author_id', 'publisher_id', 'total_copies', 'available_copies'], 'integer'],
            [['title'], 'string', 'max' => 100],
            [['isbn'], 'string', 'max' => 50]
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
            'title' => 'Title',
            'category_id' => 'Category ID',
            'author_id' => 'Author ID',
            'publisher_id' => 'Publisher ID',
            'isbn' => 'Isbn',
            'total_copies' => 'Total Copies',
            'available_copies' => 'Available Copies',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthor()
    {
        return $this->hasOne(Author::className(), ['id' => 'author_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPublisher()
    {
        return $this->hasOne(Publisher::className(), ['id' => 'publisher_id']);
    }
	public function getImageurl()
	{
		return \Yii::$app->request->baseUrl.'/images/msg-ok.gif';
	}  

    public static function getRequestedBooks()
    {
         $bookIds = \Yii::$app->session['reqCart'];
         $Ids = array();
         if ($bookIds != NULL)
         {
             foreach($bookIds as $key => $val)
             {
                 $Ids[] = $val;
             }
             
             $provider = new ActiveDataProvider([
                 'query' => (new \yii\db\Query())->from('book')->where(['id' => $Ids])
             ]);

             return $provider;      
         }
         else
         {
             return NULL;            
         }
    }

    public static function getBookNameById($Id)
    {
        $result = self::find()->where(['id' => $Id])->one();
        if ($result === NULL)
        {
            return NULL;
        }
        else
        {
            return $result->title;
        }
    }
}
