<?php

namespace App\Integrations;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Config\Repository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\Facades\Log;
use Psr\Http\Message\StreamInterface;

/**
 * AsaasIntegration
 */
class AsaasIntegration
{

    private string $serviceConfig = "asaas";

    /**
     * @return Client
     */
    private function getHttpClient():Client
    {
        return new Client(['verify' => false]);
    }

    /**
     * @return Repository|Application
     */
    private function getBaseUrl(): mixed
    {
        return config("$this->serviceConfig.url");
    }

    /**
     * @return Repository|Application
     */
    private function getApiKey(): mixed
    {
        return config("$this->serviceConfig.api_key");
    }

    /**
     * @param $action
     * @return Repository|Application|mixed
     */
    private function getResourceByAction($action):array
    {
        return [
            'resource' => config("$this->serviceConfig.$action.resource"),
            'method'   => config("$this->serviceConfig.$action.method"),
            'json'     => config("$this->serviceConfig.$action.json"),
            ];
    }

    /**
     * @return array
     */
    private function getHeaders(): array
    {
        return [
            'Content-Type' => 'application/json',
            'access_token' => $this->getApiKey()
        ];
    }

    /**
     * @param string $action
     * @param array $params
     * @return array|StreamInterface
     */
    protected function processRequest(string $action, array $params): array|StreamInterface
    {
        $actionConfig = $this->getResourceByAction($action);
        $urlParams = '';

        if ($actionConfig['method'] == 'GET') {
            if (is_array($params) && count($params) > 1) {
                $urlParams = "?". http_build_query($params);
            }
            $params = [];
        }

        $endpoint = $this->getBaseUrl(). $actionConfig['resource'] . $urlParams;
        $options  = [
            'headers' => $this->getHeaders()
        ];

        return $this->send($params, $options, $actionConfig['method'], $endpoint, $actionConfig['json']);

    }

    /**
     * @param array $params
     * @param array $options
     * @param string $method
     * @param string $endpoint
     * @param bool $json
     * @return array
     */
    private function send(array $params, array $options, string $method, string $endpoint, bool $json): array
    {
        if ($json) {
            $options['body'] = json_encode($params);
        } elseif($method == 'POST') {
            $options['json'] = $params;
        }
        try {
            $response = $this->getHttpClient()->request($method, $endpoint, $options);
            return json_decode($response->getBody(), true);
        } catch (GuzzleException $e) {
            return [
                'error'   => true,
                'message' => $e->getMessage(),
                'status'  => $e->getCode(),
            ];
        } catch (\Exception $e) {
            return [
                'error'   => true,
                'message' => $e->getMessage(),
                'status'  => $e->getCode(),
            ];
        }

    }


}
