<?php

namespace Middlewares;

use Src\Request;
use function Collect\collection; // 👈 ДОБАВЬ ЭТО

class JSONMiddleware
{
    public function handle(Request $request): Request
    {
        if ($request->method !== 'POST') {
            return $request;
        }

        $data = json_decode(file_get_contents("php://input"), true) ?? [];

        collection($data)->each(function ($value, $key) use ($request) {
            $request->set($key, $value);
        });

        return $request;
    }
}
