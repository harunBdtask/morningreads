<?php 
require_once LIB_PATH.DS.'config.php';
class Content {
	private $db;
	private static $table="content";
	private $extensions = array("jpg","png","bmp","JPG","jpeg");
	public $id;
	public $title;

	public $file;
	public $temp_path;
	public $size;
	public $type;
	public $width;
	public $height;
	public $directory = "images";
	public $destroy;

	public $per_page = 10;
	public $offset;

	public $find;

	public $errors = array();
	private $upload_errors = array(
		UPLOAD_ERR_OK       => "",
		UPLOAD_ERR_INI_SIZE => "Larger than upload_max_file size.",
		UPLOAD_ERR_FORM_SIZE => "please upload image smaller than 100 kb.",
		UPLOAD_ERR_PARTIAL => "partial upload.",
		UPLOAD_ERR_NO_FILE => "please select a file.",
		UPLOAD_ERR_NO_TMP_DIR => "No temporary directory.",
		UPLOAD_ERR_CANT_WRITE => "Cant write to disk.",
		UPLOAD_ERR_EXTENSION => "File upload stoped by extension."
	  );

	function __construct() {
		try {
			$this->db = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME,DB_USER,DB_PASSWORD);
			$this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$query1 = $this->db->prepare('SET CHARACTER SET utf8');
			$query = $this->db->prepare("SET SESSION collation_connection ='utf8_general_ci'");
		    $query1->execute();
		    $query->execute();
		} catch (PDOException $e) {
			echo $e->getMessage();
		}
	}

	public function db_fields() {
		try {
			$stmt = $this->db->prepare("SHOW fields from ".self::$table);
			$stmt->execute();
			$fields = array();
			if($stmt->rowCount() > 0) {
				while($row = $stmt->fetch(5)) {	
					$fields[] = $row->Field;

				}
			}
			return $fields;
		} catch (PDOException $e) {
			echo $e->getMessage();
		}
	}

	public function attach($file) {
		if(!$file || !is_array($file) || empty($file)) {
			$this->errors[] = "No file was uploaded";
			return false;
		} else if($file['error'] != 0) {
			$this->errors[] = $this->upload_errors[$file['error']];
			return false;
		} else {
			$this->file = time().basename($file['name']);
			$this->temp_path = $file['tmp_name'];
			$this->type = pathinfo($file['name'],PATHINFO_EXTENSION);
			if($this->type == "jpg" || $this->type == "png" || $this->type == "jpeg") {
				$width_height = getimagesize($file['tmp_name']);
				$this->width = $width_height[0];
				$this->height = $width_height[1];
			}
			$this->size = $file['size'];
			return true;
		}
	}

	public function validate_file() {
		if(!in_array($this->type, $this->extensions)) {
			$this->errors[] = "please upload jpg files";
			return false;
		}

		// optional validation

		// if($this->width > 100) {
		// 	$this->errors[] = "image width must be less then 100";
		// 	return false;
		// }

		// if($this->height > 100) {
		// 	$this->errors[] = "image height must be less then 100";
		// 	return false;
		// }

		if(!empty($this->errors)) { return false; }

		if(empty($this->file) || empty($this->temp_path)) {
			$this->errors[] = "file location was unavailable.";
			return false;
		}

		$target_path = SITE_ROOT.DS.$this->directory.DS.$this->file;

		if(empty($this->errors)) {
			if(move_uploaded_file($this->temp_path, $target_path)) {
				return true;
			} else {
				$this->error[] = "something occured";
				return false;
			}
		} else {
			return false;
		}
	}

	// global helper function

	public function remove_underscore($string) {
		return $removed_string = str_replace("_", " ", $string);
	}

	public function image_path() {
		return $this->directory;
	}

	public function save() {

		foreach ($this->db_fields() as $field) {

			// optional numeric validation

			if($field == "contact_no" && !is_numeric($this->$field) && !empty($this->$field)) {
				$this->errors[] = $this->remove_underscore($field)." must be only number.";
				return false;				
			}

			if($field == "contact_no" && strlen($this->$field) > 11 && !empty($this->$field)) {
				$this->errors[] = $this->remove_underscore($field)." only contain 11 digits.";
				return false;				
			}

			// if($field == "title") {
			// 	if(empty($this->$field)) {					
			// 		$this->errors[] = $this->remove_underscore($field)." is empty.";
			// 		return false;
			// 	}
			// }
		}		
		
		if(isset($this->id)) {	
			if(!empty($this->file)) {
				if($this->validate_file()) {
					$this->update();
					return true;
				}
			} else {
				if(empty($this->errors)) {
					if($this->update()) {
						return true;
					}
				}
			}	
		} else {
			if(!empty($this->file)) {
				if($this->validate_file()) {
					$this->create();
					return true;
				}
			} else {
				if(empty($this->errors)) {
					if($this->create()) {
						return true;
					}
				}
			}	
		}		
	}

	public function prepare($record) {
		$attributes = $this->db_fields();
		foreach ($attributes as $key) {
			if(array_key_exists($key, $record)) {
				$this->$key = $record[$key];
			} 
		}
		return $this;
	}

	public function fetch() {
		try {
			$stmt = $this->db->prepare("SELECT * FROM ".self::$table." where id = :id");
			$stmt->execute(array(":id" => $this->id));
			if($stmt->rowCount() > 0) {
				return $stmt->fetch(5);
			}
		} catch (PDOException $e) {
			echo $e->getMessage();
		}
	}

	public function attributes() {
		$attributes = array();
		foreach ($this->db_fields() as $field) {
			if(property_exists($this, $field)) {
				$attributes[$field] = htmlentities($this->$field);
			}
		}
		return $attributes;
	}

	public function count_all() {
		$stmt = $this->db->prepare("SELECT COUNT(*) as total FROM ".self::$table);
		$stmt->execute();
		return $stmt->fetch(5);
	}

	public function search() {
		try {
			$fields = $this->db_fields();
			$sql = "select * from ".self::$table." where ";
			$count = 0;
			foreach($fields as $field) {
				$count++;
				$val = count($fields);			
				$sql .= $field." like  ?";
				
				if($count != $val) {
					$sql .= " or ";
				}

			}
			
			$stmt = $this->db->prepare($sql);
			$array = array();
			foreach($fields as $field) {
				$array[] = '%'.$this->find.'%';
			}

			$stmt->execute($array);
			$records = array();
			if($stmt->rowCount() > 0) {
				while($row = $stmt->fetch(5)) {
					$records[] = $row;
				}
			}
			return $records;
		} catch (PDOException $e) {
			echo $e->getMessage();
		}
	}

	public function custome_create($title, $des, $create_at, $visits, $category_code, $author_code, $file, $tags) {
	/*	$attributes = $this->attributes();
		array_shift($attributes);   */
		$sql = "insert into ".self::$table."(title, des, create_at, visits, category_id, author_id, file, tags) VALUES('$title', '$des', '$create_at', '$visits', '$category_code', '$author_code', '$file', '$tags')";
    /*  $sql = "insert into ".self::$table."(";
		$sql .= join(',',array_keys($attributes));
		$sql .= ") values (:";
		$sql .= join(',:',array_keys($attributes));
		$sql .= ")";    */
		try {
			$stmt = $this->db->prepare($sql);
			$stmt->execute($attributes);
			return true;
		} catch (PDOException $e) {
			echo $e->getMessage();
		}
	}


	public function create() {
		$attributes = $this->attributes();
		array_shift($attributes);
		$sql = "insert into ".self::$table."(";
		$sql .= join(',',array_keys($attributes));
		$sql .= ") values (:";
		$sql .= join(',:',array_keys($attributes));
		$sql .= ")";
		try {
			$stmt = $this->db->prepare($sql);
			$stmt->execute($attributes);
			return true;
		} catch (PDOException $e) {
			echo $e->getMessage();
		}
	}

	public function read() {
		try {
			$stmt = $this->db->prepare("SELECT * FROM ".self::$table." LIMIT $this->per_page offset $this->offset");
			$stmt->execute();
			$records = array();
			if($stmt->rowCount() > 0) {
				while($row = $stmt->fetch(5)) {
					$records[] = $row;
				}
			}
			return $records;
		} catch (PDOException $e) {
			echo $e->getMessage();
		}
	}

	public function fetch_all() {
		try {
			$stmt = $this->db->prepare("SELECT * FROM ".self::$table);
			$stmt->execute();
			$records = array();
			if($stmt->rowCount() > 0) {
				while($row = $stmt->fetch(5)) {
					$records[] = $row;
				}
			}
			return $records;
		} catch (PDOException $e) {
			echo $e->getMessage();
		}
	}



	public function fetch_contentCategory($author_id) {
		try {
			$stmt = $this->db->prepare("SELECT DISTINCT(content.category_id) AS cat_id, category.title AS category, content.author_id FROM category INNER JOIN content ON category.id = content.category_id WHERE content.author_id = '$author_id' ");
			$stmt->execute();
			$records = array();
			if($stmt->rowCount() > 0) {
				while($row = $stmt->fetch(5)) {
					$records[] = $row;
				}
			}
			return $records;
		} catch (PDOException $e) {
			echo $e->getMessage();
		}
	}





	public function fetch_authorContent($author_id) {
		try {
			$stmt = $this->db->prepare("SELECT COUNT(id) AS total_content, SUM(visits) AS total_visits FROM ".self::$table." WHERE author_id = '$author_id' ");
			$stmt->execute();
			$records = array();
			if($stmt->rowCount() > 0) {
				while($row = $stmt->fetch(5)) {
					$records[] = $row;
				}
			}
			return $records;
		} catch (PDOException $e) {
			echo $e->getMessage();
		}
	}


	public function fetch_byCategory($category_id) {
		try {
			$stmt = $this->db->prepare("SELECT id, SUBSTRING(`title`, 1, 20) AS title, file, SUBSTRING(`des`, 1, 50) AS des, create_at, visits FROM `content` WHERE category_id='$category_id' ORDER BY `content`.`visits`  DESC");
			//$stmt = $this->db->prepare("SELECT * FROM ".self::$table);
			$stmt->execute();
			$records = array();
			if($stmt->rowCount() > 0) {
				while($row = $stmt->fetch(5)) {
					$records[] = $row;
				}
			}
			return $records;
		} catch (PDOException $e) {
			echo $e->getMessage();
		}
	}



	public function fetch_byCategory_authorid($category_id, $author_id) {
		try {
			$stmt = $this->db->prepare("SELECT id, SUBSTRING(`title`, 1, 20) AS title, file, SUBSTRING(`des`, 1, 50) AS des, create_at, visits FROM `content` WHERE category_id='$category_id'AND author_id='$author_id' ORDER BY `content`.`visits`  DESC");
			//$stmt = $this->db->prepare("SELECT * FROM ".self::$table);
			$stmt->execute();
			$records = array();
			if($stmt->rowCount() > 0) {
				while($row = $stmt->fetch(5)) {
					$records[] = $row;
				}
			}
			return $records;
		} catch (PDOException $e) {
			echo $e->getMessage();
		}
	}



	public function fetch_visitCount() {
		try {
			$stmt = $this->db->prepare("SELECT id, SUBSTRING(`title`, 1, 20) AS title, file, SUBSTRING(`des`, 1, 50) AS des, create_at, visits FROM `content` ORDER BY `content`.`visits`  DESC");
			//$stmt = $this->db->prepare("SELECT * FROM ".self::$table);
			$stmt->execute();
			$records = array();
			if($stmt->rowCount() > 0) {
				while($row = $stmt->fetch(5)) {
					$records[] = $row;
				}
			}
			return $records;
		} catch (PDOException $e) {
			echo $e->getMessage();
		}
	}



	public function fetch_visitCount_authorId($author_id) {
		try {
			$stmt = $this->db->prepare("SELECT id, SUBSTRING(`title`, 1, 20) AS title, file, SUBSTRING(`des`, 1, 50) AS des, create_at, visits FROM `content` WHERE author_id = '$author_id' ORDER BY `content`.`visits`  DESC");
			//$stmt = $this->db->prepare("SELECT * FROM ".self::$table);
			$stmt->execute();
			$records = array();
			if($stmt->rowCount() > 0) {
				while($row = $stmt->fetch(5)) {
					$records[] = $row;
				}
			}
			return $records;
		} catch (PDOException $e) {
			echo $e->getMessage();
		}
	}

	public function fetch_substringCategory($category_id) {
		try {
			$stmt = $this->db->prepare("SELECT id, SUBSTRING(`title`, 1, 20) AS title, file, SUBSTRING(`des`, 1, 50) AS des FROM ".self::$table." WHERE category_id = '$category_id' ORDER BY `content`.`create_at` DESC LIMIT 4");
			//$stmt = $this->db->prepare("SELECT * FROM ".self::$table);
			$stmt->execute();
			$records = array();
			if($stmt->rowCount() > 0) {
				while($row = $stmt->fetch(5)) {
					$records[] = $row;
				}
			}
			return $records;
		} catch (PDOException $e) {
			echo $e->getMessage();
		}
	}


	public function fetch_substring() {
		try {
			$stmt = $this->db->prepare("SELECT id, SUBSTRING(`title`, 1, 20) AS title, file, SUBSTRING(`des`, 1, 50) AS des FROM ".self::$table." ORDER BY `content`.`create_at` DESC LIMIT 4");
			//$stmt = $this->db->prepare("SELECT * FROM ".self::$table);
			$stmt->execute();
			$records = array();
			if($stmt->rowCount() > 0) {
				while($row = $stmt->fetch(5)) {
					$records[] = $row;
				}
			}
			return $records;
		} catch (PDOException $e) {
			echo $e->getMessage();
		}
	}


	public function fetch_substringLimit() {
		try {
			$stmt = $this->db->prepare("SELECT id, SUBSTRING(`title`, 1, 50) AS title, file, SUBSTRING(`des`, 1, 100) AS des FROM ".self::$table." ORDER BY `content`.`create_at` DESC LIMIT 1");
			//$stmt = $this->db->prepare("SELECT * FROM ".self::$table);
			$stmt->execute();
			$records = array();
			if($stmt->rowCount() > 0) {
				while($row = $stmt->fetch(5)) {
					$records[] = $row;
				}
			}
			return $records;
		} catch (PDOException $e) {
			echo $e->getMessage();
		}
	}

	public function update() {
		$attributes = $this->attributes();
		
		if(!empty($this->file)) {
			$this->unlink();
		} else {			
			unset($attributes["file"]);			
		}

		$attribute_pairs = array();
		foreach ($attributes as $key => $value) {		
			$attribute_pairs[] = $key."=:".$key;
		}

		$sql = "UPDATE ".self::$table." set ";
		$sql .= join(",", $attribute_pairs);
		$sql .= " where id=:id";
		$attributes['id'] = $this->id;
		try {
			$stmt = $this->db->prepare($sql);
			$stmt->execute($attributes);
			return true;
		} catch (PDOException $e) {
			echo $e->getMessage();
		}
	}


	public function update_count($id) {
		$attributes = $this->attributes();
		
		if(!empty($this->file)) {
			$this->unlink();
		} else {			
			unset($attributes["file"]);			
		}

		$attribute_pairs = array();
		foreach ($attributes as $key => $value) {		
			$attribute_pairs[] = $key."=:".$key;
		}

		$sql = "UPDATE ".self::$table." SET visits = visits+1 WHERE id = '$id' ";
		/*$sql .= join(",", $attribute_pairs);
		$sql .= " where id=:id";
		$attributes['id'] = $this->id;*/
		try {
			$stmt = $this->db->prepare($sql);
			$stmt->execute($attributes);
			return true;
		} catch (PDOException $e) {
			echo $e->getMessage();
		}
	}

	public function get_file() {
		try {
			$stmt = $this->db->prepare("select file from ".self::$table." where id=:id limit 1");
			$stmt->execute(array(":id" => $this->id));
			if($stmt->rowCount() > 0) {
				$file_path = $stmt->fetch(5);
				if($file_path->file) {
					$this->destroy = SITE_ROOT.DS.$this->directory.DS.$file_path->file;
					$this->destroy = str_replace("&amp;", "&", $this->destroy);
				}
			}
		} catch (PDOException $e) {
			echo $e->getMessage();
		}
	}

	private function unlink() {
		if(property_exists($this, 'file')) {
			$this->get_file();
			if(!empty($this->destroy)) {
				unlink($this->destroy);
			}
		}
	}

	public function delete() {
		try {
			if(property_exists($this, 'file')) {
				$this->unlink();
			}
			$stmt = $this->db->prepare("DELETE FROM ".self::$table." where id=:id");
			$stmt->execute(array(":id" => $this->id));
			return true;
		} catch (PDOException $e) {
			echo $e->getMessage();
		}
	}

}

$Content = new Content();

 ?>