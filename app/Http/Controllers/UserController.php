<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Auth;
use App\Models\User;
use Validator;
use File;
use App\Repositories\ImageRepository;
use App\Policies\UserPolicy;
use Gate;
use Hash;

class UserController extends Controller
{
    public $image;

    public function __construct(ImageRepository $image)
    {
        $this->avatar = $image;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $followers = $user->followers;
        $following = $user->following;
        return view('user.show')->with([
            'user' => $user,
            'followers' => $followers,
            'following' => $following
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($user)
    {

        if (Gate::denies('update', $user)) {
            return redirect('/');
        }
        return view('user.edit')->with('user', $user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $validate = Validator::make($request->all(),['name' => 'min:6|max:25']);

        if ($validate->fails()) {
            return back()->with('fail', 'Update Profile Fail');
        }

        $img = $request->file('avatar');

        if (User::find($request->id) == null) {
            return back()->with('fail', 'Not found data :(');
        } else {
            if ($img != null && $request->name != null && $request->email != null) {
                $destinationPath = public_path('/avatar/');
                $file = User::find($request->id)->avatar;
                File::delete($destinationPath.$file);
                $imagename = $this->avatar->uploadAvatar($img);
                User::find($request->id)->update([
                    'name' => $request->name,
                    'email' => $request->email,
                    'avatar' => $imagename,
                ]);
            } elseif ($img == null && $request->name != null && $request->email != null) {
                User::find($request->id)->update([
                    'name' => $request->name,
                    'email' => $request->email,
                ]);
            } else {
                return back()->with('fail', 'Update Profile Fail');
            }

        }

        return redirect(url("/user/$request->id"))
            ->with('success','Profile Update successful');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function getFollowing(User $user)
    {
        if ($user == NULL) {
            return redirect('/');
        } else {
            $followers = $user->followers;
            $following = $user->following;
            return view('relationship.following', [
                'user' => $user,
                'following' => $following,
                'followers' => $followers
            ]);
        }
    }

    public function getFollowers(User $user)
    {
        if ($user == NULL) {
            return redirect('/');
        } else {
            $followers = $user->followers;
            $following = $user->following;
            return view('relationship.followers', [
                'user' => $user,
                'following' => $following,
                'followers' => $followers
            ]);
        }
    }

    public function updatePassword(Request $request)
    {
        $min = config('settings.password.min');
        $max = config('settings.password.max');
        $validate = Validator::make($request->all(),
            ['password' => "min:$min|max:$max"]);

        if ($validate->fails()) {
            return back()->with('message', 'Update Password Fail');
        }

        $request->user()->fill([
            'password' => bcrypt($request->password)
        ])->save();
        return redirect('/')->with('message', 'Update Password Success');
    }
}
