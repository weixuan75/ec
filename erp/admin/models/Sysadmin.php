<?php

namespace app\erp\admin\models;

use app\erp\models\Sysadmindate;
use app\erp\util\SysConf;
use Yii;
use yii\db\ActiveRecord;
use yii\helpers\Json;

/**
 * This is the model class for table "{{%sys_admin}}".
 *
 * @property string $id
 * @property string $account
 * @property string $email
 * @property string $phone
 * @property string $password
 * @property integer $state
 * @property string $auth_code
 * @property string $login_ip
 * @property string $login_time
 * @property integer $sys_group_id
 * @property string $create_time
 * @property string $update_time
 */
class Sysadmin extends ActiveRecord{

    public $repass;

    public static function tableName(){
        return '{{%sys_admin}}';
    }

    public function rules()
    {
        return [
            [['state', 'login_time', 'sys_group_id', 'create_time', 'update_time','phone'], 'integer'],
            [['account'], 'string', 'max' => 50],
            [['email'], 'string', 'max' => 100],
            [['phone'], 'string', 'max' => 11],
            [['phone'], 'string', 'min' => 11],
            [['password', 'auth_code'], 'string', 'max' => 250],
            [['login_ip'], 'string', 'max' => 40],

            [['password'], 'validateActivate', 'on' => 'login'],
            [['password'], 'validateBan', 'on' => 'login'],
            [['password'], 'validateDel', 'on' => 'login'],

            [['password'], 'validatePass', 'on' => ['login', 'changeemail']],
            [['password'], 'required','message' => '密码不能为空', 'on' => ['login','', 'changeemail']],
            [['account'], 'required','message' => '账号不能为空','on' => ['login','add']],
            [['email'], 'required','message' => '邮箱不能为空','on' => 'add'],
            [['email'], 'email','message' => '邮箱格式错误','on' => 'add'],
            [['phone'], 'required','message' => '手机号不能为空','on' => 'add'],
            [['auth_code'],'required','message' => '授权码不能为空','on' => 'add'],

            [['repass'], 'required', 'message' => '确认密码不能为空', 'on' => ['changepass', 'add']],
            [['repass'], 'compare', 'compareAttribute' => 'password', 'message' => '两次密码输入不一致', 'on' => ['changepass', 'add']],
            [['account'], 'unique','message' => '账号已注册','on' => 'add'],
            [['email'], 'unique','message' => '邮箱已注册','on' => 'add'],
            [['phone'], 'unique','message' => '电话已注册','on' => 'add'],
            [['auth_code'],'unique','message' => '授权码已注册','on' => 'add'],
        ];
    }
    public function attributeLabels()
    {
        return [
            'id' => '系统会员ID',
            'account' => '账号',
            'email' => '电子邮件',
            'phone' => '电话',
            'password' => '密码',
            'repass' => '确认密码',
            'state' => '状态',
            'auth_code' => '认证码',
            'login_ip' => '登陆IP地址',
            'login_time' => '登陆时间',
            'sys_group_id' => '会员组',
            'create_time' => '创建时间',
            'update_time' => '修改时间',
        ];
    }
    /**
     * 密码是否正确
     */
    public function validatePass(){
        if (!$this->hasErrors()) {
            $data = self::find()->where(
                'account = :user and password = :pass',
                [":user" => $this->account, ":pass" => md5($this->password)]
            )->one();
            if (is_null($data)) {
                $this->addError("password", "用户名或者密码错误");
            }
        }
    }
    /**
     * 账户激活问题
     */
    public function validateActivate(){
        if (!$this->hasErrors()) {
            $data = self::find()
                ->select(['state'])
                ->where(
                'account = :user and password = :pass',
                [":user" => $this->account, ":pass" => md5($this->password)]
            )->one();
            if ($data['state']==0) {
                $this->addError("password", "账户未激活，请联系管理员");
            }
        }
    }
    /**
     * 账户禁用问题
     */
    public function validateBan(){
        if (!$this->hasErrors()) {
            $data = self::find()
                ->select(['state'])
                ->where(
                'account = :user and password = :pass',
                [":user" => $this->account, ":pass" => md5($this->password)]
            )->one();
            if ($data['state']==2) {
                $this->addError("password", "账户被禁用，请联系管理员");
            }
        }
    }
    /**
     * 账户删除问题
     */
    public function validateDel(){
        if (!$this->hasErrors()) {
            $data = self::find()
                ->select(['state'])
                ->where(
                'account = :user and password = :pass',
                [":user" => $this->account, ":pass" => md5($this->password)]
            )->one();
            if ($data['state']==3) {
                $this->addError("password", "账户已删除，请联系管理员");
            }
        }
    }
    public function login($data){
        $this->scenario="login";
        if ($this->load($data) && $this->validate()) {
            $this->updateAll([
                'login_time' => time(),
                'login_ip' => ip2long(Yii::$app->request->userIP)
            ], 'account = :user', [':user' => $this->account]);

            $user = self::find()
                ->select([
                    'id',
                    'account',
                    'email',
                    'phone',
                    'state',
                    'auth_code',
                    'login_ip',
                    'login_time',
                    'sys_group_id',
                    'create_time',
                    'update_time',
                ])
                ->where('account=:account',[':account'=>$this->account])
                ->one()
                ->toArray();
            $userdate = Sysadmindate::find()
                ->where("sys_admin_id=:id",[':id'=>$user['id']])
                ->one()->toArray();
            $redis = Yii::$app->redis;
            $session = Yii::$app->session;
            $session["userData"] = [
                'user'=>$user,
                'data'=>$userdate
            ];
            $redis->set($user['auth_code'],Json::encode($session["userData"]));
            return true;
        }
        return false;
    }
    public function add($data){
        $this->scenario="add";
        $conf = new SysConf();
        $uuid = $conf->uuid();
        $this->auth_code=$uuid;
        $time =time();
        $this->create_time=$time;
        $this->update_time=$time;
        if ($this->load($data) && $this->validate()) {
            $this->password=md5($this->password);
            if($this->save(false)){
                return true;
            }
            return false;
        }
        return false;
    }
    public function getSysadmindata(){
        return $this->hasOne(Sysadmindate::className(), ['sys_admin_id' => 'id']);
    }
}
