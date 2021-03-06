<?php
namespace Drahak\Restful\Mapping;

use Nette\Utils\Json;
use Nette\Utils\JsonException;

/**
 * JsonMapper
 * @package Drahak\Restful\Mapping
 * @author Drahomír Hanák
 */
class JsonMapper implements IMapper
{
    use \Nette\SmartObject;

	/**
	 * Convert array or Traversable input to string output response
	 * @param array|\Traversable $data
	 * @param bool $prettyPrint
	 * @return mixed
	 *
	 * @throws MappingException
	 */
	public function stringify($data, $prettyPrint = TRUE)
	{
		try {
			return Json::encode($data, $prettyPrint && defined('Nette\\Utils\\Json::PRETTY') ? Json::PRETTY : 0);
		} catch(JsonException $e) {
			throw new MappingException('Error in parsing response: ' . $e->getMessage());
		}
	}

	/**
	 * Convert client request data to array or traversable
	 * @param string $data
	 * @return array 
	 *
	 * @throws MappingException
	 */
	public function parse($data)
	{
		try {
			return Json::decode($data, Json::FORCE_ARRAY);
		} catch (JsonException $e) {
			throw new MappingException('Error in parsing request: ' . $e->getMessage());
		}
	}

}
