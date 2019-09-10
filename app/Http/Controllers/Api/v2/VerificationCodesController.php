<?php

namespace App\Http\Controllers\Api\v2;

use Illuminate\Http\Request;
use App\Http\Controllers\Api\Controller;

class VerificationCodesController extends Controller
{
        public function store()
    {
        return $this->response->array(['test_message' => 'v2 store verification code']);
    }
}
