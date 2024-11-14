<?php

namespace App\Http\Controllers;

use App\Http\Exceptions\ValidationException;
use App\Http\Validators\AuthorsValidator;
use App\Models\Authors;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AuthorsController extends Controller
{
    public function __construct()
    {
        $this->model = Authors::class;
    }

    /**
     * @throws ValidationException
     */
    public function store(Request $request): JsonResponse
    {
        return $this->create($request, AuthorsValidator::$rules);
    }

    /**
     * @throws ValidationException
     */
    public function update(Request $request, int $id): JsonResponse
    {
        return $this->put($request, $id, AuthorsValidator::$rules);
    }
}
