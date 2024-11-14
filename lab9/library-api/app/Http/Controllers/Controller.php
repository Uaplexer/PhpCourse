<?php


namespace App\Http\Controllers;

use App\Http\Exceptions\ValidationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

abstract class Controller
{
    protected ?string $model = null;

    /**
     * @throws ValidationException
     */
    protected static function validateData(array $data, array $validation_rules): array
    {
        $validator = Validator::make($data, $validation_rules);

        if ($validator->fails()) {
            throw new ValidationException($validator->errors());
        }

        return $validator->validated();
    }

    public function getAll(): JsonResponse
    {
        return response()->json($this->model::all(), ResponseAlias::HTTP_OK);
    }

    public function getById(int $id)
    {
        return response()->json($this->model::findOrFail($id), ResponseAlias::HTTP_OK);
    }

    /**
     * @throws ValidationException
     */
    public function create(Request $request, array $validation_rules): JsonResponse
    {
        $data = $this->validateData($request->all(), $validation_rules);

        $obj = $this->model::create($data);

        return response()->json($obj, ResponseAlias::HTTP_CREATED);
    }

    /**
     * @throws ValidationException
     */
    public function put(Request $request, int $id, array $validation_rules): JsonResponse
    {
        $data = $this->validateData($request->all(), $validation_rules);

        $obj = $this->model::findOrFail($id);

        $obj->update($data);

        return response()->json($obj, ResponseAlias::HTTP_OK);
    }

    public function delete($id): JsonResponse
    {
        $obj = $this->model::findOrFail($id);

        $obj->delete();

        return response()->json([
            'message' => 'Resource deleted successfully'
        ], ResponseAlias::HTTP_NO_CONTENT);
    }

}
