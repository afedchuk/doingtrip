<?php

class CustomParseRequest extends CHttpRequest
{
	public function getCParam($name, $container = 'property_search', $defaultValue=null)
	{
		return isset($_GET[$container][$name]) ? $_GET[$container][$name] : (isset($_POST[$container][$name]) ? $_POST[$container][$name] : $defaultValue);
	}

    public function getParam($name,$defaultValue=null)
	{
		$data = parent::getParam($name, $defaultValue);
		$this->parseData($data);
		return $data;
	}
    
	public function getQuery($name,$defaultValue=null)
	{
		$data = parent::getQuery($name, $defaultValue);
		$this->parseData($data);
		return $data;
	}

	public function getPost($name,$defaultValue=null)
	{
		$data = parent::getPost($name, $defaultValue);
		$this->parseData($data);
		return $data;
	}

	/**
	 * Функция для приведения типов
	 */
	protected function parseData(&$data)
	{
		if (is_array($data)) {
			foreach ($data as &$prop) {
				$this->parseData($prop);
			}
		} else {
			if (preg_match("/^[\d]+$/", $data)) $data = (int)$data;
		}
	}
}

?>
