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
        return $this->user->exercises()
          ->orderBy('id', 'desc')
            ->with('user')
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
            ->with('user')
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
            ->with('user')
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
            $data['image'] = UploadHelper::upload('image', $data['image'], $titleShort . '-' . time(), 'images/exercises');
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
        $exercise = Tips::find($id);
        if (empty($exercise)) {
            return false;
        }

     // UploadHelper::deleteFile('images/exercise/' . $exercise->image);
        $exercise->delete($exercise);
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
        return Tips::with('user')->find($id);
    }

    /**
     * Update Tip By ID.
     *
     * @param int $id
     * @param array $data
     * @return object Updated Tip Object
     */
    public function getTipsByLessonID($course_id, $unit_id, $lesson_id)
    {
        $exercises = Tips::where('lesson_id', $lesson_id)
            ->where('course_id', $course_id)
            ->where('unit_id', $unit_id)
            ->get();
    
        if ($exercises->isEmpty()) {
            // If no exercises are found, you can return an appropriate response
            return response()->json(['message' => 'No exercises found for the specified parameters'], 404);
        }
    
        return $exercises;
    }
    


    public function update(int $id, array $data): Tips|null
    {
        $exercise = Tips::find($id);
        if (!empty($data['image'])) {
            $titleShort = Str::slug(substr($data['title'], 0, 20));
            $data['image'] = UploadHelper::update('image', $data['image'], $titleShort . '-' . time(), 'images/exercise', $exercise->image);
        } else {
           
        }

        if (is_null($exercise)) {
            return null;
        }

        // If everything is OK, then update.
        $exercise->update($data);

        // Finally return the updated exercise.
        return $this->getByID($exercise->id);
    }
}
