<?php 
require_once ( dirname(__FILE__). "/../../maintenance/Maintenance.php");
class BounceHandlerClearance extends Maintenance {
	public function __construct() { 
		parent::__construct();
		$this->mDescription = "Connect to IMAP server and take action on bounces";
		$this->addArg( "imapuser", "IMAP account Username", false );
		$this->addArg( "imappass", "IMAP account Password", false );
	}
	public function execute() {
		global $wgIMAPuser, $wgIMAPpass, $wgIMAPserver;
		$imapuser = $this->getArg( 0 );
		$imappass = $this->getArg( 1 );
		if ( !is_object( $imapuser ) && ( $wgIMAPuser === null) ) {
			$this->error( "invalid IMAP username.", true );
		}
		if ( !is_object( $imappass ) && ( $wgIMAPpass === null )) {
			$this->error( "invalid IMAP password.", true );
		}
		if ( $wgIMAPserver === null ) {
			$this->error( "invalid IMAP server.", true );
		}
		$conn = imap_open( $wgIMAPesrver, $wgIMAPuser, $wgIMAPpass ) or die( imap_last_error() );
		$num_msgs = imap_num_recent( $conn );
		echo $num_msgs ;
	}
}
$maintClass = 'BounceHandlerClearance';
if( defined('RUN_MAINTENANCE_IF_MAIN') ) {
  require_once( RUN_MAINTENANCE_IF_MAIN );
} else {
  require_once( DO_MAINTENANCE ); # Make this work on versions before 1.17
}