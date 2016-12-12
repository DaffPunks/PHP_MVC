<?php

/**
 *
 */
class Route
{
    private $requestArrayGET = [];
    private $requestArrayPOST = [];

    private static $_instance = null;

    //private blocks initializing through constructor
    private function __construct()
    {
        // приватный конструктор ограничивает реализацию getInstance ()
    }

    //Singleton Pattern realisation
    static public function getInstance()
    {
        if (is_null(self::$_instance)) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    function start()
    {
        $controllerName = null;
        $actionName = null;

        //get URL without params
        $requestUrl = strtok($_SERVER["REQUEST_URI"], '?');

        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            foreach ($this->requestArrayGET as $requestGET) {
                if ($requestGET["url"] == $requestUrl) {
                    $controllerName = $requestGET["controller"];
                    $actionName = $requestGET["action"];
                }
            }
        } else
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            foreach ($this->requestArrayPOST as $request) {
                if ($request["url"] == $requestUrl) {
                    $controllerName = $request["controller"];
                    $actionName = $request["action"];
                }
            }
        }

        if ($controllerName == null && $actionName == null) {
            echo "Not Found Http Route";
        }

            $controllerFile = $controllerName . '.php';
        $controllerPath = "../app/Controllers/" . $controllerFile;
        if (file_exists($controllerPath)) {

            include $controllerPath;

        } else {

            echo "Controller does not exist";

        }

        $controller = new $controllerName;

        if (method_exists($controller, $actionName)) {

            $controller->$actionName();
        } else {

            echo "Action does not exist";
        }

    }

    public function GET($requestUrl, $controller)
    {
        $action = explode('@', $controller);

        $this->requestArrayGET[] = [
            "url" => $requestUrl,
            "controller" => $action[0],
            "action" => $action[1]
        ];
    }

    public function POST($requestUrl, $controller)
    {
        $action = explode('@', $controller);

        $this->requestArrayPOST[] = [
            "url" => $requestUrl,
            "controller" => $action[0],
            "action" => $action[1]
        ];
    }

}
