<?php

namespace App\Http\Controllers;


use App\Events\AccessTokenEvent;

use App\Helper\ErrorHandel\AuthorizationErrors\AuthorizationCodeGrant;
use App\Jobs\ExampleJob;
use App\Models\User;
use Carbon\Carbon;
use Firebase\JWT\JWT;
use Illuminate\Contracts\Config\Repository as Config;
use Illuminate\Contracts\Encryption\Encrypter;
use Illuminate\Http\Request;

use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Queue;
use Illuminate\Support\Str;
use Laravel\Passport\Client;
use Laravel\Passport\Http\Controllers\HandlesOAuthErrors;
use Laravel\Passport\Passport;
use Symfony\Component\HttpFoundation\Cookie;


class AuthorizationController extends Controller
{
    use HandlesOAuthErrors;

    public function __construct(Config $config, Encrypter $encrypter)
    {
        $this->config = $config;
        $this->encrypter = $encrypter;
    }

    public function authorizes(Request $request)
    {

        $state = Str::random(40);
        $code_verifier = Str::random(128);
        $codeChallenge = strtr(rtrim(
            base64_encode(hash('sha256', $code_verifier, true))
            , '='), '+/', '-_');

        $user_id = $this->checkUserValidate($request);
        if (!$user_id) {
            return response()->json(AuthorizationCodeGrant::UserNotExist());
        }

        $ClientsId = $this->ClientsUpdate($user_id, $state, $code_verifier);
        if (!$ClientsId) {
            return response()->json(AuthorizationCodeGrant::ClientsNotMatch());
        }
        //  Event::dispatch(new AccessTokenEvent($user_id));

        return response()->json([
            'client_id' => "$ClientsId",
            'state' => $state,
            'code_challenge' => $codeChallenge,
        ]);

    }

    public function authorizestwo(Request $request)
    {

//        Auth::attempt([
//            'email' => "moh@gmail.com",
//            'password' => "moh",
//
//        ]);
        //  $user = User::where('id', '2')->first();
        // dd(Auth::user());
        // $access_token = $user->createToken("for-{$request->username}");
        //  Event::dispatch(new AccessTokenEvent($request->username));
        log::info('test3');
        log::info('test4');
        Queue::push(new ExampleJob());
        log::info('test5');
        log::info('test6');

    }

    public function refresh(Request $request)
    {
        $user = User::where('id', '2')->first();
        return (new Response('Refreshed.'))->withCookie($this->make(
            $user, Str::random(40)
        ));
    }

    public function make($userId, $csrfToken)
    {
        $expiration = Carbon::now()->addMinutes(4000);
        return new Cookie(
            Passport::cookie(),
            $this->createToken($userId, $csrfToken, $expiration),
            $expiration,
            //  $config['path'],
            //   $config['domain'],
            //  $config['secure'],
            true,
            false,
            $config['same_site'] ?? null
        );
    }
    protected function createToken($userId, $csrfToken, Carbon $expiration)
    {
        return JWT::encode([
            'sub' => $userId,
            'csrf' => $csrfToken,
            'expiry' => $expiration->getTimestamp(),
        ], $this->encrypter->getKey());
    }

    /**
     * Transform the authorization requests's scopes into Scope instances.
     *
     * @param \League\OAuth2\Server\RequestTypes\AuthorizationRequest $authRequest
     * @return array
     */
    protected function parseScopes($authRequest)
    {
        return Passport::scopesFor(
            collect($authRequest->getScopes())->map(function ($scope) {
                return $scope->getIdentifier();
            })->unique()->all()
        );
    }

    /**
     * Approve the authorization request.
     *
     * @param \League\OAuth2\Server\RequestTypes\AuthorizationRequest $authRequest
     * @param \Illuminate\Database\Eloquent\Model $user
     * @return \Illuminate\Http\Response
     */
    protected function approveRequest($authRequest, $user)
    {

        $authRequest->setUser(new User($user->getAuthIdentifier()));

        $authRequest->setAuthorizationApproved(true);

        return $this->withErrorHandling(function () use ($authRequest) {
            return $this->convertResponse(
                $this->server->completeAuthorizationRequest($authRequest, new Psr7Response)
            );
        });
    }

    public function ClientsUpdate($user_id, $state, $code_verifier)
    {
        $Clients = Client::where(['user_id' => $user_id, 'secret' => null])->first();
        if ($Clients) {
            $Clients->state = $state;
            $Clients->code_verifier = $code_verifier;
            $Clients->save();
            return $Clients->id;
        }
        return false;
    }

    public function checkUserValidate(Request $request)
    {

        $user = User::where('email', '=', $request->username)->first();
        if ($user) {
            if (Hash::check($request->get('password'), $user->password)) {
                return $user->id;
            }
            return false;
        }
        return false;
    }


}
