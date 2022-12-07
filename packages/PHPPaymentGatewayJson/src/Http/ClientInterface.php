<?php

namespace PaymentGatewayJson\Client\Http;

/**
 * Interface ClientInterface
 */
interface ClientInterface
{
    /**
     * @param  string  $method
     * @param  string  $url
     * @param  array  $headers
     * @return ResponseInterface
     */
    public function send($method, $url, array $headers = []);

    /**
     * @param  string  $url
     * @param  array  $headers
     * @return ResponseInterface
     */
    public function get($url, array $headers = []);

    /**
     * @param  string  $url
     * @param  mixed  $body
     * @param  array  $headers
     * @return ResponseInterface
     */
    public function post($url, $body, array $headers = []);
}
