<?php
$installer = $this;
$installer->startSetup();
$sql=<<<SQLTEXT
create table pdfupload(pdfupload_id int not null auto_increment, name varchar(100), primary key(pdfupload_id)
filename varchar(255)
);
  
		
SQLTEXT;

$installer->run($sql);
//demo 
//Mage::getModel('core/url_rewrite')->setId(null);
//demo 
$installer->endSetup();
	 