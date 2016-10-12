<?php

namespace DI\Exceptions;

class ClassNotFoundException extends \Exception
{
	public function __construct($classname)
	{
		parent::__construct("The class $classname does not exist");
	}
}
