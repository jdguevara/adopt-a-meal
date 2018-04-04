<?php
/**
 * Created by PhpStorm.
 * User: tyler
 * Date: 4/4/18
 * Time: 9:53 AM
 */

namespace App\Http\Controllers;


use App\Contracts\IUserRepository;
use App\Http\Requests\UserRequest;

class UserController extends Controller
{
    private $userRepository;

    public function __construct(IUserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
        $this->middleware('auth');
    }

    public function createUser(UserRequest $userRequest)
    {
        try {
            $this->userRepository->add($userRequest->all());
        } catch (\Exception $e) {
            flash( "There was a problem creating this user. Please try again later.")->error();
        }
        flash( "User created successfully!")->success();
        return redirect('admin/manageusers');
    }

    public function updateUser($userId, UserRequest $userRequest)
    {
        try {
            $this->userRepository->update($userId, $userRequest->all());
        } catch(\Exception $e) {
            flash('There was a problem updating this user. Please try again later.')->error();
        }
        flash('User updated successfully.')->success();
        return redirect('admin/manageusers');
    }

    public function deleteUser($id)
    {
        try {
            $this->userRepository->delete($id);
        } catch(\Exception $e) {

        }
        flash('User deleted successfully.')->success();
    }
}