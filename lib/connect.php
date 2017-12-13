<?PHP
include_once('pdo/class.sys.pdowrapper.php');
$config = array("host"=>"",
    "dbname"=>'',
    "username"=>'',
    "password"=>'');
$db = new PdoWrapper($config);
$db->setErrorLog(true);
?>
