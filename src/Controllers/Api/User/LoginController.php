<?php

namespace YWatchman\Panel_Console\Controllers\Api\User;

use Illuminate\Http\Request;
use Pterodactyl\Http\Controllers\Api\Client\ClientApiController as Controller;
use Pterodactyl\Contracts\Repository\UserRepositoryInterface;
use Pterodactyl\Exceptions\Repository\RecordNotFoundException;
use Pterodactyl\Contracts\Repository\ApiKeyRepositoryInterface;
use Pterodactyl\Services\Api\KeyCreationService;
use Pterodactyl\Models\ApiKey;

class LoginController extends Controller
{
    /**
     * @var \Pterodactyl\Contracts\Repository\UserRepositoryInterface
     */
    private $repository;

    /** 
     * @var \Pterodactyl\Contracts\Repository\ApiKeyRepositoryInterface;
     */
    private $service;

    /**
     * @var \Pterodactyl\Services\Api\KeyCreationService
     */
    private $keyCreationService;

    public function __construct(UserRepositoryInterface $repository, ApiKeyRepositoryInterface $apiKeyRepository, KeyCreationService $keyCreationService) {
        parent::__construct();
        $this->repository = $repository;
        $this->apiKeyRepository = $apiKeyRepository;
        $this->keyCreationService = $keyCreationService;
    }

    public function login(Request $req) {
        $username = $req->input('user');
        
        try {
            $user = $this->repository->findFirstWhere([['username', '=', $username]]);
        } catch (RecordNotFoundException $e) {
            return $this->failedLoginResponse();
        }

        if($user->use_totp) return $this->failedLoginResponse();

        if(password_verify($req->input('password'), $user->password)) {
            // Todo: TOTP
            $keys = $this->apiKeyRepository->getAccountKeys($user);
            // Todo: create transformer
            $data = [];
            foreach ($keys as $key) {
                $data[] = (object) [
                    'memo' => $key->memo,
                    'allowed_ips' => $key->allowed_ips,
                    'token' => $key->identifier . decrypt($key->token),
                ];
            }

            if(!$keys->count()) {
                $this->keyCreationService->setKeyType(ApiKey::TYPE_ACCOUNT)->handle([
                    'memo' => 'Pterodactyl App key',
                    'allowed_ips' => null,
                    'user_id' => $user->id
                ]);
            }

            return response()->json([
                 'object' => 'list',
                 'data' => $data
            ]);
        }

        return $this->failedLoginResponse();

    }

    public function failedLoginResponse() {
        return response()->json(['errors' => [(object) ['code' => 'HttpException', 'status' => '401', 'detail' => 'An error was encountered while processing this request.']]], 401);
    }

}
