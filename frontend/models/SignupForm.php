<?php
namespace frontend\models;

use common\models\User;
use yii\base\Model;
use Yii;

//For Game creation.
use app\models\Game;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $username;
    public $email;
    public $password;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['username', 'filter', 'filter' => 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This email address has already been taken.'],

            ['password', 'required'],
            ['password', 'string', 'min' => 6],
        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }
        
        $user = new User();
        $user->username = $this->username;
        $user->email = $this->email;
        $user->setPassword($this->password);
        $user->generateAuthKey();
        
        if($user->save())
        {
            //Create new game for this user.
            $game = new Game();
            $date = new \DateTime();
            $game->user = $user->id;
            $game->created_at = $date->getTimestamp();
            $game->updated_at = $game->created_at;
            $game->points = 0;
            $game->lastIncrease = 0;
            $game->save();
            return $user;
        }
        else
            return null;
    }
}
