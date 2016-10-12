<?php

namespace DI\Exceptions;

class ServiceDoesNotExistException extends \Exception
{
	public function ___construct($servicename)
	{
		parent::___construct("The service $servicename does not exist")
	}
}
