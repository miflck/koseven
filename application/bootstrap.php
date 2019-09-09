<?php defined('SYSPATH') or die('No direct script access.');

// -- Environment setup --------------------------------------------------------

// Load the core Kohana class
require SYSPATH.'classes/Kohana/Core'.EXT;

if (is_file(APPPATH.'classes/Kohana'.EXT))
{
	// Application extends the core
	require APPPATH.'classes/Kohana'.EXT;
}
else
{
	// Load empty core extension
	require SYSPATH.'classes/Kohana'.EXT;
}

/**
 * Set the default time zone.
 *
 * @see  http://kohanaframework.org/guide/using.configuration
 * @see  http://php.net/timezones
 */
date_default_timezone_set('Europe/Zurich');

/**
 * Set the default locale.
 *
 * @see  http://kohanaframework.org/guide/using.configuration
 * @see  http://php.net/setlocale
 */
setlocale(LC_ALL, 'de_DE.utf-8');

/**
 * Enable the Kohana auto-loader.
 *
 * @see  http://kohanaframework.org/guide/using.autoloading
 * @see  http://php.net/spl_autoload_register
 */
spl_autoload_register(array('Kohana', 'auto_load'));
spl_autoload_register(array('Kohana', 'auto_load_lowercase'));

/**
 * Enable the Kohana auto-loader for unserialization.
 *
 * @see  http://php.net/spl_autoload_call
 * @see  http://php.net/manual/var.configuration.php#unserialize-callback-func
 */
ini_set('unserialize_callback_func', 'spl_autoload_call');

// -- Configuration and initialization -----------------------------------------

/**
 * Set the default language
 */
I18n::lang('en-us');

/**
 * Set Kohana::$environment if a 'KOHANA_ENV' environment variable has been supplied.
 *
 * Note: If you supply an invalid environment name, a PHP warning will be thrown
 * saying "Couldn't find constant Kohana::<INVALID_ENV_NAME>"
 */
if (isset($_SERVER['KOHANA_ENV']))
{
	Kohana::$environment = constant('Kohana::'.strtoupper($_SERVER['KOHANA_ENV']));
}

/**
 * Initialize Kohana, setting the default options.
 *
 * The following options are available:
 *
 * - string   base_url    path, and optionally domain, of your application   NULL
 * - string   index_file  name of your index file, usually "index.php"       index.php
 * - string   charset     internal character set used for input and output   utf-8
 * - string   cache_dir   set the internal cache directory                   APPPATH/cache
 * - boolean  errors      enable or disable error handling                   TRUE
 * - boolean  profile     enable or disable internal profiling               TRUE
 * - boolean  caching     enable or disable internal caching                 FALSE
 */
 

Kohana::$environment = Kohana::DEVELOPMENT;
//Kohana::$environment = Kohana::PRODUCTION;

Kohana::init(array(
	'base_url'	=> '/sigi_koseven',
	'index_file'=>	FALSE,
	'profile'    => Kohana::$environment !== Kohana::PRODUCTION,
	'caching'    => Kohana::$environment === Kohana::PRODUCTION,
	'errors'	=> TRUE,
));

/**
 * Attach the file write to logging. Multiple writers are supported.
 */
Kohana::$log->attach(new Log_File(APPPATH.'logs'));

/**
 * Attach a file reader to config. Multiple readers are supported.
 */
Kohana::$config->attach(new Config_File);

/**
 * Enable modules. Modules are referenced by a relative or absolute path.
 */
Kohana::modules(array(
	'cache'      => MODPATH.'cache',      // Caching with multiple backends
	'sigi_core'  	 => MODPATH.'sigi_core',  	  // THE MIGHTY MIGHTY SIGI!!!
	'sigi_backup'  	 => MODPATH.'sigi_backup',  	  // Sigi Backup Module!!!
	'auth'       => MODPATH.'auth',       // Basic authentication
	'database'   => MODPATH.'database',   // Database access
	'orm'        => MODPATH.'orm',        // Object Relationship Mapping
	'orm_mptt'   => MODPATH.'orm_mptt',   // Object Relationship Mapping
	'image'      => MODPATH.'image',      // Image manipulation
	'kohana-imagefly'   => MODPATH.'kohana-imagefly',
	'kohana-device'	=> MODPATH.'kohana-device' // device (mobile) detection
));
	

/**
* Cookie salt for remember user info
*/
Cookie::$salt = 'pooNie0Iechohk8si5iekaiwaeGhuem9';

/**
 * Execute the main request using PATH_INFO. If no URI source is specified,
 * the URI will be automatically detected.
 */
echo Request::factory()->execute()->send_headers()->body();