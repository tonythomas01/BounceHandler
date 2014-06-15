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
$dir = dirname( __FILE__ );
$dirbasename = basename( $dir );

//Autoload Files 
$wgAutoloadClasses['SpecialBounceHandler'] = $dir . '/specials/SpecialBounceHandler.php';
//Hooks files 
$wgAutoloadClasses['BounceHandlerHooks'] =  $dir. '/BounceHandler.hooks.php';

/*Messages Files */
$wgMessagesDirs['BounceHandler'] = $dir. '/i18n';
$wgExtensionMessagesFiles['BounceHandler'] = $dir . '/BounceHandler.alias.php';

// Register special pages
// See also http://www.mediawiki.org/wiki/Manual:Special_pages
$wgSpecialPages['BounceHandler'] = 'SpecialBounceHandler';
$wgSpecialPageGroups['BounceHandler'] = 'other';

//Register Hooks
$wgHooks['VERPAddressGenerate'][] = 'BounceHandlerHooks::onVERPAddressGenerate';

# Schema updates for update.php
$wgHooks['LoadExtensionSchemaUpdates'][] = 'BounceHandlerHooks::AddTable';