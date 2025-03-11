<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class ProfileApiController extends Controller
{
    public function myprofile(Request $request)
    {
        $user_id = $request->user_id;
        $user = User::where('id', $user_id)->first();

        return response()->json([
            'message' => true,
            'data' => $user,
        ]);
    }
}
