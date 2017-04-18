<?php

class Dispatcher
{
    public function dispatch()
    {
        $params_tmp = array();
        $params_tmp = explode('?', $_SERVER['REQUEST_URI']);

        $params_tmp[0] = preg_replace('/^\/+/u', '', $params_tmp[0]);
        $params_tmp[0] = preg_replace('/\/+$/u', '', $params_tmp[0]);
 
        $params = array();
 
        if ('' != $params_tmp[0]) {
            $params = explode('/', $params_tmp[0]);
        }
       
        $controller = 'main';
        if (0 < count($params)) {
            $controller = $params[0];
        }

        switch ($controller) {
            case 'voicesearch':
                $className = 'VoiceSearch';
                break;
            case 'reserve':
            $className = 'Reserve';
                break;
            case 'tradeoff':
                $className = 'TradeOff';
                break;
            case 'login':
                $className = 'Login';
                break;
            default:
                $className = 'Main';
                break;
        }

        $className = $className . 'Controller';
        require_once ROOT_PATH . '/Controller/' . $className . '.php';

        $url ="/";
        $controllerInstance = new $className($url);

        $action= 'index';
        if (1 < count($params)) {
            $action= $params[1];
        }

        $actionMethod = $action . 'Action';
        $controllerInstance->$actionMethod();
    }
}
