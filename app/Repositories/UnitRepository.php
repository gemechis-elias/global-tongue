<?php

namespace App\Repositories;

use Illuminate\Support\Str;
use App\Helpers\UploadHelper;
use App\Interfaces\CrudInterface;
use App\Models\Unit;
use App\Models\User;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;

class UnitRepository implements CrudInterface
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
     * Get All Unit.
     *
     * @return collections Array of Unit Collection
     */
    public function getAll(): Paginator
    {
        return Unit::orderBy('id', 'desc')
            // ->with('user')
            ->paginate(10);
    }

    /**
     * Get Paginated Unit Data.
     *
     * @param int $pageNo
     * @return collections Array of Unit Collection
     */
    public function getPaginatedData($perPage): Paginator
    {
        $perPage = isset($perPage) ? intval($perPage) : 12;
        return Unit::orderBy('id', 'desc')
            // ->with('user')
            ->paginate($perPage);
    }

    /**
     * Get Searchable Unit Data with Pagination.
     *
     * @param int $pageNo
     * @return collections Array of Unit Collection
     */
    public function searchUnit($keyword, $perPage): Paginator
    {
        $perPage = isset($perPage) ? intval($perPage) : 10;

        return Unit::where('name', 'like', '%' . $keyword . '%')
            ->orWhere('description', 'like', '%' . $keyword . '%')
            ->orderBy('id', 'desc')
            // ->with('user')
            ->paginate($perPage);
    }

    /**
     * Create New Unit.
     *
     * @param array $data
     * @return object Unit Object
     */
    public function create(array $data): Unit
    {
       // $titleShort      = Str::slug(substr($data['title'], 0, 20));
        $data['user_id'] = $this->user->id;

    

        return Unit::create($data);
    }

    /**
     * Delete Unit.
     *
     * @param int $id
     * @return boolean true if deleted otherwise false
     */
    public function delete(int $id): bool
    {
        $unit = Unit::find($id);
        if (empty($unit)) {
            return false;
        }

      //  UploadHelper::deleteFile('images/unit/' . $unit->image);
        $unit->delete($unit);
        return true;
    }

    /**
     * Get Unit Detail By ID.
     *
     * @param int $id
     * @return void
     */
    public function getByID(int $id): Unit|null
    {
      
        $unit= Unit::find($id);
        if ($unit) {
            $user = $this->user;
    
            // Check if $user exists and has 'completed_units' property
            if ($user && isset($user->completed_units)) {
                

                // Update the user's my_units attribute by adding the current unit ID
                $CompletedUnit = json_decode($user->completed_units, true) ?? [];
                if (!in_array($id, $CompletedUnit)) {
                    $CompletedUnit[] = $id;
                    $user->completed_units = json_encode($CompletedUnit);
                    $user->save();
                }
                
            } 
            return $unit;
        }
    
        return null;
    }

    /**
     * Update Unit By ID.
     *
     * @param int $id
     * @param array $data
     * @return object Updated Unit Object
     */
    public function getUnitsByCourseID($course_id, $level_id)
    {
        return Unit::where('course_id', $course_id)
            ->where('level_id', $level_id)
            ->get();
    }


    public function update(int $id, array $data): Unit|null
    {
        $course = Unit::find($id);
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
