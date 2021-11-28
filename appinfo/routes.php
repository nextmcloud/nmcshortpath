<?php

declare(strict_types=1);
/**
 * @copyright Copyright (c) 2020, Roeland Jago Douma <roeland@famdouma.nl>
 *
 * @author Bernd Rederlechner <bernd.rederlechner@t-systems.com>
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
 *
 * You should have received a copy of the GNU Affero General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 *
 */

return [
	'routes' => [
	    [ 'name' => 'RedirectDavApi#dav_options', 'url' => '/1.0/redav{shortpath}', 'verb' => 'OPTIONS', 'requirements' => ['shortpath' => '.*']],
        [ 'name' => 'RedirectDavApi#dav_get', 'url' => '/1.0/redav{shortpath}', 'verb' => 'GET', 'requirements' => ['shortpath' => '.*']], 
        [ 'name' => 'RedirectDavApi#dav_head', 'url' => '/1.0/redav{shortpath}', 'verb' => 'HEAD', 'requirements' => ['shortpath' => '.*']], 
        [ 'name' => 'RedirectDavApi#dav_delete', 'url' => '/1.0/redav{shortpath}', 'verb' => 'DELETE', 'requirements' => ['shortpath' => '.*']], 
        [ 'name' => 'RedirectDavApi#dav_propfind', 'url' => '/1.0/redav{shortpath}', 'verb' => 'PROPFIND', 'requirements' => ['shortpath' => '.*']], 
        [ 'name' => 'RedirectDavApi#dav_put', 'url' => '/1.0/redav{shortpath}', 'verb' => 'PUT', 'requirements' => ['shortpath' => '.*']], 
        [ 'name' => 'RedirectDavApi#dav_proppatch', 'url' => '/1.0/redav{shortpath}', 'verb' => 'PROPPATH', 'requirements' => ['shortpath' => '.*']], 
        [ 'name' => 'RedirectDavApi#dav_copy', 'url' => '/1.0/redav{shortpath}', 'verb' => 'COPY', 'requirements' => ['shortpath' => '.*']], 
        [ 'name' => 'RedirectDavApi#dav_move', 'url' => '/1.0/redav{shortpath}', 'verb' => 'MOVE', 'requirements' => ['shortpath' => '.*']], 
        [ 'name' => 'RedirectDavApi#dav_report', 'url' => '/1.0/redav{shortpath}', 'verb' => 'MOVE', 'requirements' => ['shortpath' => '.*']], 
        // unused VERBS
        //[ 'name' => 'ShortDavApi#dav_post', 'url' => '/1.0/sdav, 'verb' => 'POST'], 
        //[ 'name' => 'ShortDavApi#dav_patch', 'url' => '/1.0/sdav', 'verb' => 'PATCH'], 
        //[ 'name' => 'ShortDavApi#dav_lock', 'url' => '/1.0/sdav, 'verb' => 'LOCK', 
        //[ 'name' => 'ShortDavApi#dav_unlock', 'url' => '/1.0/sdav', 'verb' => 'UNLOCK'], 
        //[ 'name' => 'ShortDavApi#dav_mkcol', 'url' => '/1.0/sdav', 'verb' => 'MKCOL'], 
	    [ 'name' => 'ShortDavApi#dav_options', 'url' => '/1.0/sdav{shortpath}', 'verb' => 'OPTIONS', 'requirements' => ['shortpath' => '.*']],
        [ 'name' => 'ShortDavApi#dav_get', 'url' => '/1.0/sdav{shortpath}', 'verb' => 'GET', 'requirements' => ['shortpath' => '.*']], 
        [ 'name' => 'ShortDavApi#dav_head', 'url' => '/1.0/sdav{shortpath}', 'verb' => 'HEAD', 'requirements' => ['shortpath' => '.*']], 
        [ 'name' => 'ShortDavApi#dav_delete', 'url' => '/1.0/sdav{shortpath}', 'verb' => 'DELETE', 'requirements' => ['shortpath' => '.*']], 
        [ 'name' => 'ShortDavApi#dav_propfind', 'url' => '/1.0/sdav{shortpath}', 'verb' => 'PROPFIND', 'requirements' => ['shortpath' => '.*']], 
        [ 'name' => 'ShortDavApi#dav_put', 'url' => '/1.0/sdav{shortpath}', 'verb' => 'PUT', 'requirements' => ['shortpath' => '.*']], 
        [ 'name' => 'ShortDavApi#dav_proppatch', 'url' => '/1.0/sdav{shortpath}', 'verb' => 'PROPPATH', 'requirements' => ['shortpath' => '.*']], 
        [ 'name' => 'ShortDavApi#dav_copy', 'url' => '/1.0/sdav{shortpath}', 'verb' => 'COPY', 'requirements' => ['shortpath' => '.*']], 
        [ 'name' => 'ShortDavApi#dav_move', 'url' => '/1.0/sdav{shortpath}', 'verb' => 'MOVE', 'requirements' => ['shortpath' => '.*']], 
        [ 'name' => 'ShortDavApi#dav_report', 'url' => '/1.0/sdav{shortpath}', 'verb' => 'MOVE', 'requirements' => ['shortpath' => '.*']], 
	]
];
