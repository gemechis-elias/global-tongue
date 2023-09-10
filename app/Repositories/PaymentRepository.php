<?php

namespace App\Repositories;

use Illuminate\Support\Str;
use App\Helpers\UploadHelper;
use App\Interfaces\CrudInterface;
use App\Models\Payment;
use App\Models\User;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;

class PaymentRepository implements CrudInterface
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
     * Get All Payment.
     *
     * @return collections Array of Payment Collection
     */
    public function getAll(): Paginator
    {
        return Payment::orderBy('id', 'desc')
            ->paginate(100);
    }

    /**
     * Get Paginated Payment Data.
     *
     * @param int $pageNo
     * @return collections Array of Payment Collection
     */
    public function getPaginatedData($perPage): Paginator
    {
        $perPage = isset($perPage) ? intval($perPage) : 12;
        return Payment::orderBy('id', 'desc')
           
            ->paginate($perPage);
    }

    /**
     * Get Searchable Payment Data with Pagination.
     *
     * @param int $pageNo
     * @return collections Array of Payment Collection
     */
    public function searchPayment($keyword, $perPage): Paginator
    {
        $perPage = isset($perPage) ? intval($perPage) : 10;

        return Payment::where('name', 'like', '%' . $keyword . '%')
            ->orWhere('description', 'like', '%' . $keyword . '%')
            ->orderBy('id', 'desc')
            
            ->paginate($perPage);
    }

    /**
     * Create New Payment.
     *
     * @param array $data
     * @return object Payment Object
     */
    public function create(array $data): Payment
    {
        
        $titleShort      = Str::slug(substr($data['name'], 0, 20));
        $data['user_id'] = $this->user->id;

        if (!empty($data['image'])) {
            $data['image'] = UploadHelper::upload('image', $data['image'], $titleShort . '-' . time(), 'images/payments');
        }
        return Payment::create($data);
    }

    /**
     * Delete Payment.
     *
     * @param int $id
     * @return boolean true if deleted otherwise false
     */
    public function delete(int $id): bool
    {
        $payment = Payment::find($id);
        if (empty($payment)) {
            return false;
        }

      //  UploadHelper::deleteFile('images/payment/' . $payment->image);
        $payment->delete($payment);
        return true;
    }

    /**
     * Get Payment Detail By ID.
     *
     * @param int $id
     * @return void
     */
    public function getByID(int $id): Payment|null
    {
        $payment = Payment::find($id);
    
        if ($payment) {
            $user = $payment->user;
    
            // Check if $user exists and has 'my_payments' property
            if ($user && isset($user->my_payments)) {
                // Update the user's my_payments attribute by adding the current payment ID
                $myPayments = json_decode($user->my_payments, true) ?? [];
                if (!in_array($id, $myPayments)) {
                    $myPayments[] = $id;
                    $user->my_payments = json_encode($myPayments);
                    $user->save();
                }
            }
    
            return $payment;
        }
    
        return null;
    }
    

    /**
     * Update Payment By ID.
     *
     * @param int $id
     * @param array $data
     * @return object Updated Payment Object
     */
    public function update(int $id, array $data): Payment|null
    {
        $payment = Payment::find($id);
        if (!empty($data['image'])) {
           $titleShort = Str::slug(substr($data['name'], 0, 20));
           $data['image'] = UploadHelper::update('image', $data['image'], $titleShort . '-' . time(), 'images/payments', $payment->image);
        } else {
           
        }

        if (is_null($payment)) {
            return null;
        }

        // If everything is OK, then update.
        $payment->update($data);

        // Finally return the updated payment.
        return $this->getByID($payment->id);
    }
}
