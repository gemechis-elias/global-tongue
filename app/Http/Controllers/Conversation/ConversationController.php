<?php

namespace App\Http\Controllers\Conversation;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\ConversationRepository;
use App\Http\Requests\ConversationRequest;
use OpenApi\Annotations as OA; 
use App\Traits\ResponseTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
class ConversationController extends Controller
{
    
        use ResponseTrait;
    /**
     * Conversation Repository class.
     *
     * @var ConversationRepository
     */
    public $conversationRepository;

        public function __construct(ConversationRepository $conversationRepository)
        {
            
            $this->middleware('auth:api', ['except' => ['indexAll']]);
            $this->conversationRepository = $conversationRepository;
        }
    
    
            /**
         * @OA\Get(
         *     path="/v1/public/api/conversations",
         *     tags={"Conversations"},
         *     summary="Get All Conversation List",
         *     description="Get Conversation List as Array",
         *     operationId="ConversationIndex",
         *     security={{"bearer":{}}},
         *     @OA\Response(response=200,description="Get Conversation List as Array"),
         *     @OA\Response(response=400, description="Bad request"),
         *     @OA\Response(response=404, description="Resource Not Found"),
         * )
         */
        public function index(): JsonResponse
        {
            try {
                $data = $this->conversationRepository->getAll();
                return $this->responseSuccess($data, 'Conversation List Fetch Successfully !');
            } catch (\Exception $e) {
                return $this->responseError(null, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
            }
        }
    
            /**
         * @OA\Get(
         *     path="/v1/public/api/conversations/{id}",
         *     tags={"Conversations"},
         *     summary="Show Conversation Details",
         *     description="Show Conversation Details",
         *     operationId="showConversation",
         *     security={{"bearer":{}}},
         *     @OA\Parameter(name="id", description="id, eg; 1", required=true, in="path", @OA\Schema(type="integer")),
         *     @OA\Response(response=200, description="Show Conversation Details"),
         *     @OA\Response(response=400, description="Bad request"),
         *     @OA\Response(response=404, description="Resource Not Found"),
         * )
         */
        public function show($id): JsonResponse
        {
            try {
                $data = $this->conversationRepository->getByID($id);
                if (is_null($data)) {
                    return $this->responseError(null, 'Conversation Not Found', Response::HTTP_NOT_FOUND);
                }
    
                return $this->responseSuccess($data, 'Conversation Details Fetch Successfully !');
            } catch (\Exception $e) {
                return $this->responseError(null, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
            }
        }
    
       /**
         * @OA\Get(
         *     path="/v1/public/api/conversations/by/{course_id}/{$level_id}/{unit_id}/{lesson_id}",
         *     tags={"Conversations"},
         *     summary="Get Conversations by Parents",
         *     description="Get list of conversations associated with a specific Parents",
         *     operationId="getConversationsByLessonID",
         *     security={{"bearer":{}}},
         *     @OA\Parameter(name="course_id", description="ID of the course", required=true, in="path", @OA\Schema(type="integer")),
         *    @OA\Parameter(name="level_id", description="ID of the level", required=true, in="path", @OA\Schema(type="integer")),
         *     @OA\Parameter(name="unit_id", description="ID of the unit", required=true, in="path", @OA\Schema(type="integer")),
         *     @OA\Parameter(name="lesson_id", description="ID of the lesson", required=true, in="path", @OA\Schema(type="integer")),
         *     @OA\Response(response=200, description="Conversations for the specified Parents ID"),
         *     @OA\Response(response=400, description="Bad request"),
         *     @OA\Response(response=404, description="No Conversations found for the specified Parents ID"),
         *     @OA\Response(response=500, description="Internal Server Error")
         * )
         */

    
        public function getConversationsByLessonID($course_id,$level_id, $unit_id, $lesson_id): JsonResponse
            {
                try {
                    $conversations = $this->conversationRepository->getConversationsByLessonID($course_id,$level_id, $unit_id, $lesson_id);
                    
                    if ($conversations->isEmpty()) {
                        return $this->responseError(null, 'No conversations Found for the given Lesson ID', Response::HTTP_NOT_FOUND);
                    }
    
                    return $this->responseSuccess($conversations, 'Conversations for Lesson ID ' . $lesson_id . ' Fetched Successfully !');
                } catch (\Exception $e) {
                    return $this->responseError(null, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
                }
            }
    
 

       /**
 * @OA\Post(
 *     path="/v1/public/api/conversations",
 *     tags={"Conversations"},
 *     summary="Create New Conversation",
 *     description="Create New Conversation",
 *     operationId="storeConversation",
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="course_id", type="integer", example=1),
 *             @OA\Property(property="unit_id", type="integer", example=1),
 *             @OA\Property(property="level_id", type="integer", example=1),
 *             @OA\Property(property="lesson_id", type="integer", example=1),
 *             @OA\Property(property="conversation_type", type="string", example="Type A"),
 *             @OA\Property(property="instruction", type="string", example="Instructions here"),
 *            @OA\Property(property="conversation", type="string", example="[{'name':'John','text':'Hello'}], [{'name':'John','text':'Hello'}]"),
 * 
 *         ),
 *     ),
 *     security={{"bearer":{}}},
 *     @OA\Response(response=200, description="Create New Conversation"),
 *     @OA\Response(response=400, description="Bad request"),
 *     @OA\Response(response=404, description="Resource Not Found"),
 * )
 */
public function store(ConversationRequest $request): JsonResponse
{
    try {
        $conversation = $this->conversationRepository->create($request->all());
        return $this->responseSuccess($conversation, 'New Conversation Created Successfully !');
    } catch (\Exception $exception) {
        return $this->responseError(null, $exception->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
    }
}
/**
 * @OA\Put(
 *     path="/v1/public/api/conversations/{id}",
 *     tags={"Conversations"},
 *     summary="Update Conversation",
 *     description="Update New Conversation",
 *     operationId="updateConversation",
 *     @OA\Parameter(name="id", description="id, eg; 1", required=true, in="path", @OA\Schema(type="integer")),
 * 
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="course_id", type="integer", example=1),
 *             @OA\Property(property="unit_id", type="integer", example=1),
 *             @OA\Property(property="level_id", type="integer", example=1),
 *             @OA\Property(property="lesson_id", type="integer", example=1),
 *             @OA\Property(property="conversation_type", type="string", example="Type A"),
 *             @OA\Property(property="instruction", type="string", example="Instructions here"),
 *            @OA\Property(property="conversation", type="string", example="[{'name':'John','text':'Hello'}], [{'name':'John','text':'Hello'}]"),
 * 
 *         ),
 *     ),
 *     security={{"bearer":{}}},
 *     @OA\Response(response=200, description="Updated Conversation"),
 *     @OA\Response(response=400, description="Bad request"),
 *     @OA\Response(response=404, description="Resource Not Found"),
 * )
 */
    public function update(ConversationRequest $request, $id): JsonResponse
    {
        try {
            $data = $this->conversationRepository->update($id, $request->all());
            if (is_null($data))
                return $this->responseError(null, 'Conversation Not Found', Response::HTTP_NOT_FOUND);

            return $this->responseSuccess($data, 'Conversation Updated Successfully !');
        } catch (\Exception $e) {
            return $this->responseError(null, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * @OA\Delete(
     *     path="/v1/public/api/conversations/{id}",
     *     tags={"Conversations"},
     *     summary="Delete Conversations",
     *     description="Delete Conversations",
     *     operationId="destroyConversations",
     *     security={{"bearer":{}}},
     *     @OA\Parameter(name="id", description="id, eg; 1", required=true, in="path", @OA\Schema(type="integer")),
     *     @OA\Response(response=200, description="Delete Conversations"),
     *     @OA\Response(response=400, description="Bad request"),
     *     @OA\Response(response=404, description="Resource Not Found"),
     * )
     */
    public function destroy($id): JsonResponse
    {
        try {
            $conversation =  $this->conversationRepository->getByID($id);
            if (empty($conversation)) {
                return $this->responseError(null, 'Conversation Not Found', Response::HTTP_NOT_FOUND);
            }

            $deleted = $this->conversationRepository->delete($id);
            if (!$deleted) {
                return $this->responseError(null, 'Failed to delete the conversation.', Response::HTTP_INTERNAL_SERVER_ERROR);
            }

            return $this->responseSuccess($conversation, 'Conversation Deleted Successfully !');
        } catch (\Exception $e) {
            return $this->responseError(null, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

}
    