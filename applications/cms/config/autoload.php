<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$autoload['packages'] = array();
$autoload['libraries'] = array('database', 'session', 'user_agent');
$autoload['drivers'] = array();
$autoload['helper'] = array('url', 'cookie', 'form', 'security');
$autoload['config'] = array('countries', 'nationalities');
$autoload['language'] = array();
$autoload['model'] = array('model_session');