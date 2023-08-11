<?php

namespace App\Controllers;
use App\Models\DataControllerModel as DCM;
use Exception;

class Home extends BaseController {

    function __construct() {
        $this->DataController = new DataController();
    }

    public function index() {
        return view('dashboard/pages/index.php', $this->DataController->get_Widget_Data());
    }
}
