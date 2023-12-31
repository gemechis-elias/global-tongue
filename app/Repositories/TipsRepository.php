<?php

namespace App\Repositories;

use Illuminate\Support\Str;
use App\Helpers\UploadHelper;
use App\Interfaces\CrudInterface;
use App\Models\Tips;
use App\Models\User;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;

class TipsRepository implements CrudInterface
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
     * Get All Tip.
     *
     * @return collections Array of Tip Collection
     */
    public function getAll(): Paginator
    {
        return Tips::orderBy('id', 'desc')
            // ->with('user')
            ->paginate(10);
    }

    /**
     * Get Paginated Tip Data.
     *
     * @param int $pageNo
     * @return collections Array of Tip Collection
     */
    public function getPaginatedData($perPage): Paginator
    {
        $perPage = isset($perPage) ? intval($perPage) : 12;
        return Tips::orderBy('id', 'desc')
            // ->with('user')
            ->paginate($perPage);
    }

    /**
     * Get Searchable Tip Data with Pagination.
     *
     * @param int $pageNo
     * @return collections Array of Tip Collection
     */
    public function searchTip($keyword, $perPage): Paginator
    {
        $perPage = isset($perPage) ? intval($perPage) : 10;

        return Tips::where('question', 'like', '%' . $keyword . '%')
            ->orWhere('instruction', 'like', '%' . $keyword . '%') 
            ->orderBy('id', 'desc')
            // ->with('user')
            ->paginate($perPage);
    }

    /**
     * Create New Tip.
     *
     * @param array $data
     * @return object Tip Object
     */
    public function create(array $data): Tips
    {
        $titleShort      = Str::slug(substr($data['question'], 0, 20));

        if (!empty($data['image'])) {
            $data['image'] = UploadHelper::upload('image', $data['image'], $titleShort . '-' . time(), 'images/tips');
        }

        $data['user_id'] = $this->user->id;

        return Tips::create($data);
    }

    /**
     * Delete Tip.
     *
     * @param int $id
     * @return boolean true if deleted otherwise false
     */
    public function delete(int $id): bool
    {
        $tip = Tips::find($id);
        if (empty($tip)) {
            return false;
        }

     // UploadHelper::deleteFile('images/tip/' . $tip->image);
        $tip->delete($tip);
        return true;
    }

    /**
     * Get Tip Detail By ID.
     *
     * @param int $id
     * @return void
     */
    public function getByID(int $id): Tips|null
    {
        $tip =Tips::with('user')->find($id);
        if ($tip) {
            $user = $this->user;
    
            // Check if $user exists and has 'completed_tips' property
            if ($user && isset($user->completed_tips)) {
                

                // Update the user's my_tips attribute by adding the current tip ID
                $CompletedTip = json_decode($user->completed_tips, true) ?? [];
                if (!in_array($id, $CompletedTip)) {
                    $CompletedTip[] = $id;
                    $user->completed_tips = json_encode($CompletedTip);
                    $user->save();
                }
                
            } 
            return $tip;
        }
    
        return null;
    }

    /**
     * Update Tip By ID.
     *
     * @param int $id
     * @param array $data
     * @return object Updated Tip Object
     */
    public function getTipsByLessonID($course_id,$level_id, $unit_id, $lesson_id)
    {
        $tips = Tips::where('lesson_id', $lesson_id)
            ->where('course_id', $course_id)
            ->where('level_id', $level_id)
            ->where('unit_id', $unit_id)
            ->get();
    
        if ($tips->isEmpty()) {
            // If no tips are found, you can return an appropriate response
            return response()->json(['message' => 'No tips found for the specified parameters'], 404);
        }
    
        return $tips;
    }
    


    public function update(int $id, array $data): Tips|null
    {
        $tip = Tips::find($id);
        if (!empty($data['image'])) {
            $titleShort = Str::slug(substr($data['title'], 0, 20));
            $data['image'] = UploadHelper::update('image', $data['image'], $titleShort . '-' . time(), 'images/tip', $tip->image);
        } else {
           
        }

        if (is_null($tip)) {
            return null;
        }

        // If everything is OK, then update.
        $tip->update($data);

        // Finally return the updated tip.
        return $this->getByID($tip->id);
    }
}
