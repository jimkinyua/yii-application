<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "KeyResultAreaAttachements".
 *
 * @property int $AttachementId
 * @property int $KeyResultId
 * @property string $Url
 * @property int $Deleted
 *
 * @property KeyResultAreas $keyResult
 */
class KeyResultAreaAttachements extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'KeyResultAreaAttachements';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['KeyResultId', 'Url', 'Deleted'], 'required'],
            [['KeyResultId', 'Deleted'], 'integer'],
            [['Url'], 'string'],
            [['KeyResultId'], 'exist', 'skipOnError' => true, 'targetClass' => KeyResultAreas::className(), 'targetAttribute' => ['KeyResultId' => 'KeyResultAreaId']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'AttachementId' => 'Attachement ID',
            'KeyResultId' => 'Key Result ID',
            'Url' => 'Url',
            'Deleted' => 'Deleted',
        ];
    }

    /**
     * Gets query for [[KeyResult]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getKeyResult()
    {
        return $this->hasOne(KeyResultAreas::className(), ['KeyResultAreaId' => 'KeyResultId']);
    }
}
