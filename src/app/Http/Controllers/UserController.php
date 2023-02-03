<?php

    namespace App\Http\Controllers;

    use App\Models\User;
    use App\Models\UserPreference;
    use Illuminate\Contracts\Foundation\Application;
    use Illuminate\Contracts\Routing\ResponseFactory;
    use Illuminate\Http\Request;
    use Illuminate\Http\Response;
    use Illuminate\Validation\Rules;

    class UserController extends Controller
    {

        /**
         * @param Request $request
         * @return Response|Application|ResponseFactory
         */
        public function addUserPreference(Request $request): Response|Application|ResponseFactory
        {

            $user_id = $request->user()->id; //Get Auth user id

            $request->validate([
                'meta' => 'required',
//            'value'=>'required'
            ]);

            $inputs = $request->all(); //Grab the inputs

            $value = isset($inputs['value']) ? $inputs['value'] : '';

            //Check if meta allowed
            if (!in_array($inputs['meta'], UserPreference::allowedPreferences())) {
                return response(['error' => 'Meta is not allowed'], 403);
            }

            //Store the meta and value
            UserPreference::addPreference($user_id, $inputs['meta'], $value);
            //Add feed value
            UserPreference::addPreference($user_id, 'feed', $value);

            return response(['success' => 'Preference has been saved!'], 201);

        }

        /**
         * @param Request $request
         * @return Response|Application|ResponseFactory
         */
        public function getUserPreference(Request $request): Response|Application|ResponseFactory
        {

            $user_id = $request->user()->id; //Get Auth user id

            $request->validate(['meta' => 'required']);

            $inputs = $request->all(); //Grab the inputs

            //Check if meta is allowed
            if (!in_array($inputs['meta'], UserPreference::allowedPreferences())) {
                return response(['error' => 'Meta is not Found'], 403);
            }

            $user_preferences = UserPreference::getPreference($user_id, $inputs['meta']);

            return response($user_preferences, 200);


        }

        /**
         * @param Request $request
         * @return Response|Application|ResponseFactory
         */
        public function getUserPreferences(Request $request): Response|Application|ResponseFactory
        {

            $user_id = $request->user()->id; //Get Auth user id

            $user_preferences = UserPreference::getAllPreferences($user_id);

            return response($user_preferences, 200);

        }

        /**
         * @param Request $request
         * @return Application|ResponseFactory|Response
         */
        public function changePassword(Request $request)
        {

            //Validate Password and confirm password
            $request->validate([
                    'password' => ['required', 'confirmed', Rules\Password::defaults()],
                ]

            );
            $user_id = $request->user()->id;
            $inputs = $request->all();
            User::updatePassword($user_id, $inputs['password']);
            return response('success', 200);

        }


    }
