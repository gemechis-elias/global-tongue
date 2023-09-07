<?php

namespace App\Http\Controllers\Tips;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\TipsRepository;
use App\Http\Requests\TipsRequest;
use OpenApi\Annotations as OA; 
use App\Traits\ResponseTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
class TipsController extends Controller
{
    
        use ResponseTrait;
    /**
     * Tips Repository class.
     *
     * @var TipsRepository
     */
    public $tipRepository;

        public function __construct(TipsRepository $tipRepository)
        {
            
            $this->middleware('auth:api', ['except' => ['indexAll']]);
            $this->tipRepository = $tipRepository;
        }
    
    
            /**
         * @OA\Get(
         *     path="/v1/public/api/tips",
         *     tags={"Tips"},
         *     summary="Get Tip List",
         *     description="Get Tip List as Array",
         *     operationId="TipIndex",
         *     security={{"bearer":{}}},
         *     @OA\Response(response=200,description="Get Tip List as Array"),
         *     @OA\Response(response=400, description="Bad request"),
         *     @OA\Response(response=404, description="Resource Not Found"),
         * )
         */
        public function index(): JsonResponse
        {
            try {
                $data = $this->tipRepository->getAll();
                return $this->responseSuccess($data, 'Tip List Fetch Successfully !');
            } catch (\Exception $e) {
                return $this->responseError(null, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
            }
        }
    
            /**
         * @OA\Get(
         *     path="/v1/public/api/tips/{id}",
         *     tags={"Tips"},
         *     summary="Show Tip Details",
         *     description="Show Tip Details",
         *     operationId="showTip",
         *     security={{"bearer":{}}},
         *     @OA\Parameter(name="id", description="id, eg; 1", required=true, in="path", @OA\Schema(type="integer")),
         *     @OA\Response(response=200, description="Show Tip Details"),
         *     @OA\Response(response=400, description="Bad request"),
         *     @OA\Response(response=404, description="Resource Not Found"),
         * )
         */
        public function show($id): JsonResponse
        {
            try {
                $data = $this->tipRepository->getByID($id);
                if (is_null($data)) {
                    return $this->responseError(null, 'Tip Not Found', Response::HTTP_NOT_FOUND);
                }
    
                return $this->responseSuccess($data, 'Tip Details Fetch Successfully !');
            } catch (\Exception $e) {
                return $this->responseError(null, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
            }
        }
    
       /**
         * @OA\Get(
         *     path="/v1/public/api/tips/by/{course_id}/{unit_id}/{lesson_id}",
         *     tags={"Tips"},
         *     summary="Get Tips by Parents",
         *     description="Get list of tips associated with a specific Parents",
         *     operationId="getTipsByLessonID",
         *     security={{"bearer":{}}},
         *     @OA\Parameter(name="course_id", description="ID of the course", required=true, in="path", @OA\Schema(type="integer")),
         *     @OA\Parameter(name="unit_id", description="ID of the unit", required=true, in="path", @OA\Schema(type="integer")),
         *     @OA\Parameter(name="lesson_id", description="ID of the lesson", required=true, in="path", @OA\Schema(type="integer")),
         *     @OA\Response(response=200, description="Tips for the specified Parents ID"),
         *     @OA\Response(response=400, description="Bad request"),
         *     @OA\Response(response=404, description="No Tips found for the specified Parents ID"),
         *     @OA\Response(response=500, description="Internal Server Error")
         * )
         */

    
        public function getTipsByLessonID($course_id, $unit_id, $lesson_id): JsonResponse
            {
                try {
                    $tips = $this->tipRepository->getTipsByLessonID($course_id, $unit_id, $lesson_id);
                    
                    if ($tips->isEmpty()) {
                        return $this->responseError(null, 'No tips Found for the given Lesson ID', Response::HTTP_NOT_FOUND);
                    }
    
                    return $this->responseSuccess($tips, 'Tips for Lesson ID ' . $lesson_id . ' Fetched Successfully !');
                } catch (\Exception $e) {
                    return $this->responseError(null, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
                }
            }
    
 

       /**
 * @OA\Post(
 *     path="/v1/public/api/tips/create",
 *     tags={"Tips"},
 *     summary="Create New Tip",
 *     description="Create New Tip",
 *     operationId="storeTip",
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="course_id", type="integer", example=1),
 *             @OA\Property(property="unit_id", type="integer", example=1),
 *             @OA\Property(property="level_id", type="integer", example=1),
 *             @OA\Property(property="lesson_id", type="integer", example=1),
 *             @OA\Property(property="tip_type", type="string", example="Type A"),
 *             @OA\Property(property="instruction", type="string", example="Instructions here"),
 *             @OA\Property(property="question", type="string", example="Question here"),
 *             @OA\Property(property="image", type="string", example="tip_image.jpg"),
 *             @OA\Property(property="voice", type="string", example="tip_voice.mp3"),
 *             @OA\Property(property="choices", type="string", example="Choice 1, Choice 2"),
 *             @OA\Property(property="incorrect_hint", type="string", example="Incorrect hint here"),
 *             @OA\Property(property="correct_answer", type="integer", example=1),
 *         ),
 *     ),
 *     security={{"bearer":{}}},
 *     @OA\Response(response=200, description="Create New Tip"),
 *     @OA\Response(response=400, description="Bad request"),
 *     @OA\Response(response=404, description="Resource Not Found"),
 * )
 */
public function store(TipRequest $request): JsonResponse
{
    try {
        $tip = $this->tipRepository->create($request->all());
        return $this->responseSuccess($tip, 'New Tip Created Successfully !');
    } catch (\Exception $exception) {
        return $this->responseError(null, $exception->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
    }
}

    /**
     * @OA\Delete(
     *     path="/v1/public/api/tips/{id}",
     *     tags={"Tips"},
     *     summary="Delete Tips",
     *     description="Delete Tips",
     *     operationId="destroyTips",
     *     security={{"bearer":{}}},
     *     @OA\Parameter(name="id", description="id, eg; 1", required=true, in="path", @OA\Schema(type="integer")),
     *     @OA\Response(response=200, description="Delete Tips"),
     *     @OA\Response(response=400, description="Bad request"),
     *     @OA\Response(response=404, description="Resource Not Found"),
     * )
     */
    public function destroy($id): JsonResponse
    {
        try {
            $tip =  $this->tipRepository->getByID($id);
            if (empty($tip)) {
                return $this->responseError(null, 'Tip Not Found', Response::HTTP_NOT_FOUND);
            }

            $deleted = $this->tipRepository->delete($id);
            if (!$deleted) {
                return $this->responseError(null, 'Failed to delete the tip.', Response::HTTP_INTERNAL_SERVER_ERROR);
            }

            return $this->responseSuccess($tip, 'Tip Deleted Successfully !');
        } catch (\Exception $e) {
            return $this->responseError(null, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

}
    