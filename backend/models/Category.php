<?php

namespace backend\models;

use Yii;
use yii\data\ActiveDataProvider;

/**
 * This is the model class for table "category".
 *
 * @property string $id
 * @property string $categoryname
 * @property string $description
 * 
 * @property Book[] $books
 */
class Category extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'category';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['categoryname'], 'required'],
            [['categoryname'], 'string', 'max' => 50],
            [['description'], 'string', 'max' => 255]            
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'categoryname' => 'Name',
            'description' => 'Description'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBooks()
    {
        return $this->hasMany(Book::className(), ['category_id' => 'id']);
    }
    public static function getAll()
    {
		return self::find()->all();		
	}
    public static function getActiveDataQuery()
    {
        $query = Category::find();

        return new ActiveDataProvider(['query' => $query]);
    }
	
}
