<?php

namespace CursoCode\Presenters;

use CursoCode\Transformers\ProjectFileTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

class ProjectFilePresenter extends FractalPresenter
{

    public function getTransformer()
    {
        return new ProjectFileTransformer();
    }
}