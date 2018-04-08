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
use Illuminate\Http\Request;

class UserController extends Controller
{
    private $userRepository;

    public function __construct(IUserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
        $this->middleware('auth');
    }

    public function create()
    {
        return view('auth.users.create');
    }

    public function edit($id)
    {
        $user = $this->userRepository->get($id);
        return view('auth.users.edit', ['user' => $user]);
    }

    public function store(UserRequest $userRequest)
    {
        try {
            $this->userRepository->add($userRequest->all());
        } catch (\Exception $e) {
            flash( "There was a problem creating this user. Please try again later.")->error();
            return redirect('admin/settings/manage-users');
        }
        flash( "User created successfully!")->success();
        return redirect('admin/settings/manage-users');
    }

    public function update($id, Request $userRequest)
    {
        $this->validate($userRequest, [
            'name' => 'required|string|max:100',
        ]);
        try {
            $this->userRepository->update($id, $userRequest->all());
        } catch(\Exception $e) {
            flash('There was a problem updating this user. Please try again later.')->error();
            return redirect('admin/settings/manage-users');
        }
        flash('User updated successfully.')->success();
        return redirect('admin/settings/manage-users');
    }

    public function delete($id)
    {
        try {
            $this->userRepository->delete($id);
        } catch(\Exception $e) {
            flash('There was a problem deleting this user. Please try again later.')->error();
            return redirect('admin/settings/manage-users');
        }
        flash('User deleted successfully.')->success();
        return redirect('admin/settings/manage-users');
    }
}