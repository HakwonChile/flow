<?php

namespace HaneulChile\Flow;

use Http;

class Flow
{
    /**
     * Genera la URL de confirmación
     *
     * @return string
     */
    public function getUrlConfirmation()
    {
        return $this->generarUrl(config('flow.url_confirmation'));
    }

    /**
     * Genera la URL de retorno
     *
     * @return string
     */
    public function getUrlReturn()
    {
        return $this->generarUrl(config('flow.url_return'));
    }

    /**
     * Genera una URL utilizando las funciones de Laravel
     *
     * @param  mixed  $url
     *
     * @return string
     */
    public function generarUrl($url)
    {
        if (is_array($url)) {
            if (array_key_exists('url', $url))
                return url($url['url']);

            if (array_key_exists('route', $url))
                return route($url['route']);

            return '';
        } else {
            return $url;
        }
    }

    /**
     * Firmar los parámetros con la llave secreta (secret_key)
     *
     * @param array
     *
     * @return mixed
     */

    private function sign($params)
    {
        //Ordenamos los parámetros
        $keys = array_keys($params);
        sort($keys);
        $toSign = "";

        foreach ($keys as $key) {
            $toSign .= $key . $params[$key];
        }
        //Firmamos con la llave secreta
        $signature = hash_hmac('sha256', $toSign, config('flow.secret_key'));

        return $signature;
    }

    /**
     * Hace un llamado a la API del tipo GET
     *
     * @param $to string, $params array
     *
     * @return mixed
     */

    public function getFlow($to, $params)
    {
        $params = array_merge(['apiKey' => config('flow.api_key')], $params);
        $url = config('flow.url') . $to;
        $params['s'] = $this->sign($params);
        $url = $url . "?" . http_build_query($params);
        $response = Http::get($url);

        if ($response->successful()) {
            return json_decode($response);
        } else {
            $response->throw();
        }
    }

    /**
     * Hace un llamado a la API del tipo POST
     *
     * @param $to string
     *
     * @return mixed
     */

    public function postFlow($to, $params)
    {
        $params = array_merge(['apiKey' => config('flow.api_key')], $params);
        $url = config('flow.url') . $to;
        $params['s'] = $this->sign($params);
        $response = Http::asForm()->post($url, $params);

        if ($response->successful()) {
            return json_decode($response);
        } else {
            $response->throw();
        }
    }
}
