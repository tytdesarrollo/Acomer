<?php

namespace app\models;

class User extends \yii\base\Object implements \yii\web\IdentityInterface
{
    public $id;
    public $usuario;
    public $clave;
    public $authKey;
    public $accessToken;

    private static $users = [
        '100' => [
            'id' => '100',
            'usuario' => 'admin',
            'clave' => 'admin',
            'authKey' => 'test100key',
            'accessToken' => '100-token',
        ],
        '101' => [
            'id' => '101',
            'usuario' => 'demo',
            'clave' => 'demo',
            'authKey' => 'test101key',
            'accessToken' => '101-token',
        ],
    ];


    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return isset(self::$users[$id]) ? new static(self::$users[$id]) : null;
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        foreach (self::$users as $user) {
            if ($user['accessToken'] === $token) {
                return new static($user);
            }
        }

        return null;
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($usuario)
    {
        foreach (self::$users as $user) {
            if (strcasecmp($user['usuario'], $usuario) === 0) {
                return new static($user);
            }
        }

        return null;
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->authKey;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($clave)
    {
        return $this->clave === $clave;
    }
}

/*
<?php

namespace app\models;

use Yii;
use yii\base\Model;


class User extends Model
{
    public $usuario;
    public $clave;
	
	 function ValidarUsuario($usuario,$clave){ 

    			$users = Yii::$app->confidencial->createCommand("SELECT CEDULA AS CEDULA FROM EMPLEADOS_BASIC WHERE ESTADO = 'A' AND CEDULA = '14320786'")->queryAll();
				

				
	 }
	 
	
}

*/


