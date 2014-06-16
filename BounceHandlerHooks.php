<?php 
/** Hooks used by BounceHandler
*/

class BounceHandlerHooks { 

	public static function onVERPAddressGenerate( $recip, $from, $headers )	{
		global $wgEnableVERP;
		if ( $wgEnableVERP ) {
			$from->address = self::generateVERP( $recip->address );
		}
	return true;
	}
	/**
	 * Generate VERP address
	 * @param string reciepient email
	 * @return string ReturnPath address
	 */
	protected static function generateVERP( $to ) {
		global $wgVERPalgo, $wgVERPsecret, $wgServer, $wgSMTP;
		if(  is_array( $wgSMTP ) && isset( $wgSMTP['IDHost'] ) && $wgSMTP['IDHost'] ) {
			$email_domain = $wgSMTP['IDHost'];
		} else {
			$url = wfParseUrl( $wgServer );
			$email_domain = $url['host'];
		}
		$verp_hash = hash_hmac( $wgVERPalgo, $to, $wgVERPsecret );
		$email_prefix = 'bounces';
		$returnPath = $email_prefix.'-'.$verp_hash.'@'.$email_domain;
		return $returnPath;
	}
	/*
	* Add tables to DataBase
	*/
	public static function AddTable( DatabaseUpdater $updater ) {
		$updater->addExtensionTable(
			'bounce_records',
			__DIR__. '/sql/bounce_records.sql', true 
			);
	return true;
	}
}