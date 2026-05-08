<?php

namespace App\Http\Controllers\API;

use App\Enums\UserRole;
use App\Http\Controllers\Controller;
use App\Rules\EnumValue;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

/**
 * Authentication endpoints for user login and registration
 */
class AuthController extends Controller
{
    /**
     * Authenticate user via Google OAuth
     *
     * @unauthenticated
     * @bodyParam google_id string required The Google user ID
     * @bodyParam email string required The user email
     * @bodyParam nom string required First name
     * @bodyParam prenom string required Last name
     * @bodyParam photo string The user profile photo URL
     *
     * @response 200 {"user": {"id": 1, "nom": "Traore", "prenom": "Moussa", "email": "student@gmail.com", "role": "user", "status": "active"}, "token": "1|abc..."}
     */
    public function googleAuth(Request $request)
    {
        $validated = $request->validate([
            'google_id' => 'required|string',
            'email' => 'required|email',
            'nom' => 'required|string',
            'prenom' => 'required|string',
            'photo' => 'nullable|string',
        ]);

        $user = User::firstOrCreate(
            ['email' => $validated['email']],
            [
                'nom' => $validated['nom'],
                'prenom' => $validated['prenom'],
                'photo' => $validated['photo'] ?? null,
                'role' => UserRole::USER,
                'status' => 'active',
                'ville_id' => 1,
            ]
        );

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'user' => $user,
            'token' => $token,
        ], 200);
    }

    /**
     * Register a new user account
     *
     * @unauthenticated
     * @bodyParam nom string required First name
     * @bodyParam prenom string required Last name
     * @bodyParam email string required Unique email address
     * @bodyParam telephone string required Unique phone number
     * @bodyParam password string required Minimum 8 characters
     * @bodyParam ville_id integer required City ID
     * @bodyParam role string required Either "user" or "diaspora"
     *
     * @response 201 {"user": {"id": 1, "nom": "Traore", "prenom": "Moussa", "email": "student@gmail.com", "role": "user", "status": "active"}, "token": "1|abc..."}
     */
    public function register(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string',
            'prenom' => 'required|string',
            'email' => 'required|email|unique:users',
            'telephone' => 'required|string|unique:users',
            'password' => 'required|string|min:8',
            'ville_id' => 'required|exists:villes,id',
            'role' => ['required', new EnumValue(UserRole::class)],
        ]);

        $user = User::create([
            'nom' => $validated['nom'],
            'prenom' => $validated['prenom'],
            'email' => $validated['email'],
            'telephone' => $validated['telephone'],
            'password' => Hash::make($validated['password']),
            'ville_id' => $validated['ville_id'],
            'role' => $validated['role'],
            'status' => 'active',
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'user' => $user,
            'token' => $token,
        ], 201);
    }

    /**
     * Login with email and password
     *
     * @unauthenticated
     * @bodyParam email string required User email
     * @bodyParam password string required User password
     *
     * @response 200 {"user": {"id": 1, "nom": "Traore", "prenom": "Moussa", "email": "student@gmail.com", "role": "user", "status": "active"}, "token": "1|abc..."}
     * @response 401 {"message": "Invalid credentials"}
     */
    public function login(Request $request)
    {
        $validated = $request->validate([
            // @example "a@a.aa"
            'email' => 'required|email',
            // @example "aaaaaaaa"
            'password' => 'required|string',
        ]);

        $user = User::where('email', $validated['email'])->first();

        if (!$user || !Hash::check($validated['password'], $user->password)) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'user' => $user,
            'token' => $token,
        ], 200);
    }

    /**
     * Logout the authenticated user
     *
     * @authenticated
     * @response 200 {"message": "Logout successful"}
     */
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json(['message' => 'Logout successful'], 200);
    }

    /**
     * Get current authenticated user
     *
     * @authenticated
     * @response 200 {"id": 1, "nom": "Traore", "prenom": "Moussa", "email": "student@gmail.com", "role": "user", "status": "active", "ville_id": 1}
     */
    public function user(Request $request)
    {
        return response()->json($request->user(), 200);
    }
}
