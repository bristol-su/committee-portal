<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use BristolSU\Support\Connection\Connection;
use BristolSU\Support\Connection\Contracts\ConnectionRepository;
use BristolSU\Support\Connection\Contracts\ConnectorFactory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class ConnectionController extends Controller
{

    public function index(ConnectionRepository $connectionRepository)
    {
        return collect($connectionRepository->all())->values();
    }

    public function destroy(Connection $connection, ConnectionRepository $connectionRepository)
    {
        if($connectionRepository->delete($connection->id)) {
            return Response::json('', 204);
        }
        return Response::json([], 500);
    }

    public function update(Request $request, Connection $connection, ConnectionRepository $connectionRepository)
    {
        $attributes = [
            'name' => $request->input('name', $connection->name),
            'description' => $request->input('description', $connection->description),
        ];
        if($request->has('settings')) {
            $attributes['settings'] = $request->input('settings');
        }
        return $connectionRepository->update($connection->id, $attributes);
    }

    public function store(Request $request, ConnectionRepository $connectionRepository)
    {
        return $connectionRepository->create([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'alias' => $request->input('alias'),
            'settings' => $request->input('settings', [])
        ]);
    }

    public function test(Connection $connection, ConnectorFactory $connectorFactory)
    {
        $connector = $connectorFactory->createFromConnection($connection);
        if($connector->test()) {
            return Response::json(['result' => true], 200);
        }
        return Response::json(['result' => false], 200);
    }
}
