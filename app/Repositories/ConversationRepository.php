<?php

namespace App\Repositories;

use Illuminate\Support\Str;
use App\Helpers\UploadHelper;
use App\Interfaces\CrudInterface;
use App\Models\Conversation;
use App\Models\User;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;

class ConversationRepository implements CrudInterface
{
    /**
     * Authenticated User Instance.
     *
     * @var User
     */
    public User | null $user;

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->user = Auth::guard()->user();
    }

    /**
     * Get All Conversation.
     *
     * @return collections Array of Conversation Collection
     */

     function encodeConversation(array $conversationData): string
     {
         // Encode the conversation data as a JSON string
         $encodedConversation = json_encode($conversationData);
     
         if ($encodedConversation === false) {
             // Handle JSON encoding error here, if needed
             throw new \RuntimeException('Failed to encode conversation data as JSON.');
         }
     
         return $encodedConversation;
     }

     public function getAll(): Paginator
     {
         $conversations = Conversation::orderBy('id', 'desc')
             ->paginate(100);
     
         // Iterate through the retrieved conversations and decode the "conversations" field
         $conversations->getCollection()->transform(function ($conversation) {
             $conversation->conversations = $this->decodeConversation($conversation->conversations);
             return $conversation;
         });
     
         return $conversations;
     }
     

    /**
     * Get Paginated Conversation Data.
     *
     * @param int $pageNo
     * @return collections Array of Conversation Collection
     */
    public function getPaginatedData($perPage): Paginator
    {
        $perPage = isset($perPage) ? intval($perPage) : 12;
        return Conversation::orderBy('id', 'desc')
            
            ->paginate($perPage);
    }

    /**
     * Get Searchable Conversation Data with Pagination.
     *
     * @param int $pageNo
     * @return collections Array of Conversation Collection
     */
    public function searchConversation($keyword, $perPage): Paginator
    {
        $perPage = isset($perPage) ? intval($perPage) : 10;

        return Conversation::where('question', 'like', '%' . $keyword . '%')
            ->orWhere('instruction', 'like', '%' . $keyword . '%') 
            ->orderBy('id', 'desc')
            ->paginate($perPage);
    }

    /**
     * Create New Conversation.
     *
     * @param array $data
     * @return object Conversation Object
     */


    public function create(array $data): Conversation
    {
        // Encode the "conversations" field
        $data['conversations'] = $this->encodeConversation($data['conversations']);
    
        // Set the user_id to the current user's ID
        $data['user_id'] = $this->user->id;
    
        return Conversation::create($data);
    }
    

    /**
     * Delete Conversation.
     *
     * @param int $id
     * @return boolean true if deleted otherwise false
     */
    public function delete(int $id): bool
    {
        $conversation = Conversation::find($id);
        if (empty($conversation)) {
            return false;
        }

     // UploadHelper::deleteFile('images/tip/' . $conversation->image);
        $conversation->delete($conversation);
        return true;
    }

    /**
     * Get Conversation Detail By ID.
     *
     * @param int $id
     * @return void
     */
    function decodeConversation($conversation) {
        // Remove the escaping slashes from the JSON string
        $conversation = stripslashes($conversation);
    
        // Decode the JSON string into an associative array
        $decodedData = json_decode($conversation, true);
    
        if ($decodedData === null && json_last_error() !== JSON_ERROR_NONE) {
            // JSON decoding error occurred
            return ["error" => json_last_error_msg()];
        } else {
            // Return the decoded data as an associative array
            return $decodedData;
        }
    }
    public function getByID(int $id): Conversation|null
    {
        $conversation = Conversation::find($id);
    
        if (!is_null($conversation)) {
            // Decode the "conversations" field
            $conversation->conversations = $this->decodeConversation($conversation->conversations);
        }
    
        return $conversation;
    }
    

    /**
     * Update Conversation By ID.
     *
     * @param int $id
     * @param array $data
     * @return object Updated Conversation Object
     */
    public function getConversationsByLessonID($course_id,$level_id, $unit_id, $lesson_id)
    {
        $conversation = Conversation::where('lesson_id', $lesson_id)
            ->where('course_id', $course_id)
            ->where('level_id', $level_id)
            ->where('unit_id', $unit_id)
            ->get();
    
        if ($conversation->isEmpty()) {
            return null;
        }
    
        return $conversation;
    }
    


    public function update(int $id, array $data): Conversation|null
    {
        $conversation = Conversation::find($id);
    
        if (is_null($conversation)) {
            return null;
        }
    
        // Encode the "conversations" data before updating
        if (isset($data['conversations'])) {
            $data['conversations'] = $this->encodeConversation($data['conversations']);
        }
    
        // If everything is OK, then update.
        $conversation->update($data);
    
        // Finally return the updated conversation.
        return $this->getByID($conversation->id);
    }
    
}
