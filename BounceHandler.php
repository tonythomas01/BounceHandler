<?php
/* BounceHandler Extension to handle email bounces in MediaWiki
*/
$wgExtensionCredits['other'][] = array(
	'path' => __FILE__,
	'name' => 'BounceHandler',
	'author' => array(
			'Tony Thomas',
			'Legoktm',
			'Jeff Green',
		),
	'url' => "https://github.com/wikimedia/mediawiki-extensions-BounceHandler", 
	'descriptionmsg' => 'bouncehandler-desc',
	'version'  => '1.0',
	'license-name' => "GPL V2.0",
);

/* Setup*/
$dir = __DIR__ ;

//Hooks files
$wgAutoloadClasses['BounceHandlerHooks'] =  $dir. '/BounceHandlerHooks.php';

//Register Hooks
$wgHooks['VERPAddressGenerate'][] = 'BounceHandlerHooks::onVERPAddressGenerate';

/*Messages Files */
$wgMessagesDirs['BounceHandler'] = $dir. '/i18n';
$wgExtensionMessagesFiles['BounceHandlerAlias'] = $dir . '/BounceHandler.alias.php';

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
$wgIMAPuser = '';
$wgIMAPpass = '';
$wgIMAPserver = '{localhost:143/novalidate-cert}';