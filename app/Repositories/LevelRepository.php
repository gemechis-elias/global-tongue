<?php

namespace App\Repositories;

use Illuminate\Support\Str;
use App\Helpers\UploadHelper;
use App\Interfaces\CrudInterface;
use App\Models\Level;
use App\Models\User;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;

class LevelRepository implements CrudInterface
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
     * Get All Level.
     *
     * @return collections Array of Level Collection
     */
    public function getAll(): Paginator
    {
        return $this->user->levels()
            ->orderBy('id', 'desc')
            // ->with('user')
            ->paginate(10);
    }

    /**
     * Get Paginated Level Data.
     *
     * @param int $pageNo
     * @return collections Array of Level Collection
     */
    public function getPaginatedData($perPage): Paginator
    {
        $perPage = isset($perPage) ? intval($perPage) : 12;
        return Level::orderBy('id', 'desc')
            // ->with('user')
            ->paginate($perPage);
    }

    /**
     * Get Searchable Level Data with Pagination.
     *
     * @param int $pageNo
     * @return collections Array of Level Collection
     */
    public function searchLevel($keyword, $perPage): Paginator
    {
        $perPage = isset($perPage) ? intval($perPage) : 10;

        return Level::where('name', 'like', '%' . $keyword . '%')
            ->orWhere('description', 'like', '%' . $keyword . '%')
            ->orderBy('id', 'desc')
            // ->with('user')
            ->paginate($perPage);
    }

    /**
     * Create New Level.
     *
     * @param array $data
     * @return object Level Object
     */
    public function create(array $data): Level
    {
        $titleShort      = Str::slug(substr($data['title'], 0, 20));
        $data['user_id'] = $this->user->id;

    

        return Level::create($data);
    }

    public function getLevelsByCourseID($course_id)
    {
        return Level::where('course_id', $course_id)->get();
    }
    /**
     * Delete Level.
     *
     * @param int $id
     * @return boolean true if deleted otherwise false
     */
    public function delete(int $id): bool
    {
        $level = Level::find($id);
        if (empty($level)) {
            return false;
        }

      //  UploadHelper::deleteFile('images/level/' . $level->image);
        $level->delete($level);
        return true;
    }

    /**
     * Get Level Detail By ID.
     *
     * @param int $id
     * @return void
     */
    public function getByID(int $id): Level|null
    {
        return Level::with('user')->find($id);
    }

    /**
     * Update Level By ID.
     *
     * @param int $id
     * @param array $data
     * @return object Updated Level Object
     */
    public function update(int $id, array $data): Level|null
    {
        $level = Level::find($id);
        if (!empty($data['image'])) {
            $titleShort = Str::slug(substr($data['title'], 0, 20));
           //$data['image'] = UploadHelper::update('image', $data['image'], $titleShort . '-' . time(), 'images/products', $product->image);
        } else {
           
        }

        if (is_null($level)) {
            return null;
        }

        // If everything is OK, then update.
        $level->update($data);

        // Finally return the updated level.
        return $this->getByID($level->id);
    }

  
}
