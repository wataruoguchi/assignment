<?php
require_once("./lib/vendor/htmlpurifier/HTMLPurifier.standalone.php");
$purifier = new HTMLPurifier();

include ("./includes/ExecDB.php");
$exec = new ExecDB();

switch ($_SERVER['REQUEST_METHOD']) {
	case 'GET':
		// SELECT
		$sql = "SELECT name, notes, created, active FROM tasks WHERE active = true ORDER BY created DESC; ";
		echo $exec->select($sql);
		break;

  case 'POST':
  // INSERT
    $in = json_decode(file_get_contents('php://input'), true);
    $name = $purifier->purify(addslashes($in['name']));
		$notes = $purifier->purify(addslashes($in['notes']));
		$created = $purifier->purify(addslashes($in['created']));
		$sql = "INSERT INTO tasks (`name`,`notes`,`created`) VALUES ('".$name."','".$notes."','".$created."');";
		$exec->insert($sql);
		break;

  case 'PUT':
		// UPDATE
    $in = json_decode(file_get_contents('php://input'), true);
    $id = $purifier->purify(addslashes($in['id']));
    $name = $purifier->purify(addslashes($in['name']));
		$notes = $purifier->purify(addslashes($in['notes']));
		$modified = $purifier->purify(addslashes($in['modified']));
    echo "<script>console.log('".$name."');</script>";
		$sql = "UPDATE tasks SET name='".$name."', notes='".$notes."', modified='".$modified."' WHERE id='".$id."';";
		$exec->update($sql);
		break;

  case 'DELETE':
		// DELETE
    $id = $purifier->purify(addslashes($_GET['id']));
    echo "<script>console.log('".$name."');</script>";
		$sql = "DELETE FROM tasks WHERE id='".$id."';";
		break;
}
?>
