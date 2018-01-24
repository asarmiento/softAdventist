<?php
	
	namespace App\Http\Controllers\Auth;
	
	use App\Entities\User;
	use Illuminate\Http\Request;
	use App\Http\Controllers\Controller;
	use Illuminate\Support\Facades\Auth;
	use Laravel\Socialite\Facades\Socialite;
	
	class SocialAuthController extends Controller
	{
		// Metodo encargado de la redireccion a Facebook
		public function redirectToProvider($provider)
		{
			return Socialite::driver($provider)->redirect();
		}
		
		// Metodo encargado de obtener la información del usuario
		public function handleProviderCallback($provider)
		{
			// Obtenemos los datos del usuario
			$social_user = Socialite::driver($provider)->user();
			
			// Comprobamos si el usuario ya existe
			if ($user = User::where('email', $social_user->email)->first())
			{
				return $this->authAndRedirect($user); // Login y redirección
			} else
			{
				// En caso de que no exista creamos un nuevo usuario con sus datos.
				$user = User::create([
                'identification_card' => '',
                'name'                => $social_user->name,
                'last_name'           => $social_user->name,
                'password'            => bcrypt('event'),
                'email'               => $social_user->email,
                'type_user'           => 'event',
                'avatar'              => $social_user->avatar,
            ]);
                \Log::info(json_encode($social_user));
				
				return $this->authAndRedirect($user); // Login y redirección
			}
		}
		
		// Login y redirección
		public function authAndRedirect($user)
		{
			
			Auth::login($user);
			
			return redirect()->to('/home');
		}
	}
