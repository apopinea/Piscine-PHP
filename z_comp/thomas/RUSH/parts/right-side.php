<?php

$_db_path = "../DB/";
$_db_items = "db_items.json";
$items_cat = json_decode(file_get_contents($_db_path.$_db_items), TRUE);
$categories = array();
foreach ($items_cat as $idx => $item_cat) {
  if ($item_cat['categorie'] != '' &&
      !in_array($item_cat['categorie'], $categories))
  {
    $categories[] = $item_cat['categorie'];
  }
  $item_cat = null;
  $items_cat = array();
}
// Generate Right column

function get_price_from_ref($ref_to_find)
{
  $_db_path = "../DB/";
  $_db_items = "db_items.json";
  $items = json_decode(file_get_contents($_db_path.$_db_items), TRUE);
  $index = array_search($ref_to_find, array_column($items, 'ref'));
  return ($items[$index]['prix']);
}

function get_card_value()
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
            $cur_card_value += get_price_from_ref($ref) * $qty;
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
            $cur_card_value += get_price_from_ref($ref) * $qty;
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

 --><aside class="col2">
   <div class="box">
     <center>
      <a href="card.php" title="let's checkout !">
     <img class="img-profil" src="../imgs/var/basket.png"/>
     <p> <?php  echo get_card_value();   ?>&#8364;</p></a>
   </center>
   </div>
   <div class="box">
    <center>
       <?php foreach($categories as $idx => $cat)
              {
                printf('<a href="categorie.php?cat=%s" title=$s class="link-cat">%s</a>', $cat, $cat ,$cat);
              }
        ?>
  </center>
  </div>
 </aside>
 </div>
