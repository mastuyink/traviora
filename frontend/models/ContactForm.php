<?php

namespace frontend\models;

use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class ContactForm extends Model
{
    public $name;
    public $email;
    public $subject;
    public $body;
    public $verifyCode;
    public $link;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            // name, email, subject and body are required
            [['name', 'email', 'subject', 'body'], 'required'],
            // email has to be a valid email address
            ['email', 'email'],
            // verifyCode needs to be entered correctly
            ['verifyCode', 'captcha'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'verifyCode' => 'Verification Code',
        ];
    }

    /**
     * Sends an email to the specified email address using the information collected by this model.
     *
     * @param string $email the target email address
     * @return bool whether the email was sent
     */
    public function sendEmail($email)
    {
        if ($this->link == null) {
            Yii::$app->mailClient->compose()->setFrom($this->email)
            ->setTo('aziest99@gmail.com')
            ->setSubject($this->subject)
            ->setHtmlBody("<br>Perihal <a href=".$this->link.">Berikut</a><br>Nama Pengirim = ".$this->name."<br>".$this->body)->send();
            return true;
        }else{Yii::$app->mailClient->compose()->setFrom($this->email)
            ->setTo('aziest99@gmail.com')
            ->setSubject($this->subject)
            ->setHtmlBody("Nama Pengirim = ".$this->name."<br>".$this->body)->send();
            return true;
        }
    }
}
