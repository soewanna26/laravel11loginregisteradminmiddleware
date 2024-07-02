<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdminUserController extends Controller
{
    public function user()
    {
        $users = User::orderBy('created_at', 'DESC')->paginate(9);
        return view('admin.user.list', compact('users'));
    }

    public function userCreate()
    {
        return view('admin.user.create');
    }

    public function userStore(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'mobile' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:5',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->route('userCreate')->withInput()->withErrors($validator);
        }

        $user = new User();
        $user->name = $request->name;
        $user->mobile = $request->mobile;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->role = $request->role;
        $user->save();

        // Handle the image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $ext = $image->getClientOriginalExtension();
            $imageName = time() . "." . $ext;

            // Ensure the upload directory exists
            if (!File::exists(public_path('adm/uploads/user'))) {
                File::makeDirectory(public_path('adm/uploads/user'), 0755, true);
            }

            // Move the new image
            $image->move(public_path('adm/uploads/user'), $imageName);
            $user->image = $imageName;
            $user->save();
        }

        return redirect()->route('user')->with('success', 'User added successfully');
    }

    public function userEdit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.user.edit', compact('user'));
    }

    public function userUpdate(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'mobile' => 'required',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'required|min:5',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->route('userEdit',$user->id)->withInput()->withErrors($validator);
        }


        $user->name = $request->name;
        $user->mobile = $request->mobile;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->role = $request->role;
        $user->save();

        // Handle the image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $ext = $image->getClientOriginalExtension();
            $imageName = time() . "." . $ext;

            // Delete existing user image if it exists
            if (File::exists(public_path('adm/uploads/user/' . $user->image))) {
                File::delete(public_path('adm/uploads/user/' . $user->image));
            }
            // Move the new image
            $image->move(public_path('adm/uploads/user'), $imageName);
            $user->image = $imageName;
            $user->save();
        }

        return redirect()->route('user')->with('success', 'User Update successfully');
    }

    public function userDelete($id)
    {
        $user = User::findOrFail($id);
        // Delete existing Room image (if it exists)
        if (File::exists(public_path('adm/uploads/user/' . $user->image))) {
            File::delete(public_path('adm/uploads/user/' . $user->image));
        }

        $user->delete();
        return redirect()->route('user')->with('success', 'User deleted successfully');
    }
}
