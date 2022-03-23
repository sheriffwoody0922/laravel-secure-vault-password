<?php declare(strict_types=1);

namespace App\Domains\User\Test\Feature;

use Illuminate\Testing\TestResponse;

abstract class ApiAbstract extends FeatureAbstract
{
    /**
     * @param string $route
     * @param array $body = []
     *
     * @return \Illuminate\Testing\TestResponse
     */
    protected function postAuthorized(string $route, array $body = []): TestResponse
    {
        return $this->post($route, $this->postAuthorizedBody($body), $this->apiAuthorization());
    }

    /**
     * @param string $route
     * @param array $body = []
     *
     * @return \Illuminate\Testing\TestResponse
     */
    protected function postJsonAuthorized(string $route, array $body = []): TestResponse
    {
        return $this->postJson($route, $this->postAuthorizedBody($body), $this->apiAuthorization());
    }

    /**
     * @param array $body
     *
     * @return array
     */
    protected function postAuthorizedBody(array $body): array
    {
        return ['api_secret' => $this->authUser()->api_key] + $body;
    }
}
