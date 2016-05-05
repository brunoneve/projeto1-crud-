<?php

namespace CursoCode\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use CursoCode\Entities\Project;

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

}
