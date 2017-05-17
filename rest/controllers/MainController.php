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
            'addresses' => ['GET', 'POST', 'PUT', 'DELETE'],
        ]
    ];

    public function __construct($type, $route, $data)
    {
        $routeParts = array_filter(explode('/', $route));
        if($this->checkRoute($routeParts)){
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
                ResponceController::sendResponce(405, 'Not Allowed!');
                break;
        }

    }

    protected function checkRoute($routeParts)
    {
        //Allow route only for one or two parts
        if (empty($routeParts) || count($routeParts) > 2) {
            ResponceController::sendResponce(404, 'Not found!');
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
            ResponceController::sendResponce(405, 'Not Allowed!');
        }
    }

    protected function doCombineRoute($type, $routeParts, $data)
    {
        if (isset($this->allowedRoutes['combine'][$routeParts[0]])
            && in_array($type, $this->allowedRoutes['combine'][$routeParts[0]])
            && is_numeric($routeParts[1])
        ) {
            switch ($type) {
                case 'GET':

                    break;
                case 'POST':

                    break;
                case 'PUT':

                    break;
                case 'DELETE':

                    break;

                default:
                    break;
            }
        } else {
            ResponceController::sendResponce(405, 'Not Allowed!');
        }
    }
}
