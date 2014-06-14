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
    'license-name' => "GPL V2.0",
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
$wgHooks['UserMailerChangeFromAddress'][] = 'BounceHandlerHooks::onVERPAddressGenerate';

/**
 * Mediawiki VERP Configurations
 * Set to true to enable the e-mail VERP features:
 * wgEnableVERP - Engales VERP for bounce handling
 * wgVERPalgo - Algorithm to hash the return path address.Possible algorithms are
 * md2. md4, md5, sha1, sha224, sha256, sha384, ripemd128, ripemd160, whirlpool and more.
 * wgVERPsecret - The secret key to hash the return path address
 */
$wgEnableVERP = true;
$wgVERPalgo = 'md5';
$wgVERPsecret = 'MediaiwkiVERP';