<?php

if (!defined('TYPO3_MODE')) {
	die('Access denied.');
}

$TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/sr_feuser_register/model/class.tx_srfeuserregister_data.php']
	= t3lib_extMgm::extPath('germandates').'class.ux_tx_srfeuserregister_data.php';

?>
