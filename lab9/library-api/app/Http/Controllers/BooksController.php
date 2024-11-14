<?php

namespace App\Http\Controllers;

use App\Http\Exceptions\ValidationException;
use App\Http\Validators\BooksValidator;
use App\Models\Books;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class BooksController extends Controller
{
    public function __construct()
    {
        $this->model = Books::class;
    }

    /**
     * @throws ValidationException
     */
    public function store(Request $request): JsonResponse
    {
        return $this->create($request, BooksValidator::$rules);
    }

    /**
     * @throws ValidationException
     */
    public function update(Request $request, int $id): JsonResponse
    {
        return $this->put($request, $id, BooksValidator::$rules);
    }
}
