<?php

namespace App\Responses;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Support\Responsable;
class ApiResponse  implements Responsable
{

    protected  $message;
    protected int $code;
    protected string $error;

    public function __construct(int $code, $message,string $error=""  )
    {
        $this->message = $message;
        $this->code = $code;
        $this->error = $error;
    }
    public  function toResponse($request): \Illuminate\Http\JsonResponse {
        $data =  match (true) {
            $this->code >= 500 => ['error_message' =>  $this->error],
            $this->code >= 400 => ['error_message' => $this->error],
            $this->code >= 200 => ['message' => $this->message],
            $this->code >= 422 => ['error_message' => 'Error validation'],
        };
        return response()->json(
            data: $data,
            status: $this->code,
            options: JSON_UNESCAPED_UNICODE
        );
    }
}
