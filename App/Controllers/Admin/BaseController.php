<?php

namespace App\Controllers\Admin;

use App\Helpers\Session;
use Core\Controller;

class BaseController extends Controller
{
    public function before(string $action): bool
    {
        if (!Session::isUser()) {
            redirect('');
        }

        return true;
    }
}