<?php

/*

 Sample SQLicity connection file

Note: if this file is present next to sqlicity.php,
 it means you will AUTOMATICALLY be logged in using these credentials
 for test sites or sites already behind http basic auth,
 this is sufficient for my needs. Obviously,
 if you are doing anything more important that demands
 real security, do NOT use this file!
 But, often, when building a preliminary version of a site,
 I want expediency over security.

Be conscious of the risks you take.  They are everywhere.

*/


# mysql -u user -ppassword thedbname -e "SELECT UNIX_TIMESTAMP();"

$mysql_server_name = 'localhost';

$sqlicity_username = 'user';
$sqlicity_password = 'password';

// or leave this blank and it will list all dbs on the server,
//  whether the above user has access rights to those dbs or not!
$mysql_dbs = array(
 'thedbname',
// 'otherdbname',
// 'etcetc',
);

?>
