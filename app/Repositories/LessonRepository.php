<?php

namespace App\Repositories;

use Illuminate\Support\Str;
use App\Helpers\UploadHelper;
use App\Interfaces\CrudInterface;
use App\Models\Lesson;
use App\Models\User;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;

class LessonRepository implements CrudInterface
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
     * Get All Lesson.
     *
     * @return collections Array of Lesson Collection
     */
    public function getAll(): Paginator
    {
        return Lesson::orderBy('id', 'desc')
            // ->with('user')
            ->paginate(10);
    }

    /**
     * Get Paginated Lesson Data.
     *
     * @param int $pageNo
     * @return collections Array of Lesson Collection
     */
    public function getPaginatedData($perPage): Paginator
    {
        $perPage = isset($perPage) ? intval($perPage) : 12;
        return Lesson::orderBy('id', 'desc')
            // ->with('user')
            ->paginate($perPage);
    }

    /**
     * Get Searchable Lesson Data with Pagination.
     *
     * @param int $pageNo
     * @return collections Array of Lesson Collection
     */
    public function searchLesson($keyword, $perPage): Paginator
    {
        $perPage = isset($perPage) ? intval($perPage) : 10;

        return Lesson::where('title', 'like', '%' . $keyword . '%')
            ->orWhere('description', 'like', '%' . $keyword . '%') 
            ->orderBy('id', 'desc')
            // ->with('user')
            ->paginate($perPage);
    }

    /**
     * Create New Lesson.
     *
     * @param array $data
     * @return object Lesson Object
     */
    public function create(array $data): Lesson
    {
        $titleShort      = Str::slug(substr($data['title'], 0, 20));
        $data['user_id'] = $this->user->id;

    

        return Lesson::create($data);
    }

    /**
     * Delete Lesson.
     *
     * @param int $id
     * @return boolean true if deleted otherwise false
     */
    public function delete(int $id): bool
    {
        $lesson = Lesson::find($id);
        if (empty($lesson)) {
            return false;
        }

      //  UploadHelper::deleteFile('images/lesson/' . $lesson->image);
        $lesson->delete($lesson);
        return true;
    }

    /**
     * Get Lesson Detail By ID.
     *
     * @param int $id
     * @return void
     */
    public function getByID(int $id): Lesson|null
    {
        $lesson =  Lesson::find($id);

                 
        if ($lesson) {
            $user = $this->user;
    
            // Check if $user exists and has 'completed_lessons' property
            if ($user && isset($user->completed_lessons)) {
                

                // Update the user's my_lessons attribute by adding the current lesson ID
                $CompletedLesson = json_decode($user->completed_lessons, true) ?? [];
                if (!in_array($id, $CompletedLesson)) {
                    $CompletedLesson[] = $id;
                    $user->completed_lessons = json_encode($CompletedLesson);
                    $user->save();
                }
                
            } 
            return $lesson;
        }
    
        return null;
    }
    

    public function getAllContent(int $id): ?Lesson
    {
        return Lesson::with('exercises', 'conversations', 'tips')->find($id);

   

    }
    
    /**
     * Update Lesson By ID.
     *
     * @param int $id
     * @param array $data
     * @return object Updated Lesson Object
     */
    public function getLessonsByUnitID($course_id, $unit_id, $level_id )
    {
        return Lesson::where('course_id', $course_id)
            ->where('unit_id', $unit_id)
            ->where('level_id', $level_id)
            ->get();
    }


    public function update(int $id, array $data): Lesson|null
    {
        $unit = Lesson::find($id);
        if (!empty($data['image'])) {
            $titleShort = Str::slug(substr($data['title'], 0, 20));
           //$data['image'] = UploadHelper::update('image', $data['image'], $titleShort . '-' . time(), 'images/products', $product->image);
        } else {
           
        }

        if (is_null($unit)) {
            return null;
        }

        // If everything is OK, then update.
        $unit->update($data);

        // Finally return the updated unit.
        return $this->getByID($unit->id);
    }
}
