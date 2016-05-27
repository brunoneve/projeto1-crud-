<?php

namespace CursoCode\Presenters;

use CursoCode\Transformers\ProjectMemberTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

class ProjectMemberPresenter extends FractalPresenter
{

    public function getTransformer()
    {
        return new ProjectMemberTransformer();
    }
}