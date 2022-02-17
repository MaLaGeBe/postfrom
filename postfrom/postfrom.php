<?php
/*
Plugin Name: 文章来源
Version: v1.0
Plugin URL:
Description: 文章来源
Author: MaLaGeBe
Author URL: 
*/

addAction('adm_writelog_head', 'hook_postfrom');
addAction('save_log', 'save_postfrom');

function hook_postfrom()
{
    global $postfrom;
    echo "<script>$(document).ready(function(){var html='<div class=\"form-group\"><label>来源：</label><input type=\"text\" name=\"postfrom\" id=\"postfrom\" value=\"{$postfrom}\" class=\"form-control\" placeholder=\"格式：来源名称|来源地址\"></div>';$('#advset').prepend(html);})</script>";
}

function save_postfrom($blogid)
{
    $Log_Model = new Log_Model();
    $postfrom = isset($_POST['postfrom']) ? addslashes(trim($_POST['postfrom'])) : '';

    $logData = array(
        'postfrom' => $postfrom
    );

    $Log_Model->updateLog($logData, $blogid);
}

function get_postfrom($logid)
{
    $db = Database::getInstance();
    $sql = "SELECT * FROM " . DB_PREFIX . "blog WHERE gid=$logid";
    $res = $db->query($sql);
    $row = $db->fetch_array($res);
    if ($row['postfrom']) {
        $postfrom  = htmlspecialchars($row['postfrom']);
    }
    return isset($postfrom) ? $postfrom : '';
}