<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Database\Eloquent\Relations\HasOne;

    class UserPreference extends Model
    {
        use HasFactory;

        protected $fillable = ['user_id','meta','value'];

        /**
         * @param $user_id
         * @return mixed
         */
        public static function getAllPreferences($user_id): mixed
        {
            return UserPreference::where('user_id', $user_id)->get();
        }

        /**
         * @param $user_id
         * @param $meta
         * @param $value
         * @return void
         */
        public static function addPreference($user_id, $meta, $value): void
        {

            //Check if meta Exists
            $user_preference = UserPreference::getPreference($user_id, $meta);

            //Single meta
            if (!empty($user_preference)){
                $user_preference->value = $value;
                $user_preference->save();
                return;
            }


            //Multi preference with same meta and different values.......
            //We don't want to save duplicate values.
            //A User can have multiple meta's but values must be different.
//            if (!empty($user_preference)) {
//
//                $stored_values = $user_preference->map(function ($pref){
//                    return $pref->value;
//                });
//
//                if (in_array($value,$stored_values->toArray())){
//                    return;
//                }
//            }

                UserPreference::create(['user_id' => $user_id, 'meta' => $meta, 'value' => $value]);

        }

        /**
         * @param $user_id
         * @param $meta
         * @return mixed
         */
        public static function getPreference($user_id, $meta): mixed
        {


            return UserPreference::where('user_id', $user_id)->where('meta', $meta)->first();

            //Multi preference with same meta and different values.......
            //return UserPreference::where('user_id', $user_id)->where('meta', $meta)->get();

        }

        public static function allowedPreferences(): array
        {
            return ['source','category','author','tag','feed'];
        }

        /**
         * @return HasOne
         */
        public function User(): HasOne
        {
            return $this->hasOne(User::class);
        }

    }
