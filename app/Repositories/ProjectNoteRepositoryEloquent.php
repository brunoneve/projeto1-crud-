<?php

namespace CursoCode\Repositories;

use CursoCode\Presenters\ProjectNotePresenter;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use CursoCode\Entities\ProjectNote;
use CursoCode\Repositories\ProjectNoteRepository;

/**
 * Class ProjectNoteRepositoryEloquent
 * @package namespace CursoCode\Repositories;
 */
class ProjectNoteRepositoryEloquent extends BaseRepository implements ProjectNoteRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return ProjectNote::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function presenter()
    {
        return ProjectNotePresenter::class;
    }
}
