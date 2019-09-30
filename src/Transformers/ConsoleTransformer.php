<?php

namespace YWatchman\Panel_Console\Transformers;

use Pterodactyl\Models\Server;
use Pterodactyl\Transformers\Api\Client\BaseClientTransformer as BaseTransformer;

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
     *
     * @throws \Pterodactyl\Exceptions\Repository\RecordNotFoundException
     *
     * @return array
     */
    public function transform(Server $server): array
    {
        $token = request()->attributes->get('server_token');
        $node = $server->node->fqdn.':'.$server->node->daemonListen;

        return [
            'id'          => $server->getKey(),
            'external_id' => $server->external_id,
            'identifier'  => $server->uuid,
            'name'        => $server->name,
            'daemon_key'  => $token,
            'node'        => $node,
        ];
    }
}
