<?php

namespace CursoCode\Repositories;


use CursoCode\Entities\Client;
use Prettus\Repository\Eloquent\BaseRepository;

class ClientRepositoryEloquent extends BaseRepository
{
    public function model()
    {
        return Client::class;
    }
}