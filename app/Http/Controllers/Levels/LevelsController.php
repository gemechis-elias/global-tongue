<?php

namespace App\Http\Controllers\Levels;

use App\Http\Controllers\Controller;
use App\Repositories\LevelRepository;
use Illuminate\Http\Request;
use App\Http\Requests\LevelRequest;
use OpenApi\Annotations as OA; 
use App\Traits\ResponseTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;



class LevelsController extends Controller
{
    use ResponseTrait;
       /**
     * Exercise Repository class.
     *
     * @var LevelRepository
     */
    public  $levelRepository;

    public function __construct(LevelRepository $levelRepository)
    {
        $this->middleware('auth:api', ['except' => ['indexAll']]);
        $this->levelRepository = $levelRepository;
    }

    /**
     * @OA\Get(
     *     path="/v1/public/api/levels",
     *     tags={"Levels"},
     *     summary="Get Level List",
     *     description="Get Level List as Array",
     *     operationId="indexLevel",
     *     security={{"bearer":{}}},
     *     @OA\Response(response=200,description="Get Level List as Array"),
     *     @OA\Response(response=400, description="Bad request"),
     *     @OA\Response(response=404, description="Resource Not Found"),
     * )
     */
    public function index(): JsonResponse
    {
        try {
            $data = $this->levelRepository->getAll();
            return $this->responseSuccess($data, 'Level List Fetch Successfully !');
        } catch (\Exception $e) {
            return $this->responseError(null, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * @OA\Get(
     *     path="/v1/public/api/levels/view/all",
     *     tags={"Levels"},
     *     summary="All Levels - Publicly Accessible",
     *     description="All Levels - Publicly Accessible",
     *     operationId="indexAllLevel",
     *     @OA\Parameter(name="perPage", description="perPage, eg; 20", example=20, in="query", @OA\Schema(type="integer")),
     *     @OA\Response(response=200, description="All Levels - Publicly Accessible" ),
     *     @OA\Response(response=400, description="Bad request"),
     *     @OA\Response(response=404, description="Resource Not Found"),
     * )
     */
    public function indexAll(Request $request): JsonResponse
    {
        try {
            $data = $this->levelRepository->getPaginatedData($request->perPage);
            return $this->responseSuccess($data, 'Level List Fetched Successfully !');
        } catch (\Exception $e) {
            return $this->responseError(null, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * @OA\Get(
     *     path="/v1/public/api/levels/view/search",
     *     tags={"Levels"},
     *     summary="All Levels - Publicly Accessible",
     *     description="All Levels - Publicly Accessible",
     *     operationId="searchLevel",
     *     @OA\Parameter(name="perPage", description="perPage, eg; 20", example=20, in="query", @OA\Schema(type="integer")),
     *     @OA\Parameter(name="search", description="search, eg; Test", example="Test", in="query", @OA\Schema(type="string")),
     *     @OA\Response(response=200, description="All Levels - Publicly Accessible" ),
     *     @OA\Response(response=400, description="Bad request"),
     *     @OA\Response(response=404, description="Resource Not Found"),
     * )
     */
    public function search(Request $request): JsonResponse
    {
        try {
            $data = $this->levelRepository->searchLevel($request->search, $request->perPage);
            return $this->responseSuccess($data, 'Level List Fetched Successfully !');
        } catch (\Exception $e) {
            return $this->responseError(null, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * @OA\Post(
     *     path="/v1/public/api/levels",
     *     tags={"Levels"},
     *     summary="Create New Level",
     *     description="Create New Level",
     *     operationId="storeLevel",
     *     @OA\RequestBody(
     *          @OA\JsonContent(
     *              type="object",
     *             @OA\Property(property="name", type="string", example="Spanish Level 1"),
     *             @OA\Property(property="description", type="string", example="Learn words and phrases for greetings and introductions, eating at a restaurant, shopping, family, and travel. Study professions, hobbies, pronunciation of -r versus -rr, and subject pronouns and learn when to use tú versus usted."),
     *             @OA\Property(property="tag", type="string", example="Ser, Gender, Gustar, Estar, Plurals,"),
     *             @OA\Property(property="level", type="string", example="Level 1"),
     *            @OA\Property(property="type", type="string", example="free"),
     *          ),
     *      ),
     *      security={{"bearer":{}}},
     *      @OA\Response(response=200, description="Create New Level" ),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     * )
     */
    public function store(LevelRequest $request): JsonResponse
    {
        try {
            $product = $this->levelRepository->create($request->all());
            return $this->responseSuccess($product, 'New Level Created Successfully !');
        } catch (\Exception $exception) {
            return $this->responseError(null, $exception->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * @OA\Get(
     *     path="/v1/public/api/levels/{level_id}",
     *     tags={"Levels"},
     *     summary="Show Level Details",
     *     description="Show Level Details",
     *     operationId="showLevel",
     *     security={{"bearer":{}}},
     *     @OA\Parameter(name="id", description="id, eg; 1", required=true, in="path", @OA\Schema(type="integer")),
     *     @OA\Response(response=200, description="Show Level Details"),
     *     @OA\Response(response=400, description="Bad request"),
     *     @OA\Response(response=404, description="Resource Not Found"),
     * )
     */
    public function show($id): JsonResponse
    {
        try {
            $data = $this->levelRepository->getByID($id);
            if (is_null($data)) {
                return $this->responseError(null, 'Level Not Found', Response::HTTP_NOT_FOUND);
            }

            return $this->responseSuccess($data, 'Level Details Fetch Successfully !');
        } catch (\Exception $e) {
            return $this->responseError(null, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * @OA\Put(
     *     path="/v1/public/api/levels/{id}",
     *     tags={"Levels"},
     *     summary="Update Level",
     *     description="Update Level",
     *     @OA\Parameter(name="id", description="id, eg; 1", required=true, in="path", @OA\Schema(type="integer")),
     *     @OA\RequestBody(
     *          @OA\JsonContent(
     *              type="object",
     *             @OA\Property(property="name", type="string", example="Spanish Level 1"),
     *             @OA\Property(property="description", type="string", example="Learn words and phrases for greetings and introductions, eating at a restaurant, shopping, family, and travel. Study professions, hobbies, pronunciation of -r versus -rr, and subject pronouns and learn when to use tú versus usted."),
     *             @OA\Property(property="tag", type="string", example="Ser, Gender, Gustar, Estar, Plurals,"),
     *             @OA\Property(property="level", type="string", example="Level 1"),
     *             @OA\Property(property="type", type="string", example="free"),
     *          ),
     *      ),
     *     operationId="updateLevel",
     *     security={{"bearer":{}}},
     *     @OA\Response(response=200, description="Update Level"),
     *     @OA\Response(response=400, description="Bad request"),
     *     @OA\Response(response=404, description="Resource Not Found"),
     * )
     */
    public function update(LevelRequest $request, $id): JsonResponse
    {
        try {
            $data = $this->levelRepository->update($id, $request->all());
            if (is_null($data))
                return $this->responseError(null, 'Level Not Found', Response::HTTP_NOT_FOUND);

            return $this->responseSuccess($data, 'Level Updated Successfully !');
        } catch (\Exception $e) {
            return $this->responseError(null, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * @OA\Delete(
     *     path="/v1/public/api/levels/{id}",
     *     tags={"Levels"},
     *     summary="Delete Level",
     *     description="Delete Level",
     *     operationId="destroyLevel",
     *     security={{"bearer":{}}},
     *     @OA\Parameter(name="id", description="id, eg; 1", required=true, in="path", @OA\Schema(type="integer")),
     *     @OA\Response(response=200, description="Delete Level"),
     *     @OA\Response(response=400, description="Bad request"),
     *     @OA\Response(response=404, description="Resource Not Found"),
     * )
     */
    public function destroy($id): JsonResponse
    {
        try {
            $product =  $this->levelRepository->getByID($id);
            if (empty($product)) {
                return $this->responseError(null, 'Level Not Found', Response::HTTP_NOT_FOUND);
            }

            $deleted = $this->levelRepository->delete($id);
            if (!$deleted) {
                return $this->responseError(null, 'Failed to delete the product.', Response::HTTP_INTERNAL_SERVER_ERROR);
            }

            return $this->responseSuccess($product, 'Level Deleted Successfully !');
        } catch (\Exception $e) {
            return $this->responseError(null, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
