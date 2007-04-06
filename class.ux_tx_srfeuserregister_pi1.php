<?php
/***************************************************************
* Copyright notice
*
* (c) 2006-2007 Oliver Klee (typo3-coding@oliverklee.de)
* All rights reserved
*
* This script is part of the TYPO3 project. The TYPO3 project is
* free software; you can redistribute it and/or modify
* it under the terms of the GNU General Public License as published by
* the Free Software Foundation; either version 2 of the License, or
* (at your option) any later version.
*
* The GNU General Public License can be found at
* http://www.gnu.org/copyleft/gpl.html.
*
* This script is distributed in the hope that it will be useful,
* but WITHOUT ANY WARRANTY; without even the implied warranty of
* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
* GNU General Public License for more details.
*
* This copyright notice MUST APPEAR in all copies of the script!
***************************************************************/
/**
 * The 'germandates' extension.
 *
 * @author	Oliver Klee <typo-coding@oliverklee.de>
 */
class ux_tx_srfeuserregister_pi1 extends tx_srfeuserregister_pi1 {
	/**
	 *  Checks if the value is a correct date in format dd.mm.yyyy.
	 */
	function evalDate($value) {
		if(empty($value)) {  
			return false; 
		}
		$checkValue = trim($value);
		if (strlen($checkValue) == 8) {
			$checkValue = substr($checkValue,0,2).'.'.substr($checkValue,2,2).'.'.substr($checkValue,4,4) ;
		}
		list($day,$month,$year) = split('\.', $checkValue, 3);
		if (is_numeric($year) && is_numeric($month) && is_numeric($day)) {
			return checkdate($month, $day, $year);
		} else {
			return false; 
		}
	}
	/**
	* Transforms incoming timestamps into dates
	*
	* @return parsedArray
	*/
	function parseIncomingTimestamps($origArr = array()) {
		$parsedArr = array();
		$parsedArr = $origArr;
		if (is_array($this->conf['parseFromDBValues.'])) {
			reset($this->conf['parseFromDBValues.']);
			while (list($theField, $theValue) = each($this->conf['parseFromDBValues.'])) {
				$listOfCommands = t3lib_div::trimExplode(',', $theValue, 1);
				while (list(, $cmd) = each($listOfCommands)) {
					$cmdParts = split("\[|\]", $cmd); // Point is to enable parameters after each command enclosed in brackets [..]. These will be in position 1 in the array.
					$theCmd = trim($cmdParts[0]);
					switch($theCmd) {
						case 'date':
						if($origArr[$theField]) {
							$parsedArr[$theField] = date('d.m.Y', $origArr[$theField]);
						}
						if (!$parsedArr[$theField]) {
							unset($parsedArr[$theField]);
						}
						break;
						case 'adodb_date':
						if($origArr[$theField]) {
							$parsedArr[$theField] = $this->adodbTime->adodb_date('d.m.Y', $origArr[$theField]);
						}
						if (!$parsedArr[$theField]) {
							unset($parsedArr[$theField]);
						}
						break;
					}

				}
			}
		}
		return $parsedArr;
	}
	
	/**
	 * Transforms outgoing dates into timestamps
	 *
	 * @return parsedArray
	 */
	function parseOutgoingDates($origArr = array()) {
		$parsedArr = array();
		$parsedArr = $origArr;
		if (is_array($this->conf['parseToDBValues.'])) {
			reset($this->conf['parseToDBValues.']);
			while (list($theField, $theValue) = each($this->conf['parseToDBValues.'])) {
				$listOfCommands = t3lib_div::trimExplode(',', $theValue, 1);
				while (list(, $cmd) = each($listOfCommands)) {
					$cmdParts = split("\[|\]", $cmd); // Point is to enable parameters after each command enclosed in brackets [..]. These will be in position 1 in the array.
					$theCmd = trim($cmdParts[0]);
					switch($theCmd) {
						case 'date':
						if($origArr[$theField]) {
							if(strlen($origArr[$theField]) == 8) { 
								$parsedArr[$theField] = substr($origArr[$theField],0,2).'.'.substr($origArr[$theField],2,2).'.'.substr($origArr[$theField],4,4);
							} else {
								$parsedArr[$theField] = $origArr[$theField];
							}
							list($day,$month,$year) = split('\.', $parsedArr[$theField], 3);
							$parsedArr[$theField] = mktime(0,0,0,$month,$day,$year);
						}
						break;

						case 'adodb_date':
						if($origArr[$theField]) {
							if(strlen($origArr[$theField]) == 8) { 
								$parsedArr[$theField] = substr($origArr[$theField],0,2).'.'.substr($origArr[$theField],2,2).'.'.substr($origArr[$theField],4,4);
							} else {
								$parsedArr[$theField] = $origArr[$theField];
							}
							list($day,$month,$year) = split('\.', $parsedArr[$theField], 3);

							$parsedArr[$theField] = $this->adodbTime->adodb_mktime(0,0,0,$month,$day,$year);
						}
						break;
					}
				}
			}
		}

		return $parsedArr;
	}

	/**
	* Transforms incoming timestamps into dates
	*
	* @return parsedArray
	*/
	function parseIncomingData($origArr = array()) {
		global $TYPO3_DB, $TCA;
		
		$parsedArr = array();
		$parsedArr = $origArr;
		if (is_array($this->conf['parseFromDBValues.'])) {
			reset($this->conf['parseFromDBValues.']);
			while (list($theField, $theValue) = each($this->conf['parseFromDBValues.'])) {
				$listOfCommands = t3lib_div::trimExplode(',', $theValue, 1);
				while (list(, $cmd) = each($listOfCommands)) {
					$cmdParts = split("\[|\]", $cmd); // Point is to enable parameters after each command enclosed in brackets [..]. These will be in position 1 in the array.
					$theCmd = trim($cmdParts[0]);
					switch($theCmd) {
						case 'date':
						if($origArr[$theField]) {
							$parsedArr[$theField] = date( 'd.m.Y', $origArr[$theField]);
						}
						if (!$parsedArr[$theField]) {
							unset($parsedArr[$theField]);
						}
						break;
						case 'adodb_date':
						if($origArr[$theField]) {
							$parsedArr[$theField] = $this->adodbTime->adodb_date( 'd.m.Y', $origArr[$theField]);
						}
						if (!$parsedArr[$theField]) {
							unset($parsedArr[$theField]);
						}
						break;
					}
				}
			}
		}

		$fieldsList = array_keys($parsedArr);
		foreach ($this->TCA['columns'] as $colName => $colSettings) {
			if (in_array($colName, $fieldsList) && $colSettings['config']['type'] == 'select' && $colSettings['config']['MM']) {
				if (!$parsedArr[$colName]) {
					$parsedArr[$colName] = '';
				} else {
					$valuesArray = array();
					$res = $TYPO3_DB->exec_SELECTquery(
						'uid_local,uid_foreign,sorting',
						$colSettings['config']['MM'],
						'uid_local='.intval($parsedArr['uid']),
						'',
						'sorting');
					while ($row = $TYPO3_DB->sql_fetch_assoc($res)) {
						$valuesArray[] = $row['uid_foreign'];
					}
					$parsedArr[$colName] = implode(',', $valuesArray);
				}
			}
		}
		
		return $parsedArr;
	}
	
	/**
	 * Transforms outgoing dates into timestamps
	 *
	 * @return parsedArray
	 */
	function parseOutgoingData($origArr = array()) {
		$parsedArr = array();
		$parsedArr = $origArr;
		if (is_array($this->conf['parseToDBValues.'])) {
			reset($this->conf['parseToDBValues.']);
			while (list($theField, $theValue) = each($this->conf['parseToDBValues.'])) {
				$listOfCommands = t3lib_div::trimExplode(',', $theValue, 1);
				while (list(, $cmd) = each($listOfCommands)) {
					$cmdParts = split("\[|\]", $cmd); // Point is to enable parameters after each command enclosed in brackets [..]. These will be in position 1 in the array.
					$theCmd = trim($cmdParts[0]);
					switch($theCmd) {
						case 'date':
						if($origArr[$theField]) {
							if(strlen($origArr[$theField]) == 8) { 
								$parsedArr[$theField] = substr($origArr[$theField],0,2).'.'.substr($origArr[$theField],2,2).'.'.substr($origArr[$theField],4,4);
							} else {
								$parsedArr[$theField] = $origArr[$theField];
							}
							list($day,$month,$year) = split('\.', $parsedArr[$theField], 3);
							$parsedArr[$theField] = mktime(0,0,0,$month,$day,$year);
						}
						break;

						case 'adodb_date':
						if($origArr[$theField]) {
							if(strlen($origArr[$theField]) == 8) { 

								$parsedArr[$theField] = substr($origArr[$theField],0,2).'.'.substr($origArr[$theField],2,2).'-'.substr($origArr[$theField],4,4);
							} else {
								$parsedArr[$theField] = $origArr[$theField];
							}
							list($day,$month,$year) = split('\.', $parsedArr[$theField], 3);

							$parsedArr[$theField] = $this->adodbTime->adodb_mktime(0,0,0,$month,$day,$year);
						}
						break;
					}
				}
			}
		}
		
			// update the MM relation count field
		$fieldsList = array_keys($parsedArr);
		foreach ($this->TCA['columns'] as $colName => $colSettings) {
			if (in_array($colName, $fieldsList) && $colSettings['config']['type'] == 'select' && $colSettings['config']['MM']) {
				$parsedArr[$colName] = count(explode(',', $parsedArr[$colName]));
			}
		}
		
		return $parsedArr;
	}
	
}

if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/germandates/class.ux_tx_srfeuserregister_pi1.php']) {
	include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/germandates/class.ux_tx_srfeuserregister_pi1.php']);
}

?>
