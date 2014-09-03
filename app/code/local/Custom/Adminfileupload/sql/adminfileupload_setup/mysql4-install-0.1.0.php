<?php
  /*$installer = $this;
  $installer->startSetup();
 
  $installer->run("
    --DROP TABLE IF EXISTS {$this->getTable('tut_pdfupload')};
 
    CREATE TABLE {$this->getTable('tut_pdfupload')} (
      `file_id` int(11) NOT NULL AUTO_INCREMENT,
      `title` varchar(245) NOT NULL,
      `file_name` varchar(245) NOT NULL,
      PRIMARY KEY (`file_id`)
    ) ENGINE=MyISAM  DEFAULT CHARSET=latin1
  ");
 
  $installer->endSetup();*/
  echo 'Running This Upgrade:'; //'.get_class($this)."\n <br /> \n";
  die("Exit for now");