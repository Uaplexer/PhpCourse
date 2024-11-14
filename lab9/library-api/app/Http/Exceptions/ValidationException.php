<?php


namespace App\Http\Exceptions;

use Exception;
use Illuminate\Contracts\Support\MessageBag;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\Validator;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class ValidationException extends Exception
{
    protected MessageBag $errors;

    public function __construct(MessageBag $errors)
    {
        parent::__construct('Validation Error', ResponseAlias::HTTP_BAD_REQUEST);
        $this->errors = $errors;
    }

    public function render(): JsonResponse
    {
        return response()->json([
            'status' => 'error',
            'errors' => $this->errors
        ], ResponseAlias::HTTP_BAD_REQUEST);
    }
}
