<?php
$_db_path = "DB/";
$_db_users = "db_users.json";
$_db_items = "db_items.json";
$_db_cmds = "db_cmds.json";
/* ----------------------------------------------------
*  Database
*   -> create object;
*   -> populate arrays
*   -> save in json format
*  ---------------------------------------------------- */
$users = array();
$items = array();
$cmds = array();
/******************** USERS *****************************/
$user_1 = array(
  'login' => 'toto',
  'forname' => 'tata',
  'name' => 'deschamps',
  'mail' => 'toto@yahoo.fr',
  'tel' => '0654897754',
  'addr' => '21 rue des pompier, 87542 Ducoin, France',
  'last_panier' => '',
  'role' => 'client',
  'pwd' => 'hashed');

$user_2 = array(
  'login' => 'rodo',
  'forname' => 'turil',
  'name' => 'dumoulin',
  'mail' => 'rododo@wahoo.de',
  'tel' => '+330654879538',
  'addr' => '69 rue des retournements, 69777 Parla, France',
  'last_panier' => '',
  'role' => 'adm',
  'pwd' => 'hashed_root');
/******************** items *****************************/
$item_1 = array(
      'nom' => 'Bus pirate',
      'categorie' => 'electronics',
      'ref' => '789455',
      'prix' => '45.5',
      'stock' => '1150',
      'properties' => 'description: blablabla blabla blabla;',
      'img-url' => 'http://dangerousprototypes.com/docs/images/thumb/3/34/Bpv3v2go-pinout.png/600px-Bpv3v2go-pinout.png');

$item_2 = array(
      'nom' => 'la voie du pirate',
      'categorie' => 'books',
      'ref' => '877544',
      'prix' => '49.9',
      'stock' => '50',
      'properties' => 'auteur: Clara; ISBN: 548975434-56456;',
      'img-url' => 'https://images-na.ssl-images-amazon.com/images/I/41VCtin61xL._SX307_BO1,204,203,200_.jpg');
/******************** commandes ****************************/
$cmd_1 = array(
  'date' => '23/12/2016',
  'heure' => '15:05:54',
  'session_id' => '',
  'client_id' => '1',
  'id_cmd' => '20161223_150554_radale',
  'items' => array('789455' => '1'),
  'total' => '45.5',
  'status' => 'close'); // none -> pending -> paid -> in transit -> close

/******************** Populate DataBases **********************/

$users[] = $user_1;
$users[] = $user_2;

$items[] = $item_1;
$items[] = $item_2;

$cmds[] = $cmd_1;


/*************** Create JSON file for these DB *****************/


if (!file_exists($_db_path.$_db_users) ||
    !file_exists($_db_path.$_db_items) ||
    !file_exists($_db_path.$_db_cmds))
{
  mkdir($_db_path);
  file_put_contents($_db_path.$_db_users,json_encode($users));
  file_put_contents($_db_path.$_db_items,json_encode($items));
  file_put_contents($_db_path.$_db_cmds,json_encode($cmds));
}

header('location: pages/index.php');
 ?>
