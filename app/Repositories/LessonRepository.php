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
        return $this->user->courses()
           // ->orderBy('lesson_id', 'desc')
            ->with('user')
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
        return Lesson::orderBy('lesson_id', 'desc')
            ->with('user')
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
            ->orderBy('lesson_id', 'desc')
            ->with('user')
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
        $course = Lesson::find($id);
        if (empty($course)) {
            return false;
        }

      //  UploadHelper::deleteFile('images/course/' . $course->image);
        $course->delete($course);
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
        return Lesson::with('user')->find($id);
    }

    /**
     * Update Lesson By ID.
     *
     * @param int $id
     * @param array $data
     * @return object Updated Lesson Object
     */
    public function getLessonsByCourseID($course_id)
    {
        return Lesson::where('course_id', $course_id)->get();
    }


    public function update(int $id, array $data): Lesson|null
    {
        $course = Lesson::find($id);
        if (!empty($data['image'])) {
            $titleShort = Str::slug(substr($data['title'], 0, 20));
           //$data['image'] = UploadHelper::update('image', $data['image'], $titleShort . '-' . time(), 'images/products', $product->image);
        } else {
           
        }

        if (is_null($course)) {
            return null;
        }

        // If everything is OK, then update.
        $course->update($data);

        // Finally return the updated course.
        return $this->getByID($course->id);
    }
}
