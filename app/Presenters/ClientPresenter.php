<?php

namespace CursoCode\Presenters;

use CursoCode\Transformers\ClientTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

class ClientPresenter extends FractalPresenter
{

    public function getTransformer()
    {
        return new ClientTransformer();
    }
}