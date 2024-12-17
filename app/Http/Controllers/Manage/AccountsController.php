<?php

namespace App\Http\Controllers\Manage;

use App\Http\Controllers\Controller;
use App\Models\mService;
use App\Models\pServiceAccess;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

class AccountsController extends Controller
{
    public function index(Request $request) {
        $users = User::where('id', '!=', Auth::user()->id);
        if ($request->search) {
            $search = $request->search;
            $users = $users->where(function ($query) use ($search) {
                $query->where('name', 'LIKE', "%$search%")
                    ->orWhere('email', 'LIKE', "%$search%");
            });
        }
        $users = $users->get();
        $services = mService::get();
        // dd($users[0]->service);
        return view('manage.accounts.index', [
            'users' => $users,
            'services' => $services,
        ]);
    }

    public function verifyUser($id) {
        $user = User::find(Crypt::decryptString($id));
        if (!$user) return  back()->withErrors('user not found');
        if ($user->verified_at) return back()->withErrors('user verified already');
        $user->update([
            'verified_at' => date('Y-m-d H:i:s'),
        ]);
        return back()->with('success', 'verify user successful');
    }

    public function unverifyUser($id) {
        $user = User::find(Crypt::decryptString($id));
        if (!$user) return  back()->withErrors('user not found');
        if (!$user->verified_at) return back()->withErrors('user was unverified');
        $user->update([
            'verified_at' => null,
        ]);
        return back()->with('success', 'unverify user successful');
    }

    public function serviceAccess($id, Request $request) {
        $user_id = Crypt::decryptString($id);
        $user = User::find($user_id);
        if (!$user) return  back()->withErrors('user not found');
        $request->validate([
            'service' => 'array',
            'service.*' => 'integer',
        ], [
            'service.array' => 'service must be an array',
            'service.*.integer' => 'service must be a number',
        ]);
        $user->service()->sync($request->service);
        return back()->with('success', 'user service access updated');
    }

    public function setAsAdmin($id) {
        $user = User::find(Crypt::decryptString($id));
        if ($user->role_id == 1) return back()->withErrors('user is admin already');
        $user->update(['role_id' => 1]);
        return back()->with('success', 'user is now admin');
    }

    public function removeAdmin($id) {
        $user = User::find(Crypt::decryptString($id));
        if ($user->role_id == 2) return back()->withErrors('user is not admin');
        $user->update(['role_id' => 2]);
        return back()->with('success', 'remove admin successful');
    }
}
