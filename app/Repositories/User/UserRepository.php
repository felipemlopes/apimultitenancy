<?php

namespace App\Repositories\User;

use App\Models\User;
use App\Services\UploadManager;
use Illuminate\Http\Request;

class UserRepository implements UserInterface
{
    public function search($peer_page, $search, $status = null)
    {

        $users = User::Query();
        if ($search <> "") {
            $users->where(function ($q) use ($search) {
                $q->orwhere('name', "like", "%{$search}%");
            });
        }
        if ($status) {
            $users = $users->where('status', $status);
        }
        $users = $users->paginate($peer_page);
        if ($search) {
            $users->appends(['search' => $search]);
        }
        if ($status) {
            $users->appends(['status' => $status]);
        }
        return $users;
    }

    public function find($id)
    {
        return User::findOrFail($id);
    }

    public function create(Request $request)
    {
        $uploadManager = new UploadManager($request);
        $path = $uploadManager->upload('avatar', 'images/users');

        $user = new User();
        $user->firstname = $request->firstname;
        $user->lastname = $request->lastname;
        $user->username = $request->username;
        $user->password = $request->password;
        $user->avatar = $path;
        $user->last_login = $request->last_login;
        $user->type = $request->type;
        $user->perfil = $request->perfil;

        $user->save();

        return $user;
    }

    public function update(Request $request, $id)
    {
        $user = $this->find($id);
        $user->firstname = $request->firstname;
        $user->lastname = $request->lastname;
        $user->username = $request->username;
        $user->type = $request->type;
        $user->save();

        return $user;
    }

    public function delete($id)
    {
        $user = $this->find($id);
        return $user->delete();
    }
}
