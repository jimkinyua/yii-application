<?php

namespace common\models;
use common\models\User;
use Yii;
//Model for finding employees

class Dimensions extends \yii\db\ActiveRecord //Dimension values
{
    public static function tableName()
    {
        return Yii::$app->params['Company'].'Dimension Value ';
    }
   
    public static function getDb()
    {
        return Yii::$app->get('db_nav');
    }


}