<?php

namespace App\Repositories;

use Illuminate\Support\Str;
use App\Helpers\UploadHelper;
use App\Interfaces\CrudInterface;
use App\Models\Course;
use App\Models\User;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;

class CourseRepository implements CrudInterface
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
     * Get All Course.
     *
     * @return collections Array of Course Collection
     */
    public function getAll(): Paginator
    {
        return $this->user->courses()
            ->orderBy('id', 'desc')
            ->with('user')
            ->paginate(10);
    }

    /**
     * Get Paginated Course Data.
     *
     * @param int $pageNo
     * @return collections Array of Course Collection
     */
    public function getPaginatedData($perPage): Paginator
    {
        $perPage = isset($perPage) ? intval($perPage) : 12;
        return Course::orderBy('id', 'desc')
            ->with('user')
            ->paginate($perPage);
    }

    /**
     * Get Searchable Course Data with Pagination.
     *
     * @param int $pageNo
     * @return collections Array of Course Collection
     */
    public function searchCourse($keyword, $perPage): Paginator
    {
        $perPage = isset($perPage) ? intval($perPage) : 10;

        return Course::where('name', 'like', '%' . $keyword . '%')
            ->orWhere('description', 'like', '%' . $keyword . '%')
            ->orderBy('id', 'desc')
            ->with('user')
            ->paginate($perPage);
    }

    /**
     * Create New Course.
     *
     * @param array $data
     * @return object Course Object
     */
    public function create(array $data): Course
    {
        $titleShort      = Str::slug(substr($data['title'], 0, 20));
        $data['user_id'] = $this->user->id;

    

        return Course::create($data);
    }

    /**
     * Delete Course.
     *
     * @param int $id
     * @return boolean true if deleted otherwise false
     */
    public function delete(int $id): bool
    {
        $course = Course::find($id);
        if (empty($course)) {
            return false;
        }

      //  UploadHelper::deleteFile('images/course/' . $course->image);
        $course->delete($course);
        return true;
    }

    /**
     * Get Course Detail By ID.
     *
     * @param int $id
     * @return void
     */
    public function getByID(int $id): Course|null
    {
        return Course::with('user')->find($id);
    }

    /**
     * Update Course By ID.
     *
     * @param int $id
     * @param array $data
     * @return object Updated Course Object
     */
    public function update(int $id, array $data): Course|null
    {
        $course = Course::find($id);
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
