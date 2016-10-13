<?php

namespace DI\Container;

use DI\Exceptions\ConfigFileNotFoundException;
use DI\Exceptions\ServiceDoesNotExistException;
use DI\Exceptions\ClassNotFoundException;
use DI\Exceptions\InvalidSettingsException;

class DIResolver
{
	/**
	 * Information about the classes that are needed for the depedenchy Injection
	 * @var array
	 */
	private $diClasses=array();
	
	/**
	 * @param string $configfile The path of the json file in order to setup the depedency Injection 
	 */
	public function __construct($configfile)
	{
		if(!file_exists($configfile))
		{
			throw new ConfigFileNotFoundException('The config file '.$configfile.'does not exist');
		}
		
		$this->diClasses=json_decode($configfile,true);
	}
	
	/**
	 * @param string $name The name of the service
	 * @return Object
	 */
	public function get($name)
	{
		$classtoReturn=null;
		
		if(!isset($this->diClasses[$name]))
		{
			throw new ServiceDoesNotExistException($name);	
		}
		
		$itemToInject= $this->diClasses[$name];
		
		//Validating the classes
		if(!isset($itemToInject['class']))
		{
			throw new InvalidSettingsException("For service $name is not defined a valid value for 'class' ");						
		}
		else if(!is_string($itemToInject['class']))
		{
			throw new InvalidSettingsException("For service $name is not defined a valid value for 'class' ");
		}
		else if(!class_exists($itemToInject['class']))
		{
			throw new ClassNotFoundException($itemToInject['class']);
		}
			
		//Loading Depedencies
		$depedencies=array();
	
		if(isset($itemToInject['depedencies']))
		{
			if(!is_array($itemToInject['depedencies']))
			{
				throw new InvalidSettingsException("The 'depedencies' of service $name must be a valid json array");				
			}
			
			foreach($itemToInject['depedencies'] as $depedency)
			{
				$depedencies[]=$this->get($depedency);
			}	
		}
		
		$classtoReturn= new \ReflectionClass($itemToInject['class']);
		return $classtoReturn->newInstanceArgs($depedencies);
	}
	
}