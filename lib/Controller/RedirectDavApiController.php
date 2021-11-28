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
use OCP\AppFramework\Http\RedirectResponse;
use OCP\AppFramework\Http\TemplateResponse;
use OCP\AppFramework\Http;

/**
 * Simple endpoint to easily testing bearer implementation
 * from outside server installation
 */
class RedirectDavApiController extends Controller {
	public const WEBDAV_DEFAULT_PREFIX = "/remote.php/dav/files/";

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
	 * Simply redirect a path without userid to a full file path including userid.
	 * Test before whether the path is a valid user file path (no redirect) or
	 * not (add userid)
	 *
	 * Called with
	 * https://<server>//apps/nmcshortpath/1.0/redav/<shortpath>,
	 * it redirects after auth to
	 * https://<server>/remote.php/dav/files/<userid>/<shortpath>
	 *
	 * @NoCSRFRequired
	 * @NoAdminRequired
	 *
	 * @param string $shortpath
	 */
	public function davGet(string $shortpath) {
		$this->logger->error("Adapt path " . $shortpath);
		$user = $this->userSession->getUser();
		if (!is_null($user)) {
			$username = $user->getUID();
			$params = $this->request->getParams();
			unset($params['shortpath']);
			unset($params['_route']);
			$path = self::WEBDAV_DEFAULT_PREFIX . $username . $shortpath;

			if (empty($params)) {
				$relativeUrl = $path;
			} else {
				$relativeUrl = $path . '?' . http_build_query($params);
			}
			$url = $this->urlGenerator->getAbsoluteURL($relativeUrl);
			$this->logger->error("Redirecting to " . $url);
			return new RedirectResponse($url);
		} else {
			return new TemplateResponse(Http::STATUS_UNAUTHORIZED, [], "Unauthorized short path");
		}
	}

	/**
	 * @NoCSRFRequired
	 * @NoAdminRequired
	 *
	 * @param string $shortpath
	 */
	public function davOptions(string $shortpath) {
		return $this->davGet($shortpath);
	}

	/**
	 * @NoCSRFRequired
	 * @NoAdminRequired
	 *
	 * @param string $shortpath
	 */
	public function davHead(string $shortpath) {
		return $this->davGet($shortpath);
	}

	/**
	 * @NoCSRFRequired
	 * @NoAdminRequired
	 *
	 * @param string $shortpath
	 */
	public function davDelete(string $shortpath) {
		return $this->davGet($shortpath);
	}

	/**
	 * @NoCSRFRequired
	 * @NoAdminRequired
	 *
	 * @param string $shortpath
	 */
	public function davPropfind(string $shortpath) {
		return $this->davGet($shortpath);
	}

	/**
	 * @NoCSRFRequired
	 * @NoAdminRequired
	 *
	 * @param string $shortpath
	 */
	public function davPut(string $shortpath) {
		return $this->davGet($shortpath);
	}

	/**
	 * @NoCSRFRequired
	 * @NoAdminRequired
	 *
	 * @param string $shortpath
	 */
	public function davProppatch(string $shortpath) {
		return $this->davGet($shortpath);
	}

	/**
	 * @NoCSRFRequired
	 * @NoAdminRequired
	 *
	 * @param string $shortpath
	 */
	public function davCopy(string $shortpath) {
		return $this->davGet($shortpath);
	}

	/**
	 * @NoCSRFRequired
	 * @NoAdminRequired
	 *
	 * @param string $shortpath
	 */
	public function davMove(string $shortpath) {
		return $this->davGet($shortpath);
	}

	/**
	 * @NoCSRFRequired
	 * @NoAdminRequired
	 *
	 * @param string $shortpath
	 */
	public function davReport(string $shortpath) {
		return $this->davGet($shortpath);
	}
}
