<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Transformers\UserTransformer;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

/**
 * @group User management
 *
 * APIs for managing users
 */
class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api')->except('create');
    }

    /**
     * Create a new user
     *
     * Make an empty POST request to register a new user.
     * The endpoint returns an `api_token` that you should store on the client.
     * The `api_token` **cannot** be displayed in plain text again.
     *
     * @responseFile responses/users.create.json
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(Request $request)
    {
        // Generate random api_token
        $token = Str::random(60);

        $user = User::create([
            User::API_TOKEN => hash('sha256', $token),
        ]);

        return fractal()
            ->item($user)
            ->addMeta(['api_token' => $token])
            ->transformWith(new UserTransformer())
            ->respond(201);
    }

    /**
     * Display the authenticated user resource.
     *
     * @authenticated
     * @responseFile responses/users.get.json
     *
     * @param \Illuminate\Http\Request
     * @return \Illuminate\Http\JsonResponse
     */
    public function self(Request $request)
    {
        return fractal()
            ->item($request->user())
            ->transformWith(new UserTransformer())
            ->respond(200);
    }

    /**
     * Display the specified user resource.
     *
     * @authenticated
     * @responseFile responses/users.get.json
     *
     * @param  \App\Models\User $user
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(User $user)
    {
        // Authorization is handled by user policy
        return fractal()
            ->item($user)
            ->transformWith(new UserTransformer())
            ->respond(200);
    }

    /**
     * Remove the specified user from storage.
     *
     * @authenticated
     *
     * @param  \App\Models\User $user
     * @return \Illuminate\Http\JsonResponse
     *
     * @throws \Exception
     */
    public function destroy(User $user)
    {
        // Authorization is handled by user policy
        $user->delete();
        return response()->json('', 204);
    }
}
