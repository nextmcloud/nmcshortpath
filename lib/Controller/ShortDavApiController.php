<?php

declare(strict_types=1);
/**
 * @copyright Copyright (c) 2021, T-Systems <bernd.rederlechner@t-systems.de>
 *
 * @author Bernd Rederlechner <bernd.rederlechner@t-systems.de>
 *
 * @license GNU AGPL version 3 or any later version
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License as
 * published by the Free Software Foundation, either version 3 of the
 * License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU Affero General Public License for more details.
 *̉
 * You should have received a copy of the GNU Affero General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 *
 */

namespace OCA\NextMagentaCloudShortPath\Controller;

use OCP\IRequest;
use OCP\ILogger;
use OCP\IUserSession;
use OCP\IURLGenerator;

use OCP\AppFramework\Controller;
use OCP\AppFramework\Http\DataResponse;
use OCP\AppFramework\Http;

use OCA\NextMagentaCloudShortPath\Server\ExtendedPathRequest;
use OCA\NextMagentaCloudShortPath\Server\SapiResultIgnorer;
use OCA\NextMagentaCloudShortPath\Server\XMLAppResponse;
use OCA\NextMagentaCloudShortPath\AppInfo\Application;

/**
 * Simple endpoint to easily testing bearer implementation
 * from outside server installation
 */
class ShortDavApiController extends Controller {

	/** @var ILogger */
	private $logger;
	
	/** @var IUserSession */
	private $userSession;

	/** @var IURLGenerator */
	private $urlGenerator;

	public function __construct($appName,
							IRequest $request,
							ILogger $logger,
							IUserSession $userSession,
							IURLGenerator $urlGenerator) {
		parent::__construct($appName, $request);
		$this->logger = $logger;
		$this->userSession = $userSession;
		$this->urlGenerator = $urlGenerator;
	}

	/**
	 * Get the request Url extended by user specific files path for the service
	 */
	protected function requestUri(string $uid, string $shortpath) : string {
		$extPath = $this->urlGenerator->linkToRoute(Application::APP_ID . '.ShortDavApi.dav_get',
															[ 'shortpath' => '/files/' . $uid . $shortpath]);
		$this->logger->debug("Extended URI is " . $extPath);
		return $extPath;
	}

	/**
	 * Get the baseURI for the service
	 * For this app, base url is the app path only
	 */
	protected function baseUri() : string {
		//
		return $this->urlGenerator->linkToRoute(Application::APP_ID . '.ShortDavApi.dav_get', [ 'shortpath' => '' ]);
	}


	/**
	 * Simply redirect a path without userid to a full file path including userid.
	 * Test before whether the path is a valid user file path (no redirect) or
	 * not (add userid)
	 *
	 * Called with
	 * https://<server>//apps/nmcshortpath/1.0/redav/<shortpath>,
	 * it redirects after auth to
	 * https://<server>/remote.php/dav/files/<userid>/<shortpath>
	 */
	public function processDav(string $shortpath) {
		$user = $this->userSession->getUser();
		if (!is_null($user)) {
			// this is the adopted code from dav app
			// appinfo/v2/remote.php

			// no php execution timeout for webdav
			if (strpos(@ini_get('disable_functions'), 'set_time_limit') === false) {
				@set_time_limit(0);
			}
			ignore_user_abort(true);

			// Turn off output buffering to prevent memory problems
			\OC_Util::obEnd();

			// here is where the magic happens: we silently add user files repo path incl. userid
			$extRequest = new ExtendedPathRequest($this->requestURI($user->getUID(), $shortpath),
												$this->request, $this->logger, $this->urlGenerator);
			$server = new \OCA\DAV\Server($extRequest, $this->baseUri());
			$response = new \Sabre\HTTP\Response();
			$server->server->httpResponse = $response;
			$server->server->sapi = new SapiResultIgnorer();
			$server->exec();
			return new XMLAppResponse(strval($response->getBody()), $response->getStatus(), $response->getHeaders());
		} else {
			return new Response("Unauthorized short path", Http::STATUS_UNAUTHORIZED, []);
		}
	}

	/**
	 * @NoCSRFRequired
	 * @NoAdminRequired
	 * @param string $shortpath
	 */
	public function davGet(string $shortpath) {
		return $this->processDav($shortpath);
	}


	/**
	 * @NoCSRFRequired
	 * @NoAdminRequired
	 * @param string $shortpath
	 */
	public function davOptions(string $shortpath) {
		return $this->processDav($shortpath);
	}

	/**
	 * @NoCSRFRequired
	 * @NoAdminRequired
	 * @param string $shortpath
	 */
	public function davHead(string $shortpath) {
		return $this->processDav($shortpath);
	}

	/**
	 * @NoCSRFRequired
	 * @NoAdminRequired
	 * @param string $shortpath
	 */
	public function davDelete(string $shortpath) {
		return $this->processDav($shortpath);
	}

	/**
	 * @NoCSRFRequired
	 * @NoAdminRequired
	 * @param string $shortpath
	 */
	public function davPropfind(string $shortpath) {
		return $this->processDav($shortpath);
	}

	/**
	 * @NoCSRFRequired
	 * @NoAdminRequired
	 * @param string $shortpath
	 */
	public function davPut(string $shortpath) {
		return $this->processDav($shortpath);
	}

	/**
	 * @NoCSRFRequired
	 * @NoAdminRequired
	 * @param string $shortpath
	 */
	public function davProppatch(string $shortpath) {
		return $this->processDav($shortpath);
	}

	/**
	 * @NoCSRFRequired
	 * @NoAdminRequired
	 * @param string $shortpath
	 */
	public function davCopy(string $shortpath) {
		return $this->processDav($shortpath);
	}

	/**
	 * @NoCSRFRequired
	 * @NoAdminRequired
	 * @param string $shortpath
	 */
	public function davMove(string $shortpath) {
		return $this->processDav($shortpath);
	}

	/**
	 * @NoCSRFRequired
	 * @NoAdminRequired
	 * @param string $shortpath
	 */
	public function davReport(string $shortpath) {
		return $this->processDav($shortpath);
	}
}
