<?php

/* Пользователь */
class User
{
	public $id;
	public $username;
	public $password;
	public $email;
	public $email_confirmed;
	public $registration_time;
	public $level;
	public $timezone;
	public $birthday;
	public $description;

	/* Конструктор класса по ID пользователя */
	function __construct($id) {
		global $db, $listMessages;

		$query = 'SELECT * FROM achi_users WHERE id=' . $id;
		if ($data = $db->query($query)->fetch_assoc()) {
			$this->id                = $data['id'];
			$this->username          = $data['username'];
			$this->password          = $data['password'];
			$this->email             = $data['email'];
			$this->email_confirmed   = $data['email_confirmed'];
			$this->registration_time = $data['registration_time'];
			$this->level             = $data['level'];
			$this->timezone          = $data['timezone'];
			$this->birthday          = $data['birthday'];
			$this->description       = $data['description'];
		}
	}

	/**
	 * Регистрация пользователя на сайте
	 * @param string $email Почтовый ящик пользователя
	 * @param string $password Пароль пользователя
	 * @return bool Регистрация успешна или нет
	 */
	public static function register($email, $password) {
		global $db, $listMessages;

		if (strlen($email) > 50 || !preg_match("|^[-0-9a-z_\.]+@[-0-9a-z_^\.]+\.[a-z]{2,6}$|i", $email)) {
			$listMessages[] = array(
				'type' => 'error',
				'description' => 'Пожалуйста, введите корректный E-mail.'
			);
			return false;
		}
		if (strlen($password) < 6) {
			$listMessages[] = array(
				'type' => 'error',
				'description' => 'Пароль должен содержать как минимум 6 символов.'
			);
			return false;
		}

		$data = $db->query('SELECT * FROM achi_users WHERE email = "' . $email . '"');
		$i = 0;
		while($data->fetch_assoc()) {
			$i++;
		}
		if ($i > 0) {
			$listMessages[] = array(
				'type' => 'error',
				'description' => 'Данный почтовый ящик уже занят. Возможно, вы уже зарегистрировались - попробуйте войти на сайт, или же восстановить пароль, если Вы его забыли.'
			);
			return false;
		}

		$password = password_hash($password, PASSWORD_DEFAULT);
		$query = 'INSERT INTO achi_users (email, password, registration_time) VALUES("' . $email . '", "' . $password . '", "' . date('Y.m.d H:i:s') . '")';
		if ($db->query($query)) {
			$listMessages[] = array(
				'type' => 'success',
				'description' => 'Поздравляем с успешной регистрацией. Добро пожаловать на Achievement.su!'
			);
			return true;
		}
		return false;
	}

	/**
	 * Функция, проверяющая валидность пользователя при входе
	 * @param string $email Электронная почта пользователя
	 * @param string $password Пароль пользователя
	 * @return int ID пользователя при правильных данных, иначе -1
	 */
	public static function isValid($email, $password) {
		global $db, $listMessages;

		$query = 'SELECT id, password FROM achi_users WHERE email = "' . $email . '"';
		if (($data = $db->query($query)->fetch_assoc()) && (password_verify($password, $data['password']))) {
			return $data['id'];
		} else {
			$listMessages[] = array(
				'type' => 'error',
				'description' => 'Введены некорректные данные входа. Повторите попытку.'
			);
			return -1;
		}
	}
}

?>
