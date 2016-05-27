<?php

namespace CursoCode\Presenters;

use CursoCode\Transformers\ProjectNoteTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

class ProjectNotePresenter extends FractalPresenter
{

    public function getTransformer()
    {
        return new ProjectNoteTransformer();
    }
}