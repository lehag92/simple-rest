<?php
namespace Rest\Controllers;

class MainController
{

    /**
     * Array for allowed request type for routes
     *
     * @var array
     */
    protected $allowedRoutes = [
        'simple' => [
            'addresses' => ['GET'],
        ],
        'combine' => [
            'addresses' => ['GET', 'POST'],
        ]
    ];

    public function __construct($type, $route, $data)
    {
        $routeParts = array_filter(explode('/', $route));
        if ($this->checkRoute($routeParts)) {
            $this->processRouting($type, $routeParts, $data);
        }
    }

    protected function processRouting($type, $routeParts, $data)
    {
        switch (count($routeParts)) {
            //One part route (simple)
            case 1:
                $this->doSimleRoute($type, $routeParts);
                break;
            //Two part route
            case 2:
                $this->doCombineRoute($type, $routeParts, $data);
                break;
            default:
                ResponseController::sendResponse(405, 'Not Allowed!');
                break;
        }
    }

    protected function checkRoute($routeParts)
    {
        //Allow route only for one or two parts
        if (empty($routeParts) || count($routeParts) > 2) {
            ResponseController::sendResponse(404, 'Not found!');
            return false;
        }
        return true;
    }

    protected function doSimleRoute($type, $routeParts)
    {
        if (isset($this->allowedRoutes['simple'][$routeParts[0]])
            && in_array($type, $this->allowedRoutes['simple'][$routeParts[0]])
        ) {
            new ListController();
        } else {
            ResponseController::sendResponse(405, 'Not Allowed!');
        }
    }

    protected function doCombineRoute($type, $routeParts, $data)
    {
        if (isset($this->allowedRoutes['combine'][$routeParts[0]])
            && in_array($type, $this->allowedRoutes['combine'][$routeParts[0]])
            && is_numeric($routeParts[1])
            && strpos( $routeParts[1], '.') == false
        ) {
            switch ($type) {
                case 'GET':
                    $controller = new GetController($routeParts[1]);
                    $controller->get();
                    break;
                case 'POST':
                    $controller = new EditController($routeParts[1], $data);
                    $controller->edit();
                    break;
                default:
                    ResponseController::sendResponse(405, 'Not Allowed!');
                    break;
            }
        } else {
            ResponseController::sendResponse(405, 'Not Allowed!');
        }
    }
}
