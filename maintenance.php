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
		$conn = imap_open( $wgIMAPserver, $wgIMAPuser, $wgIMAPpass ) or die( imap_last_error() );
		$num_msgs = imap_num_recent( $conn );

		# start bounce classs
                error_reporting(0);  //remove unwanted error reportings
                require_once ( dirname(__FILE__). "/PHP_Bounce_Handler/bounce_driver.class.php" );
                $bouncehandler = new Bouncehandler();

		# get the failures
		$email_addresses = array();
		$delete_addresses = array();
		for ( $n=1; $n <= $num_msgs; $n++) {
			$bounce = imap_fetchheader( $conn, $n ).imap_body( $conn, $n ); //entire message
			$multiArray = $bouncehandler->get_the_facts($bounce);
			if ( !empty($multiArray[0]['action'] ) && !empty( $multiArray[0]['status'] ) 
				&& !empty( $multiArray[0]['recipient'] ) ) {
				if ( $multiArray[0]['action'] == 'failed' ) {
					$email_addresses[$multiArray[0]['recipient']]++; //increment number of failures
					$delete_addresses[$multiArray[0]['recipient']][] = $n; //add message to delete array
					} //if delivery failed
			} //if passed parsing as bounce
		}

		foreach ( $email_addresses as $key => $value ) { //trim($key) is email address, $value is number of failures
			if ( $value>=$threshold ) {
				# mark for deletion
				foreach ( $delete_addresses[$key] as $delnum ) imap_delete( $conn, $delnum );
			} //if failed more than $delete times
	  	} //foreach
	  	# delete messages
		imap_expunge($conn);

		# close
		imap_close($conn);
	}
}
$maintClass = 'BounceHandlerClearance';
if( defined('RUN_MAINTENANCE_IF_MAIN') ) {
  require_once( RUN_MAINTENANCE_IF_MAIN );
} else {
  require_once( DO_MAINTENANCE ); # Make this work on versions before 1.17
}