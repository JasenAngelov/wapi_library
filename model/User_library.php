<?php
class User_library implements JsonSerializable {
	private $isbn;
	private $title;
	private $description;
	private $published_date;
	private $cover;
	private $location_url;
	private $pages;
	private $autor_Fname;	
	private $autor_Lname;
	public function __construct(array $user_book) {
		foreach ( $user_book as $key => $value ) {
			$this->$key = $value;
		}
	}
	public function __get($name) {
		return $this->$name;
	}
	public function jsonSerialize() {
		return get_object_vars ( $this );
	}
}



?>
