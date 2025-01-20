<?php

namespace App\Repositories\UserList;

use App\Models\UserList;

use Illuminate\Http\Request;

class UserListRepository implements UserListInterface
{
    public function search($peer_page, $search, $status = null)
    {

        $users = UserList::Query();
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
        return UserList::findOrFail($id);
    }

    public function create(Request $request)
    {
        /* $uploadManager = new UploadManager($request);
        if ($request->hasFile('image_path')) {
            $path = $uploadManager->upload('avatar', 'images/users');
        } else {
            $path = null;
        } */


        $user = new UserList();
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
