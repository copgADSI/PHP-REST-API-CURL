<?php

namespace App\classes;

class Curl
{
    private $url;
    private $option;
    private $handler;
    private $response;

    public function __construct($url, $option = null)
    {

        $this->url = $url;
        $this->option = is_null($option) ? CURLOPT_URL : $option;
    }
    public function init()
    {
        $this->handler  = curl_init(); //Estable o inicia la sesion
        return $this; // Retornamos  todo el obj
    }

    public function setOption($option = null, $value = null)
    {
        curl_setopt(
            $this->handler,
            //Evaluamos si  la $opcion no está vacía, que tome la prop $this->option 
            //o en caso  contrario el valor $option
            is_null($option) ? $this->option : $option,
            is_null($value) ? $this->url : $value

        );
        return $this; //return obj
    }
    public function execute()
    {
        return curl_exec($this->handler); //Ejecutamos nuestra petición 
    }

    //Método GET
    public function buildQuery()
    {
        curl_setopt(
            $this->handler,
            CURLOPT_URL,
            $this->url /*  'https://pokeapi.co/api/v2/pokemon/' //Poke API */

        );
    }

    public function decode()
    {
        $this->response  = json_decode($this->execute(), true);
        return $this;
    }
    public function fetch()
    {
        return json_decode(json_encode($this->response));
    }
    public function close()
    {
        curl_close($this->handler);
        return $this;
    }

    public function exception()
    {
        curl_errno($this->handler); //En caso se capturen errores en la petición
        return $this;
    }
}
