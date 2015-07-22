<?php
class Template {
	public static $data;

	public static function setData($key = false, $value) {
		if ($key == false) {
			self::$data = $value;
		} else {
			self::$data[$key] = $value;
		}
	}

	public static function getData($key = false) {
		return $key ? self::$data[$key] : self::$data;
	}

    public static function path() {

        return base_url() . self::$data['tpl']['url_theme'];
    }

	public static function addCss($path) {
        $path = array($path);
        self::$data['tpl']['css'] = array_merge_recursive(self::$data['tpl']['css'], $path);
    }

    public static function addJs($path, $bottom = TRUE) {
    	$path = array($path);

    	if ($bottom) 
    		self::$data['tpl']['jsBottom'] = array_merge_recursive(self::$data['tpl']['jsBottom'], $path);
    	else 
    		self::$data['tpl']['jsTop'] = array_merge_recursive(self::$data['tpl']['jsBottom'], $path);
    }

    public static function log($code, $message) {
    	self::$data['log'][$code][] = $message;
    }

    public static function viewLog($code = false) {
    	if (!isset(self::$data['log'])) {
    		return;
    	}
    	$log = '<pre>';
    	if ($code) {
    		foreach (self::$data['log'][$code] as $message) {
    			$log .= "<div>$code: $message<div>";
    			
    		}
    	} else {
    		foreach (self::$data['log'] as $code => $messages) {
    			if ($messages) {
    				foreach ($messages as $message) {
	    				$log .= "<div>$code: $message<div>";
	    			}
    			}
    		}
    	}
    	$log .= '</pre>';
    	echo $log;
    }
}