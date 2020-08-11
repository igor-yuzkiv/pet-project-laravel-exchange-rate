<?php


namespace App\Http\Controllers\Traits;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Route;

trait ControllerTrait
{
    private $viewSimpleForm  = "Backend.layouts.simple_form";

    /**
     * @param $result
     * @param null $routeSuccess
     * @param null $routeError
     * @param null $successMessage
     * @param null $errorMessage
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    private function returnResultRedirectWithMessage($result, $routeSuccess = null, $routeError = null, $successMessage = null, $errorMessage = null)
    {
        $successMessage = ($successMessage === null) ? trans("basic.messages.success") : $successMessage;
        $errorMessage = ($errorMessage === null) ? [trans("basic.messages.error")] : $errorMessage;

        if ($result) {
            return ($routeSuccess !== null)
                ? redirect()->route($routeSuccess)->with("message", $successMessage)
                : redirect()->back()->with("message", $successMessage);
        }else {
            return ($routeSuccess !== null)
                ? redirect()->route($routeError)->with("message", $errorMessage)
                : redirect()->back()->with("message", $errorMessage);
        }
    }

    public function returnResultRedirectWithJson() {

    }

}
