<?php
session_start();
if (isset($_SESSION["loggued_on_user"]) && $_SESSION["loggued_on_user"] != "" && $_SESSION["lvl"] == "admin")
{
    /* need to check if user is an admin */


    /*add un nouveau produit */

    if ($_POST['pnumber'] && $_POST['pname'] && $_POST['image'] && $_POST['cate'] && $_POST['des'] && $_POST['submit'] && $_POST['pauteur'] && $_POST['submit'] === "Ajouter un nouveau produit") {
        if (!(file_exists('./ressources/product')))
        {
            file_put_contents('./ressources/product', null);
        }
        else
        {
            $product = json_decode(file_get_contents('./ressources/product'), true);
        }
        $exist = 0;
        if ($product)
        {
            foreach ($product as $key => $var)
            {
                if ($var['pname'] === $_POST['pname'])
                {
                    break ;
                    $exist = 1;
                }
            }
        }
        if ($exist)
        {
            $_SESSION["add_product"] = "error produit existant";
            header('Location: admin.php');
        }
        else
        {
            $tmp['pnumber'] = $_POST['pnumber'];
            $tmp['pname'] = $_POST['pname'];
            $tmp['image'] = $_POST['image'];
            $tmp['cate'] = $_POST['cate'];
            $tmp['tag'] = $_POST['tag'];
            $tmp['prix'] = $_POST['prix'];
            $tmp['pauteur'] = $_POST['pauteur'];
            $tmp['des'][0] = substr($_POST['des'], 0, 18);
            $tmp['des'][1] = substr($_POST['des'], 18, 29);
            $tmp['time'] = time();
            $product[$tmp['pname']] = $tmp;
            file_put_contents('./ressources/product', json_encode($product));
            $_SESSION["add_product"] = "ajout produit OK";
            header('Location: admin.php');
        }
    }


    /* add pnumber pour produit existant */

    else if ($_POST['pnumber'] && $_POST['pname'] && $_POST['submit'] && $_POST['submit'] === "Ajouter") {
        if (!(file_exists('./ressources/product')))
            echo "ERROR\n";
        $product = json_decode(file_get_contents('./ressources/product'), true);
        if ($product) {
            $exist = 0;
            foreach ($product as $key => $var) {
                if ($var['pname'] === $_POST['pname']){
                    $exist = 1;
                    $product[$key]['pnumber'] += $_POST['pnumber'];
                }
            }
            if ($exist) {
                file_put_contents('./ressources/product', json_encode($product));
                $_SESSION["modif_product"] = "modification produit ok";
                header('Location: admin.php');
            } 
            else
            {
                $_SESSION["modif_product"] = "error produit inexistant";
                header('Location: admin.php');
            }
        } 
        else 
        {
            $_SESSION["modif_product"] = "error fille error";
            header('Location: admin.php');
        }
    }
    else
    {
        $_SESSION["modif_product"] = "error";
        header('Location: admin.php');
    }
}
?>