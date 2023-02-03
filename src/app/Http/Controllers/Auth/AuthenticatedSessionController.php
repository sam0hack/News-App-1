<?php

    namespace App\Http\Controllers\Auth;

    use App\Http\Controllers\Controller;
    use App\Http\Requests\Auth\LoginRequest;
    use Illuminate\Http\Request;
    use Illuminate\Http\Response;
    use Illuminate\Support\Facades\Auth;

    class AuthenticatedSessionController extends Controller
    {

        /**
         * Handle an incoming authentication request.
         */
        public function store(LoginRequest $request): Response
        {
            //dd($request);
            $request->authenticate();


            $token = $request->user()->createToken($request->user());

            //For WEB
            //$request->session()->regenerate();

            return response(['token' => $token->plainTextToken], 200);
        }

        /**
         * Destroy an authenticated session.
         */
        public function destroy(Request $request): Response
        {
            Auth::guard('web')->logout();

            //Revoke auth:sanctum
            $request->user()->tokens()->delete();

            //$request->session()->invalidate();

            //$request->session()->regenerateToken();

            return response()->noContent();
        }
    }
