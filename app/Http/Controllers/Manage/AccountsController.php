<?php

namespace App\Http\Controllers\Manage;

use App\Http\Controllers\Controller;
use App\Models\pServiceAccess;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

class AccountsController extends Controller
{
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
            'service' => 'array'
        ], [
            'service.array' => 'service must be an array'
        ]);
        $service_access = $request->service->map(function ($item) use ($user_id) {
            return ['user_id' => $user_id, 'service_id' => $item];
        });
        pServiceAccess::where('user_id', $user_id)->delete();
        DB::table('p_service_access')->insert($service_access);
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
