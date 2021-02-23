<?php

namespace common\models;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;
use frontend\models\Employee;
use common\models\Dimensions;
use common\models\AppraisalPeriod;
/**
 * User model
 *
 * @property integer $id
 * @property string $username
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property string $auth_key
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $password write-only password
 */
class User extends ActiveRecord implements IdentityInterface
{
    const STATUS_DELETED = 0;
    const STATUS_ACTIVE = 1;
    public $password;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return Yii::$app->params['Company'].'User Setup ';
    }

    /**1
     * @inheritdoc
     */
    /*public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }*/

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['status', 'default', 'value' => self::STATUS_ACTIVE],
            ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_DELETED]],
            [['accounttype'],'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne(['User ID' => $id]);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['[User ID]' => $username]);
    }
    public function getModel(){ //finds employee by their email address
        // return $this->{'E-Mail'};
        return static::findOne(['E-Mail' => $this->{'E-Mail'}]);
    }

    /**
     * Finds user by password reset token
     *
     * @param string $token password reset token
     * @return static|null
     */
    public static function findByPasswordResetToken($token)
    {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }

        return static::findOne([
            'password_reset_token' => $token,
            'status' => self::STATUS_ACTIVE,
        ]);
    }

    /**
     * Finds out if password reset token is valid
     *
     * @param string $token password reset token
     * @return bool
     */
    public static function isPasswordResetTokenValid($token)
    {
        if (empty($token)) {
            return false;
        }

        $timestamp = (int)substr($token, strrpos($token, '_') + 1);
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        return $timestamp + $expire >= time();
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    public function getPass()
    {
        return $this->decrypt(Yii::$app->session->get('detail'));

    }

    public function decrypt($c)
    {
        $key = YII::$app->params['key'];
        $c = base64_decode($c);
        $ivlen = openssl_cipher_iv_length($cipher = "AES-128-CBC");
        $iv = substr($c, 0, $ivlen);
        $hmac = substr($c, $ivlen, $sha2len = 32);
        $ciphertext_raw = substr($c, $ivlen + $sha2len);
        $calcmac = hash_hmac('sha256', $ciphertext_raw, $key, $as_binary = true);
        return openssl_decrypt($ciphertext_raw, $cipher, $key, $options = OPENSSL_RAW_DATA, $iv);
    }

    public function getName()
    {

        //Get name

        $employee = Employee::find()
            ->select(['[First Name]', '[Middle Name]', '[Last Name]'])
            ->where(['No_' => $this->{'Employee No_'}])
            ->asArray()
            ->one();
        $name = $employee['First Name'] . " " . $employee['Middle Name'] . " " . $employee['Last Name'];
        return $name;
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return true;//a trick
        return $this->auth_key;
    }

    public function getNo(){
        return $this->{'Employee No_'};
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return true;
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
//    public function setPassword($password)
//    {
//        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
//    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }
    public function getCategory(){
        switch((int)$this->{'Employee_category'}){
            case 1;
                return 'Head of Department';
                break;
            case 2;
                return 'Support Staff';
                break;
            case 3;
                return 'Management Staff';
                break;
            case 4;
                return 'HOD - Probation';
                break;
            default;
                return 'Management - Probation';
        }
    }
    public function getCat(){
        return (int) $this->{'Employee_category'};
    }
    public function getAccounttype()
    {
        return (int) $this->{'Account Type'};
    }
    public function getAccountstatus(){
        return (int) $this->{'Account Status'};
    }
    public function getSupervisor(){
        //if($this->getAccounttype() == 4){//APPRAISEE
            $supervisor = $this->{'Immediate Supervisor'};
            $sdetails = $this::findOne(['User ID'=>$supervisor]);

            $employee = Employee::find()
                ->select(['[No_]','[First Name]', '[Middle Name]', '[Last Name]'])
                ->where(['No_' => $sdetails->{'Employee No_'}])
                ->asArray()
                ->one();
            $sname = $employee['First Name'] . " " . $employee['Middle Name'] . " " . $employee['Last Name'];
       // }
        /*else if($this->getAccounttype() == 1 || $this->getAccounttype() == 3){//HR & MGT
            $sname = $this->getName();
        }*/
        return $sname;//E04356
    }
    public function getEmploymentdate(){
        $joined = Employee::find()->select(['[Employment Date]'])->where(['No_'=>$this->No])->one();
        return $joined->{'Employment Date'};
    }
    public function getJoiningmonth(){// to allow evaluations for thos who joined on or before Jul-01
        $str = strtotime($this->employmentdate);
        $month = date('m-d-Y',$str);
        return $month;
    }
    public function getHrpostinggroup(){
        $pgrp = Employee::find()->select(['[Posting Group]'])->where(['No_'=>$this->No])->one();
        return $pgrp->{'Posting Group'};
    }
    public function getSupervisorno(){
        $supervisor = $this->{'Immediate Supervisor'};//gives the AD user id
        $sdetails = $this::findOne(['User ID'=>$supervisor]);

        $employee = Employee::find()
            ->select(['[No_]'])
            ->where(['No_' => $sdetails->{'Employee No_'}])
            ->asArray()
            ->one();
        $no = $employee['No_'];
        return $no;
    }
    public function getSupervisoremail(){
        $email = self::find()->select('[E-Mail]')->where(['[Employee No_]'=>$this->getSupervisorno()])->one();
        return $email->{'E-Mail'};
    }
    /**
     * @return string
     */
    public function getJob()
    {
        $employee = Employee::find()
            ->select(['[Job Title]'])
            ->where(['No_' => $this->getNo()])
            ->one();
        return $employee->{'Job Title'};
    }
    public function getLevel()//JOb level
    {
        $employee = Employee::find()
            ->select(['[Level]'])
            ->where(['No_' => $this->getNo()])
            ->one();
        return $employee->{'Level'};
    }
    public function getDetails(){
        $employee = Employee::find()
            ->select(['*'])
            ->where(['No_' => $this->getNo()])
            ->one();
        return $employee;
    }
    public function getDirectoratecode(){
        $employee = Employee::find()->select(['[Global Dimension 1 Code]'])->where(['No_' => $this->getNo()])
            ->one();
            if(!empty($employee->{'Global Dimension 1 Code'})){
                return $employee->{'Global Dimension 1 Code'};
            }else{
                return 'Not Set';
            }
    }
    public function getDepartment(){
        /*$employee = Employee::find()
            ->select(['[Department Name]'])
            ->where(['No_' => $this->getNo()])
            ->one();*/

            $employee = Employee::find()->select(['[Global Dimension 1 Code]'])->where(['No_' => $this->getNo()])
            ->one();

            /*print '<pre>';
            print_r($employee); exit;*/

            if(!empty($employee->{'Global Dimension 1 Code'})){
                 $dimvalue = $employee->{'Global Dimension 1 Code'}; 
            
                //Get description of global dimension values

                $department = Dimensions::find()->select(['Name'])->where(['Code' =>$dimvalue])->one(); 

                return $department->{'Name'};
            }else{
                return 'Directorate Not Set';
            }
           


        //return $employee->{'Global Dimension 1 Code'};
    }
    public function getDepartmentid(){
        $department = Dimensions::find()->select(['Code'])->where(['like','Name',$this->department])->one();

        if(is_object($department)){
            return $department->Code;
        }else{
            return Null;
        }
    }
    public function  getAppraisees(){
        $appraisees = NULL;
        if($this->getAccounttype() == 3){//Supervisor
           // exit('Emp no:'.\Yii::$app->user->Identity->No);
            //get employees with submited workplans
            $workplancodes = [];
            $workplans = Workplans::find()
            ->where(['immediate_supervisor'=>$this->getNo()])
            ->where(['appraisal_period_id'=>Yii::$app->session->get('AppraisalPeriod')])
            ->asArray()->all();

            /*foreach($workplans as $w){
                $workplancodes[] = $w->appraisal_code;
            }
            $appraisees = self::find()->select(['[User ID],[E-Mail],[Employee No_],[Immediate Supervisor],[Account Type],[Account Status]'])
                ->where(['[Immediate Supervisor]' => $this->getId(),'[Employee No_]'=>$workplancodes])->all();*/
        }
		else if($this->getAccounttype() == 5 ){//HR staff - can see all workplan
			 $workplancodes = [];
            $workplans = Workplans::find()->asArray()->all();
            /*foreach($workplans as $w){
                $workplancodes[] = $w->appraisal_code;
            }
            $appraisees = self::find()->select(['[User ID],[E-Mail],[Employee No_],[Immediate Supervisor],[Account Type],[Account Status]'])
                ->where(['[Employee No_]'=>$workplancodes])->all();*/
		}
        return $workplans;//$appraisees;
    }
    //Get appraisees info methods since the employee join failed
    public function getappraiseenames($employee_number){//get appraisee name given their number
        $employee = Employee::find()
            ->select(['[First Name]', '[Middle Name]', '[Last Name]'])
            ->where(['No_' => $employee_number])
            ->asArray()
            ->one();
        $sname = $employee['First Name'] . " " . $employee['Middle Name'] . " " . $employee['Last Name'];
        return $sname;
    }
    public function getappraiseemail($employee_number){ //get appraisee email address
        $email = self::find()->select('[E-Mail]')->where(['[Employee No_]'=>$employee_number])->one();
        return $email->{'E-Mail'};
    }
    public function getEmail(){//email of currently logged on user/ self email
        return $this->{'E-Mail'};
    }
    public function getAppraisalperiodcode($period_id){
        $period = AppraisalPeriod::find()->where(['id'=>$period_id])->one();
        return $period->period_code;
    }
    public function getEmployee(){//relationship not working, shit!
        return $this->hasOne(Employee::className(),['No_'=>'Employee No_']);
    }
    public function getAppraiseesignature(){
        $n = \Yii::$app->request->get('wpCode');
        $employee = (object)[];
        //return $n;
        /*$employee = Employee::find()
            ->select(['[Signature]'])
            ->where(['No_' => $n ])
            ->one();*/
        //$signature = $employee->{'Signature'};


        if(property_exists($employee, 'Signature')){
            return $employee->{'Signature'};
        }else{
            return null;
        }

        
    }
    public function getSupervisorsignature(){
        if($this->getAccounttype() == 2){//You are the appraisee
            $supervisor = $this->getSupervisorno();
        }
        else{//you are the supervisor or HR
            $supervisor = $this->getNo();
        }
         $employee = (object)[];
        /*$employee = Employee::find()
            ->select(['[Signature]'])
            ->where(['No_' => $supervisor])
            ->one();*/
         if(property_exists($employee, 'Signature')){
            return $employee->{'Signature'};
        }else{
            return null;
        }
    }
    public function getNumber(){
        $number = \Yii::$app->request->get('wpCode');
        return $number;
    }
    public static function getDb()
    {
        return Yii::$app->get('db_nav');
    }

}
