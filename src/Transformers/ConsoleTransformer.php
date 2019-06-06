<?php

namespace YWatchman\Panel_Console\Transformers;

use Pterodactyl\Transformers\Api\Client\BaseClientTransformer as BaseTransformer;
use Pterodactyl\Models\Server;

class ConsoleTransformer extends BaseTransformer
{

    /**
     * @return string
     */
    public function getResourceName(): string
    {
        return Server::RESOURCE_NAME;
    }

    /**
     * Return a transformed console array.
     *
     * @param \Pterodactyl\Models\Server $server
     * @return array
     *
     * @throws \Pterodactyl\Exceptions\Repository\RecordNotFoundException
     */
    public function transform(Server $server): array
    {
        $token = request()->attributes->get('server_token');
        return [
            'id' => $server->getKey(),
            'external_id' => $server->external_id,
            'identifier' => $server->uuidShort,
            'name' => $server->name,
            'daemon_key' => $token
        ];
    }
}
