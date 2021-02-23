<?php

namespace frontend\models;
use frontend\models\User;
use Yii;
//Model for finding employees

class Employee extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return Yii::$app->params['Company'].'Employee ';
    }
    public static function getSupervisor($id){
        $supervisor=User::findOne(['[User ID]'=>$id]);
        return $supervisor->{'Employee No_'};
    }
    public static function getDb()
    {
        return Yii::$app->get('db_nav');
    }


}