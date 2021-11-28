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

namespace OCA\NextMagentaCloudShortPath\Server;

use OCP\IRequest;
use OCP\ILogger;
use OCP\IURLGenerator;

/**
 * An adapter pattern implementation for the original request
 * to adopt path with user id
 */
class ExtendedPathRequest implements IRequest {

	/** @var IRequest */
	private $request;

	/** @var ILogger */
	private $logger;

	/** @var IURLGenerator */
	private $urlGenerator;

	public function __construct(string $filespath,
                                IRequest $request,
								ILogger $logger,
								IURLGenerator $urlGenerator) {
		
        $this->filespath = $filespath;
        $this->request = $request;
		$this->logger = $logger;
		$this->urlGenerator = $urlGenerator;
	}

	public function getHeader(string $name): string {
		return $this->request->getHeader($name) ;
	}

	public function getParam(string $key, $default = null) {
		return $this->request->getParam($key, $default);
	}

	public function getParams(): array {
    	$params = $this->request->getParams();
	    unset($params['shortpath']);
	    //unset($params['_route']);
		return $params;
	}

	public function getMethod(): string {
		return $this->request->getMethod();
	}

	public function getUploadedFile(string $key) {
		return $this->request->getUploadedFile($key);
	}

	public function getEnv(string $key) {
		return $this->request->getEnv($key);
	}

	public function getCookie(string $key) {
		return $this->request->getCookie($key);
	}

	public function passesCSRFCheck(): bool {
		return $this->request->passesCSRFCheck();
	}

	public function passesStrictCookieCheck(): bool {
		return $this->request->passesStrictCookieCheck();
	}

	public function passesLaxCookieCheck(): bool {
		return $this->request->passesLaxCookieCheck();
	}

	public function getId(): string {
		return $this->request->getId();
	}

	public function getRemoteAddress(): string {
		return $this->request->getRemoteAddress();
	}

	public function getServerProtocol(): string {
		return $this->request->getServerProtocol();
	}

	public function getHttpProtocol(): string {
		return $this->request->getHttpProtocol();
	}

	public function getRequestUri(): string {
        $this->logger->debug("getRequestUri(): " . $this->request->getRequestUri() . " extended to " . $this->filespath);
		return $this->filespath;
	}

	public function getRawPathInfo(): string {
        $this->logger->warning("getRawPathInfo(): " . $this->request->getRawPathInfo());
		return $this->request->getRawPathInfo();
	}

	public function getPathInfo() {
        $this->logger->warning("getPathInfo(): " . $this->request->getPathInfo());
		return $this->request->getPathInfo();
	}

	public function getScriptName(): string {
		return $this->request->getScriptName();
	}

	public function isUserAgent(array $agent): bool {
		return $this->request->isUserAgent($agent);
	}

	public function getInsecureServerHost(): string {
		return $this->request->getInsecureServerHost();
	}

	public function getServerHost(): string {
		return $this->request->getServerHost();
	}
}
