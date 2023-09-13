<?php

namespace App\Repositories;

use Illuminate\Support\Str;
use App\Helpers\UploadHelper;
use App\Interfaces\CrudInterface;
use App\Models\Exercise;
use App\Models\User;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;

class ExerciseRepository implements CrudInterface
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
     * Get All Exercise.
     *
     * @return collections Array of Exercise Collection
     */
    public function getAll(): Paginator
    {
        return Exercise::orderBy('id', 'desc')
            // ->with('user')
            ->paginate(10);
    }

    /**
     * Get Paginated Exercise Data.
     *
     * @param int $pageNo
     * @return collections Array of Exercise Collection
     */
    public function getPaginatedData($perPage): Paginator
    {
        $perPage = isset($perPage) ? intval($perPage) : 12;
        return Exercise::orderBy('id', 'desc')
            // ->with('user')
            ->paginate($perPage);
    }

    /**
     * Get Searchable Exercise Data with Pagination.
     *
     * @param int $pageNo
     * @return collections Array of Exercise Collection
     */
    public function searchExercise($keyword, $perPage): Paginator
    {
        $perPage = isset($perPage) ? intval($perPage) : 10;

        return Exercise::where('question', 'like', '%' . $keyword . '%')
            ->orWhere('instruction', 'like', '%' . $keyword . '%') 
            ->orderBy('id', 'desc')
            // ->with('user')
            ->paginate($perPage);
    }

    /**
     * Create New Exercise.
     *
     * @param array $data
     * @return object Exercise Object
     */
    public function create(array $data): Exercise
    {
        $titleShort      = Str::slug(substr($data['question'], 0, 20));

        if (!empty($data['image'])) {
            $data['image'] = UploadHelper::upload('image', $data['image'], $titleShort . '-' . time(), 'images/exercises');
        }

        $data['user_id'] = $this->user->id;

        return Exercise::create($data);
    }

    /**
     * Delete Exercise.
     *
     * @param int $id
     * @return boolean true if deleted otherwise false
     */
    public function delete(int $id): bool
    {
        $exercise = Exercise::find($id);
        if (empty($exercise)) {
            return false;
        }

     // UploadHelper::deleteFile('images/exercise/' . $exercise->image);
        $exercise->delete($exercise);
        return true;
    }

    /**
     * Get Exercise Detail By ID.
     *
     * @param int $id
     * @return void
     */
    public function getByID(int $id): Exercise|null
    {
        $exercises = Exercise::with('user')->find($id);

        
        if ($exercises) {
            $user = $exercises->user;
    
            // Check if $user exists and has 'completed_exercises' property
            if ($user && isset($user->completed_exercises)) {
                

                // Update the user's completed_exercises attribute by adding the current course ID
                $completedExercises = json_decode($user->completed_exercises, true) ?? [];
                if (!in_array($id, $completedExercises)) {
                    $completedExercises[] = $id;
                    $user->completed_exercises = json_encode($completedExercises);
                    $user->save();
                }
                
            }
            return $exercises;
        }
            return null;
    }

    /**
     * Update Exercise By ID.
     *
     * @param int $id
     * @param array $data
     * @return object Updated Exercise Object
     */
    public function getExercisesByLessonID($course_id,$level_id, $unit_id, $lesson_id)
    {
        $exercises = Exercise::where('lesson_id', $lesson_id)
            ->where('course_id', $course_id)
            ->where('level_id', $level_id)
            ->where('unit_id', $unit_id)
            ->where('lesson_id', $lesson_id)
            ->orderBy('id', 'desc')
            ->get();
    
        if ($exercises->isEmpty()) {
            // If no exercises are found, you can return an appropriate response
            return response()->json(['message' => 'No exercises found for the specified parameters'], 404);
        }
    
        return $exercises;
    }
    


    public function update(int $id, array $data): Exercise|null
    {
        $exercise = Exercise::find($id);
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
