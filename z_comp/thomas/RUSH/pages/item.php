<?php
$_db_path = "../DB/";
$_db_items = "db_items.json";
session_start();
if (!$_SESSION['status'])
	header ("Location: index.php");
/* ----------------------------------------------------
*  Methode GET ['ref']
*   -> recupere l'item par sa reference dans la BDD
*   -> copie l'element
*   -> cree un tableau avec toutes les valeurs appartenant
*       a l'item
*  ---------------------------------------------------- */
if (isset($_GET['ref'])) {
  if ($_GET['ref'] != '') {
    $ref = strip_tags($_GET['ref']);
    }
}
$items = json_decode(file_get_contents($_db_path.$_db_items), TRUE);
foreach ($items as $idx => $item)
{
    if ($item['ref'] == $ref)
      $selection = $item;
}
//reset
$item = null;
$items = array();

 ?>
 <?php
 require_once('../parts/header.php');
 require_once('../parts/left-side.php');
 ?>

--><article class="col8">
  <div class="box">
    <div class="container-central">
      <h2><?php echo $selection['nom']; ?></h2>
      <div class="item_view_container">
        <div class="item_info">
          <img class="item_img" src="<?php echo $selection['img-url']?>"/>
          <div class="item_properties">
            <?php echo $selection['properties']; ?>
          </div>
        </div>
        <div class="order_box">
          <div class="item_prix"><?php echo $selection['prix']; ?>&#x20AC</div>
            <form class="purchase" action="add_to_card.php?ref=<?php echo $selection['ref']?>" method="post">
              <table>
                <tr>
                  <td><input type="text" name="qty" value="1"></td>
                  <td>quantité</td>
                </tr>
                <tr>
                  <td><input type="submit" name="submit" value="ADD"></td>
                  <td>référence : <?php echo $selection['ref']; ?></td>
                </tr>
              </table>
            </form>
        </div>
    </div>
  </div>
</article><!--

 <?php
 require_once('../parts/right-side.php');
 require_once('../parts/footer.php');
 ?>
