<?php
$_db_path = "../DB/";
$_db_items = "db_items.json";
session_start();
if (!$_SESSION['status'])
	header ("Location: index.php");

/* ----------------------------------------------------
*  Methode GET
*   -> recupere le nom de la categorie
*   -> recupere la base de donnee item
*   -> cree un tableau avec tous les items appartenant
*       a la categorie
*  ---------------------------------------------------- */
$items = json_decode(file_get_contents($_db_path.$_db_items), TRUE);
$selection = array();
foreach ($items as $idx => $item)
{

  //====== >  ! /!\ ! n'accepte qu'un seul tag !
      $selection[] = $item;
}
 ?>

 <?php require_once("../parts/header.php") ?>
 <?php require_once("../parts/left-side.php") ?>

--><article class="col8">
  <div class="box">
    <div class="container-central">
      <div class="cat_items_view_container">
          <?php
            foreach($selection as $id => $s_it)
			{
              printf('<a href=item.php?ref=%s>', $s_it['ref']);
              echo '<div class="item">';
			  printf('<img class="item_img_home" src="%s"/>',$s_it['img-url']);
              printf("<p>id : %s</p><p>nom : %s</p><p>ref : %s</p><p>description : %s</p>", $id, $s_it['nom'], $s_it['ref'], $s_it['properties']);
              echo '</div>';
              echo '</a>';
            }
           ?>
      </div>
    </div>
  </div>
</article><!--


 <?php require_once("../parts/right-side.php") ?>
 <?php require_once("../parts/footer.php") ?>
