<?php
session_start();
if (!$_SESSION['status'])
	header ("Location: index.php");
$_db_path = "../DB/";
$_db_items = "db_items.json";

/* ----------------------------------------------------
*  Methode POST
*   -> Modification d'un element recherché par sa référence
*       dans la base de donnee item
*   -> si l'élément n'existe pas -> append(element)
*       sinon -->   1.suppression de l'élément dans la base
*                   2.ajout de l'item a la base
*   -> save in json format
*  ---------------------------------------------------- */

if ($_POST['submit']!= null) {
  if ($_POST['submit'] == "OK") {
    if (isset($_POST['nom']) &&
        isset($_POST['categorie']) &&
        isset($_POST['ref']) &&
        isset($_POST['prix']) &&
        isset($_POST['stock']) &&
        isset($_POST['img-url']) &&
        isset($_POST['properties']))
        {

          $p_nom = strip_tags($_POST['nom']);
          $p_cat = strip_tags($_POST['categorie']);
          $p_ref = strip_tags($_POST['ref']);
          $p_prix = strip_tags($_POST['prix']);
          $p_stock = strip_tags($_POST['stock']);
          $p_imgurl = strip_tags($_POST['img-url']);
          $p_properties = strip_tags($_POST['properties']);
          if ($p_nom !== "" && $p_cat !== "" && $p_ref !== "" &&
              $p_prix !== "" && $p_stock !== "" && $p_properties !== "" &&
              $p_imgurl !== "")
              {
                $item = array(
                  'nom' => $p_nom,
                  'categorie' => $p_cat,
                  'ref' => $p_ref,
                  'prix' => $p_prix,
                  'stock' => $p_stock,
                  'img-url' => $p_imgurl,
                  'properties' => $p_properties);
                $items = json_decode(file_get_contents($_db_path.$_db_items), TRUE);
                //TO DO : VERIF NON EXISTANCE DE LA ref !
                // if (ref not in list) ==> add object to list
                // else --> ERROR
                //---------------
                //modif : _db_items
                $idx = array_search($_POST['ref'], array_column($items, 'ref'));
                if ($idx !== FALSE)
                {
                  unset($items[$idx]);
                  $items = array_values($items);
                }
                $items[] = $item;
                file_put_contents($_db_path.$_db_items,json_encode($items));
              }
        }

  }
  if ($_POST['submit'] == "DEL" && isset($_POST['ref']))
  {
    if ($_POST['ref'] != '')
    {
      $p_ref = strip_tags($_POST['ref']);
      $items = json_decode(file_get_contents($_db_path.$_db_items), TRUE);
      $idx = array_search($_POST['ref'], array_column($items, 'ref'));
      if ($idx !== FALSE)
      {
        unset($items[$idx]);
		$items = array_values($items);
        file_put_contents($_db_path.$_db_items,json_encode($items));
      }
    }
  }
}
/* ----------------------------------------------------
*  Methode GET
*   -> Recherche un element dans la base de donnee item
*       par sa reference pour l'affichage dans les champs de text
*   -> si l'élément n'existe pas -> item = null
*       sinon -->   item = item from DB
*  ---------------------------------------------------- */
if ($_POST['search']!= null) {
	if ($_POST['search'] === "SEARCH" && $_POST['seek'])
	{
		$p_seek = strip_tags($_POST['seek']);
		$_GET['ref'] = $p_seek;
	}
}
if (isset($_GET['ref']) && $_GET['ref'] != '') {
  if ($_GET['ref']) {
    $items = json_decode(file_get_contents($_db_path.$_db_items), TRUE);
    $idx = array_search(strip_tags($_GET['ref']), array_column($items, 'ref'));
    if ($idx !== FALSE)
      $item = $items[$idx];
    else {
      $item = null;
    }
  }
  else {
    $item = null;
  }
}
 
?>

<?php
require_once('../parts/header.php');
require_once('../parts/left-side.php');
?>

--><article class="col8">
  <div class="box">
    <div class="container-central">
      <div class="edit_item_form_container">
        <form action="edit_item.php" method="post" id="edit_item">
          <label style="text-align: left">Nom : </label>
          <input type="text" name="nom" value="<?php if($item['nom'] != '') {echo $item['nom'];}?>">
          <label>Categorie : </label>
          <input type="text" name="categorie" value="<?php if($item['categorie'] != '') {echo $item['categorie'];}?>">
          <label>référence : </label>
          <input type="text" name="ref" value="<?php if($item['ref'] != '') {echo $item['ref'];}?>">
          <label>Prix : </label>
          <input type="text" name="prix" value="<?php if($item['prix'] != '') {echo $item['prix'];}?>">
          <label>En stock : </label>
          <input type="text" name="stock" value="<?php if($item['stock'] != '') {echo $item['stock'];}?>">
          <label>Image : </label>
          <input type="text" name="img-url" value="<?php if($item['img-url'] != '') {echo $item['img-url'];}?>">
          <label>Description : </label>
          <textarea type="text" name="properties"><?php if($item['properties'] != '') {echo $item['properties'];} ?></textarea>
          <input type="submit" name="submit" value="OK">
          <input type="submit" name="submit" value="DEL">
        </form>
        <form action="edit_item.php" method="post" id="look_item">
          <label>Search ref: </label>
          <input type="text" name="seek">
          <input type="submit" name="search" value="SEARCH">
        </form>
      </div>
    </div>
  </div>
</article><!--

<?php
require_once('../parts/right-side.php');
require_once('../parts/footer.php');
 ?>
