<?php
    var_dump($_GET);
    var_dump($_POST);
    if(isset($_POST) && !empty($_POST)){
        if($_POST['show']){
            $fp=fopen("showData.txt","a");
            fputs ($fp, $_POST['show']);
            fclose ($fp);
        } else
        if($_POST['store']){
            $fp=fopen("storeData.txt","a");
            fputs ($fp, $_POST['store']);
            fclose ($fp);
        } else
        if($_POST['update']){
            $fp=fopen("updateData.txt","a");
            fputs ($fp, $_POST['update']);
            fclose ($fp);
        } else
        if($_POST['destroy']){
            $fp=fopen("destroyData.txt","a");
            fputs ($fp, $_POST['destroy']);
            fclose ($fp);
        }
    }
?>
