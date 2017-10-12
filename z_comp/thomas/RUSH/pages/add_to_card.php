<?php
session_start();
$_db_path = "../DB/";
$_db_cmds = "db_cmds.json";

if (isset($_GET['ref']) && isset($_POST['qty']) && $_POST['submit'] == "ADD") {
  if ($_GET['ref'] != '' && $_POST['qty'] != '') {
    $g_ref = strip_tags($_GET['ref']);
    $p_qty = strip_tags($_POST['qty']);
    $cmds = json_decode(file_get_contents($_db_path.$_db_cmds), TRUE);
    foreach ($cmds as $idcmd => $cmd) //recherche dans la base si une commande existe
    {
        if (($cmd['session_id'] == session_id() || $cmd['client_id'] == $_SESSION['logged_on_user'])&&
            $cmd['status'] == 'pending' )
            {
              $cur_idcmd = $idcmd;
              $cur_cmd = $cmd;
              //ajout du login si le type c'est logguer entre temps
              if (isset($_SESSION['logged_on_user']))
                $cur_cmd['client_id'] = $_SESSION['logged_on_user'];
              break ;
            }
        else {
          $cur_cmd = null;
        }
    }
    if ($cur_cmd == null) // sinon creer une commande
    {
      $cur_cmd = array(
        'date' => '',
        'heure' => '',
        'session_id' => session_id(),
        'id_cmd' => '',
        'items' => array(),
        'total' => '',
        'status' => 'pending');
        //ajout du login si le type c'est logguer entre temps
      if (isset($_SESSION['logged_on_user']))
        $cur_cmd['client_id'] = $_SESSION['logged_on_user'];
      $cur_cmd['items'][$g_ref] = $p_qty;
    }
    else { // si la commande existe, on continue de remplir le caddie
      $cur_cmd['items'][$g_ref] = $p_qty;
      unset($cmds[$cur_idcmd]);
      $cmds = array_values($cmds);
    }
    // ajout de la commande
    $cmds[] = $cur_cmd;
    //ecriture dans la base de données
    file_put_contents($_db_path.$_db_cmds, json_encode($cmds));
    header('location: item.php?ref='.$g_ref);
    die();
    }
}
header('location: item.php?ref='.$_GET['ref']);

 ?>
