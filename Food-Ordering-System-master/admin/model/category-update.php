<?php
require('../../includes/config/config.php');
require('../../includes/Sql/sql.class.php');

if (isset($_POST['id']))
{
    // validate the fucking `bizarre` checkbox
    if (isset($_POST['status'])) $status  = 1; //has value
    if (empty($_POST['status'])) $status .= 0;
    if ($status == 10) $status = rtrim($status, "0");
    // validate the fucking `bizarre` checkbox

    $id = (int) $_POST['id'];
    if (isset($_POST['submitted']))
    {
        foreach($_POST AS $key => $value) { $_POST[$key] = mysql_real_escape_string($value); }
        $sql = "UPDATE `categories` SET  `name` =  '{$_POST['name']}' ,  `short` =  '{$_POST['short']}' ,  `description` =  '{$_POST['desc']}' ,  `color` =  '{$_POST['color']}', `font_color` =  '{$_POST['font-color']}', `status` = '{$status}' WHERE `id` = '$id' ";
        mysql_query($sql) or die(mysql_error());
        echo (mysql_affected_rows()) ? "<SCRIPT LANGUAGE=\"JavaScript\" TYPE=\"text/javascript\"> alert(\"Dados da categoria alterados com sucesso!\") </script>"
                                     : "<SCRIPT LANGUAGE=\"JavaScript\" TYPE=\"text/javascript\"> alert(\"Falha na tentativa de alterar os dados da categoria!\") </script>";
        GenericSql::Redirect( $sec=0, $file="../view/category-select.php" );
    }
}
else
{
    die('No direct script access.');
}
?>
