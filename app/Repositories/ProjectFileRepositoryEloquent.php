<?php

namespace CursoCode\Repositories;

use CursoCode\Entities\ProjectFile;
use CursoCode\Presenters\ProjectFilePresenter;
use Prettus\Repository\Eloquent\BaseRepository;


/**
 * Class ProjectFileRepositoryEloquent
 * @package namespace CursoCode\Repositories;
 */
class ProjectFileRepositoryEloquent extends BaseRepository implements ProjectFileRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return ProjectFile::class;
    }

    /**
     * @param $project_id
     * @return mixed
     */
    public function getFiles($project_id)
    {
        return $this->findWhere(['project_id' => $project_id]);
    }

    public function presenter()
    {
        return ProjectFilePresenter::class;
    }
}
