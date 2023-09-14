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



    public function getAll(): Paginator
    {
        return Conversation::orderBy('id', 'desc')
            ->paginate(10);
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
            // ->with('user')
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
            // ->with('user')
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
        if (!empty($data['image'])) {
            $titleShort = Str::slug(substr($data['title'], 0, 20));
            $data['image'] = UploadHelper::update('image', $data['image'], $titleShort . '-' . time(), 'images/tip', $conversation->image);
        } else {
           
        }

        if (is_null($conversation)) {
            return null;
        }

        // If everything is OK, then update.
        $conversation->update($data);

        // Finally return the updated tip.
        return $this->getByID($conversation->id);
    }
}
