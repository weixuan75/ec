<?php

namespace app\erp\models;

use Yii;

/**
 * This is the model class for table "{{%sys_attachment}}".
 *
 * @property string $id
 * @property string $name
 * @property string $oldname
 * @property string $path
 * @property string $size
 * @property string $ext
 * @property string $user_id
 * @property string $uploadtime
 * @property string $upload_ip
 * @property integer $stat
 * @property string $authcode
 */
class SysAttachment extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%sys_attachment}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'name', 'path', 'ext', 'upload_ip', 'authcode'], 'required'],
            [['id', 'size', 'user_id', 'uploadtime', 'state'], 'integer'],
            [['name', 'oldname'], 'string', 'max' => 255],
            [['path'], 'string', 'max' => 200],
            [['ext'], 'string', 'max' => 10],
            [['upload_ip'], 'string', 'max' => 30],
            [['authcode'], 'string', 'max' => 32],
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
            'oldname' => 'Oldname',
            'path' => '附件路径',
            'size' => '附件大小',
            'ext' => '扩展名',
            'user_id' => '操作员ID',
            'uploadtime' => '上传时间',
            'upload_ip' => '上传IP',
            'state' => '状态',
            'authcode' => '附件路径MD5值',
        ];
    }
}
