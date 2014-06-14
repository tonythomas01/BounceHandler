<?php 
/** Hooks used by BounceHandler
*/

class BounceHandlerHooks { 

	public static function onVERPAddressGenerate( )	{
		return "someone@example.com";
	}
}