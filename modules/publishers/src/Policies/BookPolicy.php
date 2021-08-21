<?php
/**
 * @author Mojtaba Rahbari <mojtaba.rahbari@gmail.com | mojtabarahbari.ir>
 * @copyright Copyright &copy; from 2021 Mike.
 * @version 1.0.0
 * @date 2021/08/20 15:39 PM
 */

namespace Publisher\Policies;

use Publisher\Models\Book;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class BookPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user is admin for all authorization.
     */
    /*public function before(User $user): bool
    {
        if (is_admin()) {     //or $user->is_admin
            return true;
        }
        return false;
    }*/

    /**
     * Determine whether the user can view any models.
     *
     * @param User $user
     * @return bool
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param User $user
     * @param Book $book
     * @return bool
     */
    public function view(User $user, Book $book): bool
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param User $user
     * @return bool
     */
    public function create(User $user): bool
    {
        if (is_admin() || is_publish_allowed()) {     //or $user->is_publish_allowed
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param User $user
     * @param Book $book
     * @return bool
     */
    public function update(User $user, Book $book): bool
    {
        if (is_admin() || (is_publish_allowed() && !empty($book->created_by) && $book->created_by === get_user_id())) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param User $user
     * @param Book $book
     * @return bool
     */
    public function delete(User $user, Book $book): bool
    {
        if (is_admin() || (is_publish_allowed() && !empty($book->created_by) && $book->created_by === get_user_id())) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param User $user
     * @param Book $book
     * @return bool
     */
    public function unPublish(User $user, Book $book): bool
    {
        if (is_admin() || (is_publish_allowed() && !empty($book->created_by) && $book->created_by === get_user_id())) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param User $user
     * @param Book $book
     * @return bool
     */
    public function restore(User $user, Book $book): bool
    {
        if (is_publish_allowed() && !empty($book->created_by) && $book->created_by === get_user_id()) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param User $user
     * @param Book $book
     * @return bool
     */
    public function forceDelete(User $user, Book $book): bool
    {
        if (is_admin()) {
            return true;
        }
        return false;
    }
}
