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
class ScoreMatrix extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ScoreMatrix';
    }


}
