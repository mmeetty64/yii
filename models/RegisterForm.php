<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class RegisterForm extends Model
{
    public $fio;
    public $login;
    public $email;
    public $phone;
    public $password;
    public $password_repeat;
    public $check;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['fio', 'login', 'email', 'password', 'phone'], 'required'],
            [['fio', 'login', 'email', 'password', 'phone'], 'string', 'max' => 255],
            ['fio', 'match', 'pattern' => '/^[а-яёА-ЯЁ\s\-]*$/u'],
            ['login', 'match', 'pattern' => '/^[a-zA-Z\d\-]*$/i'],
            ['email', 'email'],
            ['email', 'unique', 'targetClass' => User::class],
            ['phone', 'match', 'pattern' => '/^\+7\(\d{3}\)\-\d{3}\-\d{2}\-\d{2}$/i'],
            ['password', 'match', 'pattern' => '/^[a-zA-Z\d\-]*$/i'],
            ['password', 'string', 'min' => 8],
            ['password_repeat', 'compare', 'compareAttribute' => 'password'],
            ['check', 'required', 'requiredValue' => 1]
        ];
    }

    /**
     * @return array customized attribute labels
     */
    public function attributeLabels()
    {
        return [
            'fio' => 'ФИО',
            'login' => 'Логин',
            'email' => 'Email',
            'password' => 'Пароль',
            'password_repeat' => 'Повтор пароля',
            'phone' => 'Телефон',
            'check' => 'Согласие на обработку персональных данных'
        ];
    }
    public function register()
    {
        if ($this->validate()) {
            $user = new User();

            $user->attributes = $this->attributes;
            $user->password = Yii::$app->security->generatePasswordHash($this->password);
            $user->authKey = Yii::$app->security->generateRandomString();
            $user->role_id = Role::getRoleId('User');

            if(!$user->save()){
                Yii::$app->session->setFlash('danger', 'Произошла ошибка, попробуйте еще раз!');
            }
        }
        return $user ?? false;
    }
}
