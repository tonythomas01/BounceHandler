<?php
/* Extension to handle bounces in MediaWiki
*/
$wgExtensionCredits['validextensionclass'][] = array(
    'path' => __FILE__,
    'name' => 'BounceHandler',
    'author' => 'Tony Thomas', 
    'url' => 'https://github.com/tonythomas01/BounceHandler', 
    'description' => 'This extension helps in handling email bounces for medaiwiki',
    'version'  => 1.0,
    'license-name' => "GPL V2.0",   // Short name of the license, links LICENSE or COPYING file if existing - string, added in 1.23.0
);
/* Setup*/
$dir = dirname( __FILE__ ) . '/';
$dirbasename = basename( $dir );

//Autoload Files 
$wgAutoloadClasses['SpecialBounceHandler'] = $dir . '/specials/SpecialBounceHandler.php';

/*Messages Files */
$wgMessagesDirs['BounceHandler'] = __DIR__ . '/i18n';
$wgExtensionMessagesFiles['BounceHandler'] = $dir . 'InputBox.i18n.php';

// Register special pages
// See also http://www.mediawiki.org/wiki/Manual:Special_pages
$wgSpecialPages['BounceHandler'] = 'SpecialBounceHandler';
$wgSpecialPageGroups['BounceHandler'] = 'other';

// Enable Welcome
// Example of a configuration setting to enable the 'Welcome' feature:
$wgExampleEnableWelcome = true;


?>