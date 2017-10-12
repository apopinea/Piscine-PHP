<?php
$_db_path = "DB/";
$_db_items = "db_items.json";
require_once('../parts/header.php');
require_once('../parts/left-side.php');
require_once('../parts/central-global-view.php');
require_once('../parts/right-side.php');
require_once('../parts/footer.php');

/*   EXEMPLE : DELETE ELEMENT FROM ITEM DATABASE
$arr = json_decode(file_get_contents($_db_path.$_db_items), TRUE);

print_r($arr);
$index = array_search("electronics", array_column($arr, 'categorie'));
echo " index : ".$index.PHP_EOL;
unset($arr[$index]);
print_r($arr);
*/

 ?>
