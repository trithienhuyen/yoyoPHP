<?php
namespace Core\Loader;

/**
* 
*/
class TemplateLoader 
{
	
	public function load($template, $data = array()) 
    {
        extract($data);
        ob_start();
        require_once TEMPLATE.$template.'.php';
        $content = ob_get_contents();
        ob_end_clean();
        return $content;
    }
}