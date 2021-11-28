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

class SapiResultIgnorer extends \Sabre\HTTP\Sapi {
    
    public static function sendResponse(\Sabre\HTTP\ResponseInterface $response) {
        // we do noting with the result to avoid writing to the output streams
        // of PHP; we take it from the objects themselves

        // this avoids the famous problem of
        // Cannot modify header information - headers already sent by 
    }

};