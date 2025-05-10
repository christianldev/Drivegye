<?php

/**
 * Image Handler Interface
 *
 * @package     NewTaxi Prime
 * @subpackage  Contracts
 * @category    Image Handler
 * @author      Seen Technologies
 * @version     1.1.0
 * @link        https://seentechs.com
*/

namespace App\Contracts;

interface ImageHandlerInterface
{
	public function upload($image, $options);
	public function delete($image, $options);
	public function getImage($file_name, $options);
}