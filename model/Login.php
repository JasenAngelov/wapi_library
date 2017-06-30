<?php

/*
 * Клас за съхранение на данни за профила клиента.
 */


class Login implements JsonSerializable {
	private $user_id;
	private $first_name;
	private $last_name;
	private $max_offset;
	public function __construct(array $user_info, $number_of_books) {
		$this->user_id = $user_info ['user_id'];
		$this->first_name = $user_info ['F_name'];
		$this->last_name = $user_info ['L_name'];
		$this->max_offset = intval ( ceil ( $number_of_books / 6 ), 10 );
		;
	}
	public function jsonSerialize() {
		return get_object_vars ( $this );
	}
	public function __get($prop) {
		return $this->$prop;
	}
}

