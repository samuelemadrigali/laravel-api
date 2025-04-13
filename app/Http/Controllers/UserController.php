<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Get the authenticated user.
     */
    public function user(): JsonResponse
    {
        $user = Auth::user();

        if ($user) {
            return new JsonResponse(new UserResource($user), Response::HTTP_OK);
        }

        return new JsonResponse(null, Response::HTTP_UNAUTHORIZED);
    }
}
