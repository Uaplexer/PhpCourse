<?php

namespace App\Http\Controllers;

use App\Http\Exceptions\ValidationException;
use App\Http\Validators\GenresValidator;
use App\Models\Genres;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
class GenresController extends Controller
{
    public function __construct()
    {
        $this->model = Genres::class;
    }

    /**
     * @throws ValidationException
     */
    public function store(Request $request): JsonResponse
    {
        return $this->create($request, GenresValidator::$rules);
    }
    /**
     * @throws ValidationException
     */
    public function update(Request $request, int $id): JsonResponse
    {
        return $this->put($request, $id, GenresValidator::$rules);
    }
}
