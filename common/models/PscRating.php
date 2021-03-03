<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "PscRating".
 *
 * @property int $Id
 * @property string $Description
 * @property int $Rating
 */
class PscRating extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'PscRating';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['Description', 'Rating'], 'required'],
            [['Description'], 'string'],
            [['Rating'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'Id' => 'ID',
            'Description' => 'Description',
            'Rating' => 'Rating',
        ];
    }
}
