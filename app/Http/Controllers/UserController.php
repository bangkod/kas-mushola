<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::where('status', '1')->get();
        return view('master.user', ['users' => $users]);
    }

    public function get($id)
    {
        $user = User::find($id);
        return response()->json(['success' => 1, 'data' => $user]);
    }

    public function profile($id)
    {
        $user = User::where('id',$id)->orderBy('created_at', 'desc')->first();
        // $user->helpdesks->sortByDesc('created_at');
        return view('user-profile', ['user' => $user]);
    }

    public function profile_edit(Request $request)
    {
        $id = $request->id;
        $user = User::find($id);
        $user->nik = $request->nik;
        $user->name = $request->name;
        $user->position = $request->position;
        if ($request->picture) {
            $image = $request->picture;
            $picture_name = time().'-'.$image->getClientOriginalName();
            $img = Image::make($image->getRealPath());
            $img->resize(1000, 1000, function ($constraint) {
                $constraint->aspectRatio();
            })->save(public_path().'\images\\'.$picture_name);
            // $image->move(public_path().'/images/', $picture_name);  
            // $pictures[] = $picture_name;
            $user->picture = $picture_name;
        }
        if ($user->save()) {
            return response()->json(['success' => 1], 200);
        }else{
            return response()->json(['success' => 0], 200);
        }
    }

    public function store(Request $request)
    {
        $validation = $request->validate([
            'nik'          => 'required|regex:/-/',
            'name'          => 'required',
            'tugas'          => 'required',
            'status'          => 'required',
        ]);
        $User = new User;
        $User->nik = $request->nik;
        $User->name = $request->name;
        $User->position = $request->tugas;
        $User->status = $request->status;
        $User->username = explode('-', $request->nik)[1];
        $User->password = Hash::make('asdf');
        if ($User->save()) {
            return response()->json(['success' => 1], 200);
        }
    }

    public function change(Request $request)
    {
        $validation = $request->validate([
        	'username' => 'required',
            'name'          => 'required',
            'status'          => 'required',
        ]);
        $User = User::find($request->id);
        $User->username = $request->username;
        $User->name = $request->name;
        $User->status = $request->status;
        if ($User->save()) {
            return response()->json(['success' => 1], 200);
        }
    }


    public function delete($id)
    {
        $user = User::find($id);
        $user->status = '0';
        if ($user->save()) {
            return response()->json(['success' => 1], 200);
        }
    }
}
