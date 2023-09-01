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
        return $this->user->exercises()
           // ->orderBy('exercise_id', 'desc')
            ->with('user')
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
        return Exercise::orderBy('exercise_id', 'desc')
            ->with('user')
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
            ->orderBy('exercise_id', 'desc')
            ->with('user')
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
        $titleShort      = Str::slug(substr($data['title'], 0, 20));
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

      //  UploadHelper::deleteFile('images/exercise/' . $exercise->image);
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
        return Exercise::with('user')->find($id);
    }

    /**
     * Update Exercise By ID.
     *
     * @param int $id
     * @param array $data
     * @return object Updated Exercise Object
     */
    public function getExerciseByLessonID($lesson_id)
    {
        return Exercise::where('lesson_id', $lesson_id)->get();
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
