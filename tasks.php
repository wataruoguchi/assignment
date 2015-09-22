<?php
require_once("./lib/vendor/htmlpurifier/HTMLPurifier.standalone.php");
$purifier = new HTMLPurifier();

include ("./includes/ExecDB.php");
$exec = new ExecDB();

switch ($_SERVER['REQUEST_METHOD']) {
	case 'GET':
		// SELECT
		$sql = "SELECT * FROM tasks WHERE active = true ORDER BY created ASC; ";
		echo $exec->select($sql);
		break;

  case 'POST':
    $in = json_decode(file_get_contents('php://input'), true);
    if(!isset($in['id'])) {
      // INSERT
      $name = $purifier->purify(addslashes($in['name']));
  		$notes = $purifier->purify(addslashes($in['notes']));
  		$created = $purifier->purify(addslashes($in['created']));
  		$sql = "INSERT INTO tasks (`name`,`notes`,`created`) VALUES ('".$name."','".$notes."','".$created."');";
  		$exec->insert($sql);
    } else {
      // UPDATE
      $id = $purifier->purify(addslashes($in['id']));
      $name = $purifier->purify(addslashes($in['name']));
  		$notes = $purifier->purify(addslashes($in['notes']));
      echo "<script>console.log('".$name."');</script>";
  		$sql = "UPDATE tasks SET name='".$name."', notes='".$notes."', modified=NOW() WHERE id='".$id."';";
  		$exec->update($sql);
    }
		break;

  case 'DELETE':
		// DELETE
    $id = $purifier->purify(addslashes($_GET['id']));
    $sql = "UPDATE tasks SET active='0' WHERE id='".$id."';";
    $exec->update($sql);
		break;
}
?>
