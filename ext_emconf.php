<?php

########################################################################
# Extension Manager/Repository config file for ext: "germandates"
#
# Auto generated 10-08-2007 13:09
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
	'conflicts' => 'sr_feuser_register',
	'priority' => '',
	'module' => '',
	'state' => 'beta',
	'internal' => '',
	'uploadfolder' => 0,
	'createDirs' => '',
	'modify_tables' => '',
	'clearCacheOnLoad' => 1,
	'lockType' => '',
	'author_company' => '',
	'version' => '0.1.0',
	'constraints' => array(
		'depends' => array(
			'sr_feuser_register' => '2.5.6-',
		),
		'conflicts' => array(
			'sr_feuser_register' => '0.0.0-2.5.5',
		),
		'suggests' => array(
		),
	),
	'_md5_values_when_last_written' => 'a:9:{s:9:"ChangeLog";s:4:"4295";s:37:"class.ux_tx_srfeuserregister_data.php";s:4:"f22e";s:12:"ext_icon.gif";s:4:"f427";s:17:"ext_localconf.php";s:4:"a7ac";s:14:"ext_tables.php";s:4:"ea3f";s:14:"doc/manual.sxw";s:4:"d5ad";s:16:"doc/useredit.png";s:4:"93c9";s:16:"doc/useredit.xcf";s:4:"737c";s:16:"static/setup.txt";s:4:"471f";}',
	'suggests' => array(
	),
);

?>