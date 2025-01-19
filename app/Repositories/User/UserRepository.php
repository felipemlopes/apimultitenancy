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
        if (!empty($search)) {
            $users->where(function ($query) use ($search) {
                $query->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
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
        /* $uploadManager = new UploadManager($request);
        if ($request->hasFile('image_path')) {
            $path = $uploadManager->upload('avatar', 'images/users');
        } else {
            $path = null;
        } */


        $user = new User();
        $user->firstname = $request->firstname;
        $user->middlename = $request->middlename;
        $user->lastname = $request->lastname;
        $user->password = $request->password;
        // $user->avatar = $path;
        $user->last_login = now();
        $user->type = $request->type;
        $user->perfil = $request->perfil;
        $user->date_added = now();
        $user->date_updated = now();

        $user->save();

        return $user;
    }

    public function update(Request $request, $id)
    {

        /* $uploadManager = new UploadManager($request);
        if ($request->hasFile('image_path')) {
            $path = $uploadManager->upload('avatar', 'images/users');
        } else {
            $path = null;
        } */

        $user = $this->find($id);

        $user->firstname = $request->firstname;
        $user->middlename = $request->middlename;
        $user->lastname = $request->lastname;
        $user->password = $request->password;
        //  $user->avatar = $path;
        $user->type = $request->type;
        $user->perfil = $request->perfil;
        $user->date_updated = now();
        $user->save();

        return $user;
    }

    public function delete($id)
    {
        $user = $this->find($id);
        return $user->delete();
    }
}
