<?php 
class Helper {
	public static $bn = array("১", "২", "৩", "৪", "৫", "৬", "৭", "৮", "৯", "০");
	public static $en = array("1", "2", "3", "4", "5", "6", "7", "8", "9", "0");
	public $magic_quotes_active;
	public $real_escape_string;
	function __construct () {
		$this->magic_quotes_active = get_magic_quotes_gpc();
		$this->real_escape_string = function_exists( "mysql_real_escape_string" );
	}
	public static function redirect_to($location) {
		header("location:".$location);
		exit;
	}

	public function escape_value( $value ) {
		if( $this->$real_escape_string ) {
			if( $this->$magic_quotes_active ) { $value = stripslashes( $value ); }
			$value = mysqli_real_escape_string($link, $value  );
		} else { 
			if( !$this->$magic_quotes_active ) { $value = addslashes( $value ); }
		}
		return htmlentities($value);
	}



	public static function message($messages) {
		if(!empty($messages)) {
			if(is_array($messages)) { 
				echo "<div class=\"alert alert-danger\">";
					 foreach ($messages as $message) {
						echo "<span class=\"glyphicon glyphicon-thumbs-down\"></span> $message";
					} 
				echo "</div>";
			 } else { 
				echo "<div class=\"alert alert-success\">";			
						 echo "<span class=\"glyphicon glyphicon-thumbs-up\"></span> $messages"; 				
				echo "</div>";
			 }
		}
	}

	public static function bn2en($number) {
        return str_replace(self::$bn, self::$en, $number);
    }
    
    public static function en2bn($number) {
        return str_replace(self::$en, self::$bn, $number);
    }
}

$Helper = new Helper();


 ?>