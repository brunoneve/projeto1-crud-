<?php

namespace CursoCode\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use CursoCode\Repositories\ProjectRepository;
use CursoCode\Entities\Project;
use CursoCode\Validators\ProjectValidator;

/**
 * Class ProjectRepositoryEloquent
 * @package namespace CursoCode\Repositories;
 */
class ProjectRepositoryEloquent extends BaseRepository implements ProjectRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Project::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
