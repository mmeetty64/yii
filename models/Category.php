<?php

namespace app\models;

use Yii;
use yii\db\Query;

/**
 * This is the model class for table "category".
 *
 * @property int $id
 * @property string $title
 *
 * @property Request[] $requests
 */
class Category extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'category';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['title'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
        ];
    }

    /**
     * Gets query for [[Requests]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRequests()
    {
        return $this->hasMany(Request::class, ['category_id' => 'id']);
    }

    public static function getCategory(){
        return (new Query())
            ->select('title')
            ->from('category')
            ->indexBy('id')
            ->column();
    }
}
