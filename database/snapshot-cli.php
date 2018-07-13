<?php
$MYSQL_DUMP = "mysqldump --user=root --password=root --host=localhost homestead";

date_default_timezone_set("Europe/Paris");

$dumpname = "snapshot_" . Date("YmdHis") . ".sql";
exec("$MYSQL_DUMP > /tmp/backups/$dumpname");

?>