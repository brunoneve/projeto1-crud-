<?php

namespace CursoCode\Transformers;

use CursoCode\Entities\Client;
use League\Fractal\TransformerAbstract;

class ClientTransformer extends TransformerAbstract
{

    /**
     * @param Client $client
     * @return array
     */
    public function transform(Client $client)
    {
        return [
            'client_id' => $client->id,
            'name' => $client->name,
            'responsible' => $client->responsible,
            'email' => $client->email,
            'phone' => $client->phone,
            'address' => $client->address,
            'obs' => $client->obs,
            'created' => $client->created_at,
            'updated' => $client->updated_at
        ];
    }

}