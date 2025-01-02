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
        $uploadManager = new UploadManager($request);
        if ($request->hasFile('image_path')) {
            $path = $uploadManager->upload('avatar', 'images/users');
        } else {
            $path = null;
        }


        $user = new User();
        $user->name = $request->name;
        $user->password = $request->password;
        $user->email = $request->email;
      //  $user->avatar = $path;


        $user->save();

        return $user;
    }

    public function update(Request $request, $id)
    {
        $user = $this->find($id);
        $user->name = $request->name;
        $user->email = $request->email;
     //   $user->avatar = $path;
        $user->save();

        return $user;
    }

    public function delete($id)
    {
        $user = $this->find($id);
        return $user->delete();
    }
}
