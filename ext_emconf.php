<?php

########################################################################
# Extension Manager/Repository config file for ext: "germandates"
#
# Auto generated 12-11-2007 18:23
#
# Manual updates:
# Only the data in the array - anything else is removed by next write.
# "version" and "dependencies" must not be touched!
########################################################################

$EM_CONF[$_EXTKEY] = array(
	'title' => 'German date format for sr_feuser_register',
	'description' => 'This extension provides the German date format for sr_feuser_register.',
	'category' => 'services',
	'author' => 'Oliver Klee',
	'author_email' => 'typo3-coding@oliverklee.de',
	'shy' => 0,
	'dependencies' => 'sr_feuser_register',
	'conflicts' => '',
	'priority' => '',
	'module' => '',
	'state' => 'stable',
	'internal' => '',
	'uploadfolder' => 0,
	'createDirs' => '',
	'modify_tables' => '',
	'clearCacheOnLoad' => 1,
	'lockType' => '',
	'author_company' => '',
	'version' => '1.0.0',
	'constraints' => array(
		'depends' => array(
			'sr_feuser_register' => '2.5.6-',
		),
		'conflicts' => array(
		),
		'suggests' => array(
		),
	),
	'_md5_values_when_last_written' => 'a:7:{s:9:"ChangeLog";s:4:"d3a4";s:37:"class.ux_tx_srfeuserregister_data.php";s:4:"f22e";s:12:"ext_icon.gif";s:4:"f427";s:17:"ext_localconf.php";s:4:"a7ac";s:14:"ext_tables.php";s:4:"ea3f";s:16:"static/setup.txt";s:4:"471f";s:14:"doc/manual.sxw";s:4:"99cc";}',
	'suggests' => array(
	),
);

?>