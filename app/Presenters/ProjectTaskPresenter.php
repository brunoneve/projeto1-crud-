<?php

namespace CursoCode\Presenters;

use CursoCode\Transformers\ProjectTaskTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

class ProjectTaskPresenter extends FractalPresenter
{

    public function getTransformer()
    {
        return new ProjectTaskTransformer();
    }
}