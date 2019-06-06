<?php

namespace YWatchman\Panel_Console\Controllers\Api\User;

use Pterodactyl\Http\Controllers\Api\Client\ClientApiController as Controller;
use Pterodactyl\Models\Server;
use Pterodactyl\Http\Requests\Api\Client\Servers\GetServerRequest;
use YWatchman\Panel_Console\Transformers\ConsoleTransformer;

class ConsoleController extends Controller
{

    public function __construct() {
        parent::__construct();
    }

    public function show(GetServerRequest $request, Server $server)
    {
        return $this->fractal->item($request->getModel(Server::class))
            ->transformWith($this->getTransformer(ConsoleTransformer::class))
            ->toArray();
    }

}
