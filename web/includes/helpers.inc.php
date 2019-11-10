<?php  
require_once 'config.inc.php';
function check_duplicate($table, $column, $data){

	$sql = "SELECT $column FROM $table WHERE $column = '$data'";

	$result = execute_select($sql);

	if ($result) {
		return true;
	}return false;
}

function check_duplicate_mail($table, $column1, $column2, $column3, $column4, $column5, $data1, $data2, $data3, $data4, $data5){

	$sql = "SELECT * FROM $table WHERE $column1 = '$data1' and $column2 = '$data2' and $column3 = '$data3' and $column4 = '$data4' and $column5 = '$data5'";

	$result = execute_select($sql);

	if ($result) {
		return true;
	}return false;
}

function redirect_to($url){
	// $url = urlencode($url);
	// header("Location: $url");
	// exit();

	echo '<script language="javascript">window.location.href="'.$url.'"</script>';
}

function format_date($date){
	$dateTimeArr = explode(' ', $date);
	$date = $dateTimeArr[0];
	$time = $dateTimeArr[1];
	$formattedDate = date('D-M-Y', strtotime($date));
	$formattedTime = date('Gi.s', strtotime($time));
	return $formattedDate;
}

function fetch_column2($column, $table, $column1, $value){
	$sql = "SELECT * FROM $table WHERE $column1 = '$value'  ORDER BY classroom_name ASC";

	$result = execute_select($sql);
	if ($result) {
		return $result;
	} return false;
}

function fetch_column3($table, $Order){
	$sql = "SELECT * FROM $table ORDER BY $Order ASC";

	$result = execute_select($sql);
	if ($result) {
		return $result;
	} return false;
}

function fetch_column11($table, $table2, $Order){
	$sql = "SELECT $table.*, $table2.* FROM $table INNER JOIN $table2 ON $table.user_id = $table2.id ORDER BY $Order ASC";

	$result = execute_select($sql);
	if ($result) {
		return $result;
	} return false;
}

function fetch_column12($table, $table2, $column, $offset, $limit){
	$sql = "SELECT $table.*, $table2.* FROM $table INNER JOIN $table2 ON $table.user_id = $table2.id ORDER BY $column DESC LIMIT $offset, $limit ";

	$result = execute_select($sql);
	if ($result) {
		return $result;
	} return false;
}

function fetch_column13($table, $column, $offset, $limit){
	$sql = "SELECT * FROM $table ORDER BY $column DESC LIMIT $offset, $limit ";

	$result = execute_select($sql);
	if ($result) {
		return $result;
	} return false;
}

function fetch_column4($table, $Order, $offset, $limit){
	$sql = "SELECT * FROM $table ORDER BY $Order DESC LIMIT $limit OFFSET $offset";
	
		$result = execute_select($sql);
		if ($result) {
			return $result;
		} return false;
}

function fetch_column7($table){
	$sql = "SELECT * FROM $table";

	$result = execute_select($sql);
	if ($result) {
		return $result;
	} return false;
}

function fetch_column5($table, $column, $event_id){
	$sql = "SELECT * FROM $table WHERE $column = $event_id";
	
		$result = execute_select($sql);
		if ($result) {
			return $result;
		} return false;
}

function get_email_template($file_path, $name, $email, $category, $token){
	$body = file_get_contents($file_path);
	$body = str_replace('#firstname#', $name, $body);
	$body = str_replace("#email#", $email, $body);
	$body = str_replace("#category#", $category, $body);
	$body = str_replace("#token#", $token, $body);
	return $body;
}

function get_email_template2($file_path, $name, $email, $subject, $Message){
	$body = file_get_contents($file_path);
	$body = str_replace('#Name#', $name, $body);
	$body = str_replace("#Email#", $email, $body);
	$body = str_replace("#Subject#", $subject, $body);
	$body = str_replace("#Message#", $Message, $body);
	return $body;
}

function get_email_template3($file_path, $email, $subject){
	$body = file_get_contents($file_path);
	$body = str_replace("#Email#", $email, $body);
	$body = str_replace("#Subject#", $subject, $body);
	return $body;
}

function get_email_template4($file_path, $name, $email, $token, $category){
	$body = file_get_contents($file_path);
	$body = str_replace('#logger#', $name, $body);
	$body = str_replace("#email#", $email, $body);
	$body = str_replace("#token#", $token, $body);
	$body = str_replace("#category#", $category, $body);
	return $body;
}

function save_token($email, $token){
	global $conn;
	$sql = "INSERT INTO  reg_confirm (token, email) VALUES ('$token', '$email')";
	$query = mysqli_query($conn, $sql);
	if ($query) {
	return true;
	}return false;
}

function save_token2($email, $token){
	global $conn;

	if (!check_duplicate('psw_confirm', 'email', $email)) {

		$sql = "INSERT INTO  psw_confirm (token, email) VALUES ('$token', '$email')";
		$result = execute_iud($sql);
		if($result){
			return true;
		}else {
			$errors['token'] = 'token not sucessfully inserted.';
		}
		
	} else {
		$sql = "UPDATE  psw_confirm SET token = '$token' WHERE email = '$email'";
		$result = execute_iud($sql);
		if($result){
			return true;
		}else {
			$errors['token'] = 'token not sucessfully inserted.';
		}
	
	}return $errors;
}



