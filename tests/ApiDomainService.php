<?php

namespace Tests;

use App\Http\Middleware\PrivateMiddleware;
use Illuminate\Routing\Middleware\ThrottleRequests;

trait ApiDomainService
{
    public function createEndpointToken(string $permissionEndpointName): string
    {
        $this->withoutMiddleware([ThrottleRequests::class, PrivateMiddleware::class]);

        $responsePermission = $this->json('post', 'v1/api/permissions', ['name' => $permissionEndpointName, 'slug' => $permissionEndpointName]);
        $responsePermissionArray = json_decode($responsePermission->content(), true);
        $permissionId = $responsePermissionArray['data']['id'];

        $responseRole = $this->post('v1/api/roles', ['name' => $permissionEndpointName, 'slug' => $permissionEndpointName]);
        $responseRoleArray = json_decode($responseRole->content(), true);
        $roleId = $responseRoleArray['data']['id'];

        $this->post('v1/api/role/' . $roleId . '/permissions', ['permissions' => $permissionId]);

        $responseClient = $this->post('v1/api/clients', ['name' => $permissionEndpointName]);

        $responseClientArray = json_decode($responseClient->content(), true);

        $clientUuid = $responseClientArray['data']['uuid'];

        $responseClientRoles = $this->post('v1/api/client/' . $clientUuid . '/roles', ['roles' => $roleId]);
        $responseClientRolesArray = json_decode($responseClientRoles->content(), true);
        $clientSetRole = $responseClientRolesArray['data']['roles'][0]['id'];

        $responseClientToken = $this->post('v1/api/client/' . $clientUuid . '/token', ['token_name' => 'check', 'roles' => $roleId]);
        $responseClientTokenArray = json_decode($responseClientToken->content(), true);

        $token = $responseClientTokenArray['data']['token'];

        return $token;
    }
}
