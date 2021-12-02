<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BaseController extends Controller
{
    // Обработка успешного запроса
    public function sendSuccess($data, $message)
    {
        $result =  new Result('200', true, $data, $message);
        return response($result, 500);
    }

    // Обработка ошибки запроса
    public function sendError($exception, $message)
    {
        $result = new Result('404', false, null, $message . ' ' . $exception->getMessage());
        return response()->json($result);
    }
}

// Класс ответа клиенту
class Result {
    public $status;
    public $success;
    public $data;
    public $message;

    public function __construct($status, $success, $data, $message)
    {
        $this->status = $status;
        $this->success =$success;
        $this->data = $data;
        $this->message = $message;
    }
}

