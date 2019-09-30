<?php

namespace YWatchman\Panel_Console\Transformers;

use Illuminate\Support\Collection;
use Pterodactyl\Models\User;
use Pterodactyl\Transformers\Api\Client\BaseClientTransformer as BaseTransformer;

class LoginTransformer extends BaseTransformer
{
    /**
     * @return string
     */
    public function getResourceName(): string
    {
        return User::RESOURCE_NAME;
    }

    /**
     * Return a transformed console array.
     *
     * @param \Illuminate\Support\Collection $keys
     * @param \Pterodactyl\Models\User       $user
     *
     * @return array
     */
    public function transform(Collection $keys, User $user): array
    {
        $data = [];
        foreach ($keys as $key) {
            $data[] = (object) [
                'memo'        => $key->memo,
                'allowed_ips' => $key->allowed_ips,
                'token'       => $key->identifier.decrypt($key->token),
            ];
        }

        return [
            'object' => 'list',
            'data'   => $data,
            'user'   => (object) [
                'name'    => $user->name_first,
                'surname' => $user->name_last,
                'email'   => $user->email,
            ],
        ];
    }
}
