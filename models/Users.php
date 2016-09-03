<?php

namespace app\models;

use Yii;
use yii\web\UploadedFile;

/**
 * This is the model class for table "users".
 *
 * @property integer $id
 * @property string $name
 * @property string $phone
 * @property string $email
 * @property string $position
 * @property string $img_hash
 * @property integer $parent_id
 */
class Users extends \yii\db\ActiveRecord
{
    /** @var UploadedFile $image */
    public $image;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'users';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['parent_id'], 'integer'],
            [['name', 'position'], 'string', 'max' => 50],
            [['name', 'position'], 'required'],
            [['phone', 'email'], 'required', 'on' => 'primary'],
            [['phone'], 'string', 'max' => 20],
            [['email'], 'string', 'max' => 255],
            [['email'], 'email'],
            [['img_hash'], 'string', 'max' => 32],
            [['image'], 'image'],
            [['image'], 'required']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'phone' => 'Phone',
            'email' => 'Email',
            'position' => 'Position',
            'img_hash' => 'Img Hash',
            'parent_id' => 'Parent ID',
        ];
    }
}