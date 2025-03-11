<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthApiController extends Controller
{
    public function changePassword(Request $request)
    {
        $user_id = $request->user_id;
        $currentPassword = $request->currentPassword;
        $newPassword = $request->newPassword;

        $user = User::where('id', $user_id)->first();

        if (Hash::check($currentPassword, $user->password)) {
            User::where('id', $user_id)->update([
                'password' => Hash::make($newPassword)
            ]);
            return response()->json([
                'message' => true,
                'data' => null,
            ]);
        }

        return response()->json([
            'message' => false,
            'data' => "Wrong Password",
        ]);
    }
}
