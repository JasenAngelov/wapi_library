<?php

/* 
 	Клас за обработка на грешки.
	Използваме го при проверката на файлове, вписване на клиент и др.
 */

class AutorizationException extends Exception {
	public function __construct($message, $code = 0) {
		parent::__construct ( $message, $code );
	}
	public function __toString() {
		return __CLASS__ . ": [{$this->code}]: {$this->message}\n";
	}
}