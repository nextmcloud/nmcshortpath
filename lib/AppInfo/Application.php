<?php

namespace OCA\NextMagentaCloudShortPath\AppInfo;

use OCP\ILogger;

use OCP\AppFramework\App;
use OCP\AppFramework\Bootstrap\IBootContext;
use OCP\AppFramework\Bootstrap\IBootstrap;
use OCP\AppFramework\Bootstrap\IRegistrationContext;

class Application extends App implements IBootstrap {
	public const APP_ID = 'nmcshortpath';


	public function __construct() {
		parent::__construct(self::APP_ID);
	}

	public function register(IRegistrationContext $context): void {
		// Register the composer autoloader for packages shipped by this app, if applicable
		//include_once __DIR__ . '/../../vendor/autoload.php';
	}

	/**
	 * The boot method seems to be called cyclic in developer mode,
	 * so we cannot use it for SLUP registration on boot
	 */
	public function boot(IBootContext $context): void {
	}
}
