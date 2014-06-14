<?php
/*
* Special Page for Bouce Handler using VERP 
*/

class SpecialBounceHandler extends SpecialPage {
	/**
	 * Initialize the special page.
	 */
	public function __construct() {
		parent::__construct( 'BounceHandler' );
	}

	public function execute( $sub ) {
		$out = $this->getOutput();
		$out->setPageTitle( $this->msg( 'bouncehandler-welcome' ) );
		$out->addWikiMsg( 'bouncehandler-welcome' );
	}
}