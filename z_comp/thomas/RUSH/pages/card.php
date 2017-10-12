<?php
session_start();
if (!$_SESSION['status'])
	header ("Location: index.php");
function get_card_items()
{
  $_db_path = "../DB/";
  $_db_cmds = "db_cmds.json";
  $cmds = json_decode(file_get_contents($_db_path.$_db_cmds), TRUE);

  if ($_SESSION['status'] == "notlogged")
  {
    $idx = array_keys(array_column($cmds, 'session_id'), session_id());
  }
  elseif (isset($_SESSION['logged_on_user'])) {
    $idx = array_keys(array_column($cmds, 'client_id'), $_SESSION['logged_on_user']);
  }
  foreach ($idx as $i => $v) {
    if ($cmds[$v]['status'] == "pending")
        return ($cmds[$v]['items']);
    else {
      continue ;
    }
  }
  return (null);
}

function get_price_from_reff($ref_to_find)
{
  $_db_path = "../DB/";
  $_db_items = "db_items.json";
  $items = json_decode(file_get_contents($_db_path.$_db_items), TRUE);
  $index = array_search($ref_to_find, array_column($items, 'ref'));
  return ($items[$index]['prix']);
}


function get_name_from_reff($ref_to_find)
{
  $_db_path = "../DB/";
  $_db_items = "db_items.json";
  $items = json_decode(file_get_contents($_db_path.$_db_items), TRUE);
  $index = array_search($ref_to_find, array_column($items, 'ref'));
  return ($items[$index]['nom']);
}


function get_card()
{
  $_db_path = "../DB/";
  $_db_cmds = "db_cmds.json";

  $cmds = json_decode(file_get_contents($_db_path.$_db_cmds), TRUE);
  if ($_SESSION['status'] == "notlogged")
  {
    $idx = array_keys(array_column($cmds, 'session_id'), session_id());
    foreach ($idx as $i => $v) {
      if ($cmds[$v]['status'] == "pending")
        {
          $cur_card_value = 0;
          foreach ($cmds[$v]['items'] as $ref => $qty) {
            $cur_card_value += get_price_from_reff($ref) * $qty;
          }
          return ($cur_card_value);
        }
      else {
        continue ;
      }
    }
    return (0);
  }
  else {
    $idx = array_keys(array_column($cmds, 'client_id'), $_SESSION['logged_on_user']);
    foreach ($idx as $i => $v) {
      if ($cmds[$v]['status'] == "pending")
        {
          $cur_card_value = 0;
          foreach ($cmds[$v]['items'] as $ref => $qty) {
            $cur_card_value += get_price_from_reff($ref) * $qty;
          }
          return ($cur_card_value);
        }
      else {
        continue ;
      }
    }
    return (0);
  }
}
?>


 <?php require_once("../parts/header.php") ?>
 <?php require_once("../parts/left-side.php") ?>


--><article class="col8">
  <div class="box">
    <div class="container-central">
      <?php
        printf("<table class='products'>");
        $arr = get_card_items();
        foreach ($arr as $ref => $qty) {
          if ($qty > 0)
            printf('<tr><td>%s</td><td>%s</td><td>%s</td><td>%s</td></tr>',get_name_from_reff($ref), $ref, $qty, get_price_from_reff($ref));
        }
        printf('</tr><td></td><td>total</td><td>%s</td></tr>',get_card());
        printf('</table>');
       ?>
    </div>
  </div>
</article><!--

 <?php
 require_once('../parts/right-side.php');
 require_once('../parts/footer.php');
 ?>
