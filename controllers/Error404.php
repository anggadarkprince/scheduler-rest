<?php

namespace controllers;

use lib\MVC\Controller\BaseController;

class Error404 extends BaseController
{

    protected function index()
    {
        $viewModel = "Page Not Found";
        $this->RenderView($viewModel, false);
    }

}
