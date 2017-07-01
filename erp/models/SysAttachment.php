<?php

namespace app\erp\models;

use Yii;

/**
 * This is the model class for table "ec_sys_attachment".
 *
 * @property integer $id
 * @property string $name
 * @property string $url
 * @property string $path
 * @property string $size
 * @property string $ext
 * @property string $user_id
 * @property string $upload_time
 * @property string $upload_ip
 * @property integer $state
 * @property string $auth_code
 */
class SysAttachment extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ec_sys_attachment';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'url', 'path', 'ext', 'upload_ip', 'auth_code'], 'required'],
            [['size', 'user_id', 'upload_time', 'state'], 'integer'],
            [['name', 'url'], 'string', 'max' => 255],
            [['path'], 'string', 'max' => 200],
            [['ext'], 'string', 'max' => 10],
            [['upload_ip'], 'string', 'max' => 30],
            [['auth_code'], 'string', 'max' => 32],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => '附件ID',
            'name' => '附件名称',
            'url' => 'web地址',
            'path' => '附件路径',
            'size' => '附件大小',
            'ext' => '扩展名',
            'user_id' => '操作员ID',
            'upload_time' => '上传时间',
            'upload_ip' => '上传IP',
            'state' => '状态',
            'auth_code' => '附件路径MD5值',
        ];
    }
}
