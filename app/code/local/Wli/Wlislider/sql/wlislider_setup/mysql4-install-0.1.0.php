    <?php
     
    $installer = $this;
     
    $installer->startSetup();
     
    $installer->run("
     
    -- DROP TABLE IF EXISTS {$this->getTable('wlislider')};
    CREATE TABLE {$this->getTable('wlislider')} (
      `wlislider_id` int(11) unsigned NOT NULL auto_increment,
      `title` varchar(255) NOT NULL default '',
      `image` varchar(255) NOT NULL default '',
      `imageurl` varchar(255) NOT NULL default '',
      `status` smallint(6) NOT NULL default '0',
      PRIMARY KEY (`wlislider_id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
     
        ");
     
    $installer->endSetup();
