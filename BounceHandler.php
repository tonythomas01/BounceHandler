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


/**
 * VERP Configurations
 * wgEnableVERP - Engales VERP for bounce handling
 * wgVERPalgo - Algorithm to hash the return path address.Possible algorithms are
 * md2. md4, md5, sha1, sha224, sha256, sha384, ripemd128, ripemd160, whirlpool and more.
 * wgVERPsecret - The secret key to hash the return path address
 */
$wgEnableVERP = false;
$wgVERPalgo = 'md5';
$wgVERPsecret = 'MediaiwkiVERP';

/* IMAP configs */
$wgIMAPuser = 'user';
$wgIMAPpass = 'pass';
$wgIMAPserver = '{localhost:143/novalidate-cert}';