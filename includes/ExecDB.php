<?php 
/**
* execute SQL query
*/
include ("myDBfunc.php");

class ExecDB
{
	private $myDB;

	public function __construct()
	{
		$this->myDB = new myDBfunc();
	}

	//Execute select query
	public function select($sql)
	{
		$result = $this->myDB->query($sql);
		$arrayResult = array();
		if($result == FALSE) {
		}
		else {
			while ($row=mysqli_fetch_array($result)) {
				$arrayResult[]=$row;
			}
		}
		return $json_response=json_encode($arrayResult);
	}

	//Execute insert query
	public function insert($sql)
	{
		$result = $this->myDB->query($sql);
		if($result) {
			$result = TRUE;
		} else {
			$result = FALSE;
		}
		return $result;
	}

	//Execute update query
	public function update($sql, $decodedInput)
	{
		$result = $this->myDB->query($sql);
		if($result) {
			$result = TRUE;
		} else {
			$result = FALSE;
		}
		return $result;
	}

	//Execute delete query
	public function delete($sql)
	{
		$result = $this->myDB->query($sql);
		if($result) {
			$result = TRUE;
		} else {
			$result = FALSE;
		}
		return $result;
	}
}
?>