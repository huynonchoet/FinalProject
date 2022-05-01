<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Interfaces\UserRepositoryInterface;
use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;
use App\Interfaces\PasswordResetRepositoryInterface;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    private $userRepository;
    private $passwordResetRepository;

    public function __construct(UserRepositoryInterface $userRepository, PasswordResetRepositoryInterface $passwordResetRepository)
    {
        $this->userRepository = $userRepository;
        $this->passwordResetRepository = $passwordResetRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = $users = $this->userRepository->searchUser();

        return view('admin.user.index', ['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.user.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RegisterRequest $request)
    {
        $data = $request->all();
        if ($this->add($data)) {
            $email = $request['email'];
            $token = Hash::make($email);
            $passwordReset = $this->passwordResetRepository->getPasswordResetByEmail($email);
            if (count($passwordReset) == 0) {
                $this->passwordResetRepository->createPasswordReset(['email' => $email, 'token' => $token]);
            } else {
                $this->passwordResetRepository->updatePasswordReset($email, ['email' => $email, 'token' => $token]);
            }
            Mail::to($email)->send(new \App\Mail\UserActivationEmail($token));
            
            return redirect()->route('admin.users.create')->with('message', 'Create successfully');
        }

        return abort(404);
    }

    public function add(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'role' => $data['role'],
            'status' => '1',
            'password' => bcrypt($data['password'])
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * change status of user to 1
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = $this->userRepository->getUserById($id);
        $update = ['status' => '1'];
        $user->update($update);
        return redirect()->route('admin.users.index')->with('message', __('messages.block.success'));
    }

    /**
     * change status of uses to 0.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function unblock(Request $request, $id)
    {
        $user = $this->userRepository->getUserById($id);
        $update = ['status' => '0'];
        $user->update($update);
        return redirect()->route('admin.users.index')->with('message', __('messages.block.unblock'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->userRepository->deleteUser($id);

        return redirect()->back()->with('message', __('messages.delete.success'));
    }
}
