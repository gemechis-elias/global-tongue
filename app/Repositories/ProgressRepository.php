<?php

namespace App\Repositories;

use App\Models\Lesson;
use Illuminate\Support\Str;
use App\Helpers\UploadHelper;
use App\Interfaces\CrudInterface;
use App\Models\Progress;
use App\Models\User;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;

class ProgressRepository implements CrudInterface
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
     * Get All Progress.
     *
     * @return collections Array of Progress Collection
     */
    public function getAll(): Paginator
    {
        return Progress::orderBy('id', 'desc')
            ->paginate(100);
    }

    /**
     * Get Paginated Progress Data.
     *
     * @param int $pageNo
     * @return collections Array of Progress Collection
     */
    public function getPaginatedData($perPage): Paginator
    {
        $perPage = isset($perPage) ? intval($perPage) : 12;
        return Progress::orderBy('id', 'desc')
           
            ->paginate($perPage);
    }

    /**
     * Get Searchable Progress Data with Pagination.
     *
     * @param int $pageNo
     * @return collections Array of Progress Collection
     */
    public function searchProgress($keyword, $perPage): Paginator
    {
        $perPage = isset($perPage) ? intval($perPage) : 10;

        return Progress::where('name', 'like', '%' . $keyword . '%')
            ->orWhere('description', 'like', '%' . $keyword . '%')
            ->orderBy('id', 'desc')
            
            ->paginate($perPage);
    }

    /**
     * Create New Progress.
     *
     * @param array $data
     * @return object Progress Object
     */
    public function create(array $data): Progress
    {
        
        $titleShort      = Str::slug(substr($data['name'], 0, 20));
        $data['user_id'] = $this->user->id;

        if (!empty($data['image'])) {
            $data['image'] = UploadHelper::upload('image', $data['image'], $titleShort . '-' . time(), 'images/courses');
        }
        return Progress::create($data);
    }

    /**
     * Delete Progress.
     *
     * @param int $id
     * @return boolean true if deleted otherwise false
     */
    public function delete(int $id): bool
    {
        $progress = Progress::find($id);
        if (empty($progress)) {
            return false;
        }

      //  UploadHelper::deleteFile('images/progress/' . $progress->image);
        $progress->delete($progress);
        return true;
    }

/**
 * Get Progress Detail By user ID.
 *
 * @param int $userId
 * @return Progress|null
 */
public function getByID(int $userId): Progress|null
{
    // Retrieve the user's progress from the database by user ID
    return Progress::where('user_id', $userId)->first();
}

    

    /**
     * Update Progress By ID.
     *
     * @param int $id
     * @param array $data
     * @return object Updated Progress Object
     */
    public function update(int $id, array $data): Progress|null
    {
        $course = Progress::find($id);
        if (!empty($data['image'])) {
           $titleShort = Str::slug(substr($data['name'], 0, 20));
           $data['image'] = UploadHelper::update('image', $data['image'], $titleShort . '-' . time(), 'images/courses', $course->image);
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
