<?php
!defined('EMLOG_ROOT') && exit('access deined!');

/**
 * 插件激活初始化
 */
function callback_init()
{
    $db = Database::getInstance();
    $sql = "ALTER TABLE `" . DB_PREFIX . "blog` ADD `postfrom` VARCHAR(255) NULL AFTER `title`;";
    $db->query($sql, true);
}
