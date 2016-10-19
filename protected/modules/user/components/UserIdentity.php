<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity {

	private $_id;
	//private $_isAdmin;

	/**
	 * Authenticates a user.
	 * @return boolean whether authentication succeeds.
	 */
	public function authenticate() {
        if (strpos($this->username,"@")) {
			$user=User::model()->notsafe()->findByAttributes(array('email'=>$this->username));
		} else {
			$user=User::model()->notsafe()->findByAttributes(array('username'=>$this->username));
		}
        if ($user === null){
				$this->errorCode = self::ERROR_USERNAME_INVALID;
            return 0;
        }
		if (!$user->validatePassword($this->password)){
			$this->errorCode = self::ERROR_PASSWORD_INVALID;
			return 0;
		}
		elseif (!$user->status) {
            Yii::app()->user->setFlash('warning',Yii::t('common', 'Your account not active. The reasons: you not followed the link in the letter which has been sent at registration. Or administrator deactivate your account'));
			return 0;
		}
		else {
			$this->_id = $user->id;
			if($user->superuser == 1)
				$this->setState('isAdmin', $user->superuser);
			elseif($user->superuser == 2)
				$this->setState('isEditor', 1);

			$this->username = $user->username;

			$this->setState('email', $user->email);
			$this->setState('type', $user->type);
			$this->setState('username', $user->username);
			$this->setState('phone', $user->phone);
			$this->errorCode = self::ERROR_NONE;
		}
		return $this->errorCode == self::ERROR_NONE;
	}

	/**
	 * @return integer the ID of the user record
	 */
	public function getId() {
		return $this->_id;
	}

	/*public function isAdmin() {
		return $this->_isAdmin;
	}*/

	public function setId($id) {
		$this->setState('id', $id);
	}

}
