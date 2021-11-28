<?php
/**
 * @copyright Copyright (c) 2021 T-Systems
 *
 * @author Bernd Rederlechner <bernd.rederlechner@t-systems.com>
 *
 * @license AGPL-3.0
 *
 * This code is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License, version 3,
 * as published by the Free Software Foundation.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU Affero General Public License for more details.
 *
 * You should have received a copy of the GNU Affero General Public License, version 3,
 * along with this program. If not, see <http://www.gnu.org/licenses/>
 *
 */
namespace OCA\NextMagentaCloudShortPath\Server;

use OCP\AppFramework\Http;
use OCP\AppFramework\Http\Response;

/**
 * A renderer for JSON calls
 * @since 6.0.0
 */
class XMLAppResponse extends Response {

	/**
	 * response data
	 * @var array|object
	 */
	protected $data;


	/**
	 * constructor of XMLResponse
	 * @param string XML $data as plain string
	 * @param int $statusCode the Http status code, defaults to 200
	 * @since 6.0.0
	 */
	public function __construct($data = [], $statusCode = Http::STATUS_OK,
                                array $headers = []) {
		parent::__construct();

		$this->data = $data;
		$this->setStatus($statusCode);
        
        foreach ($headers as $key => $value) {
            if (is_array($value)) {
                $this->addHeader($key, \implode(', ', $value));
            } else {
                $this->addHeader($key, $value);
            }
        }
	}


	/**
	 * Returns the rendered json
	 * @return string the rendered json
	 * @since 6.0.0
	 * @throws \Exception If data could not get encoded
	 */
	public function render() {
		return $this->data;
	}

	/**
	 * Sets values in the data json array
	 * @param string Ready serialized XML data as string
     */
	public function setData($data) {
		$this->data = $data;

		return $this;
	}


	/**
	 * Used to get the set parameters
	 * @return string the  XML data
	 * @since 6.0.0
	 */
	public function getData() {
		return $this->data;
	}
}
