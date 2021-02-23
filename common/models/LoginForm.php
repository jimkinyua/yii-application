<?php
namespace common\models;

use Yii;
use yii\base\Model;

/**
 * Login form
 */
class LoginForm extends Model
{
    public $username;//user name
    public $password;//employee number
    public $rememberMe = true;

    private $_user;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['username', 'password'], 'required'],
            // rememberMe must be a boolean value
            ['rememberMe', 'boolean'],
            // password is validated by validatePassword()
            ['password', 'validatePassword'],
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();
            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, 'Incorrect username or password.');
            }
        }
    }

    /**
     * Logs in a user using the provided username and password.
     *
     * @return bool whether the user is logged in successfully
     */
    public function login()
    {
        if ($this->validate()) {
            return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600 * 24 * 30 : 0);
        }

        return false;
    }

    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    protected function getUser()
    {
        /*if ($this->_user === null) {
            $this->_user = User::findByUsername($this->username);
        }

        return $this->_user;*/
        $ADLogin = $this->loginToAD($this->username, $this->password);
        $this->_user = false;
        if($ADLogin){
            if($ADLogin == 'wrong username/password'){
                $this->_user = false;
            }
            else{

                $ldaprdn = Yii::$app->params['domnainPrefix'] . "\\" . strtoupper($this->username);
                //print_r($ldaprdn);
                $this->_user = User::findIdentity($ldaprdn);
                Yii::$app->session->set('detail',$this->encrypt($this->password));
//
            }
        }
//        ($this->_user);exit;
        return $this->_user;
    }
    protected function loginToAD($username, $password){
        $me=['ye'=>'ds'];
        return $me;
        $adServer = "ldap://ERC-SVRV7.erc.go.ke";
        $ldap = ldap_connect($adServer);//connect

        $ldaprdn = 'erc' . "\\" . $username;//put the username in a way specific to the domain

        ldap_set_option($ldap, LDAP_OPT_PROTOCOL_VERSION, 3);
        ldap_set_option($ldap, LDAP_OPT_REFERRALS, 0);
        $bind = @ldap_bind($ldap, $ldaprdn, $password);

        if ($bind) {
            $filter="(sAMAccountName=$username)";
            $result = ldap_search($ldap,"dc=erc,dc=go, DC=ke",$filter);
            //ldap_sort($ldap,$result,"sn");
            $info = ldap_get_entries($ldap, $result);
            //print_r($info);exit;
            for ($i=0; $i<$info["count"]; $i++)
            {
                if($info['count'] > 1)
                    break;
                return $info[$i];
            }
            @ldap_close($ldap);
        } else {
            //notify incorrect login
            return 'wrong username/password';
        }
        return null;
    }
    private function encrypt($detail)
    {
        $ivlen = openssl_cipher_iv_length($cipher="AES-128-CBC");
        $key=YII::$app->params['key'];
        $iv = openssl_random_pseudo_bytes($ivlen);
        $ciphertext_raw = openssl_encrypt($detail, $cipher, $key, $options=OPENSSL_RAW_DATA, $iv);
        $hmac = hash_hmac('sha256', $ciphertext_raw, $key, $as_binary=true);
        return base64_encode( $iv.$hmac.$ciphertext_raw );
    }
}
