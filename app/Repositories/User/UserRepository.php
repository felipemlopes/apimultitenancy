<?php

namespace App\Repositories\User;

use App\Models\User;
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
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;

        $user->save();

        return $user;
    }

    public function update(Request $request, $id)
    {
        $user = $this->find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();

        return $user;
    }

    public function delete($id)
    {
        $user = $this->find($id);
        return $user->delete();
    }
}
