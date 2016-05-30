<?php

namespace CursoCode\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use CursoCode\Entities\Project;
use CursoCode\Presenters\ProjectPresenter;


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
     * @param $project_id
     * @param $member_id
     * @return bool
     */
    public function isMember($project_id, $member_id)
    {
        if ($this->find($project_id)->members()->find($member_id))
        {
            return true;
        }
        return false;
    }

    /**
     * @param $project_id
     * @param $member_id
     * @return bool
     */
    public function addMember($project_id, $member_id)
    {
        $project = $this->find($project_id);
        if ($project->members->contains('id', $member_id))
        {
            return false;
        }
        $project->members()->attach($member_id);
        return true;
    }

    /**
     * @param $project_id
     * @param $member_id
     * @return bool
     */
    public function removeMember($project_id, $member_id)
    {
        if ($this->find($project_id)->members()->detach($member_id))
        {
            return true;
        }
        return false;
    }

    /**
     * @param $project_id
     * @param $user_id
     * @return bool
     */
    public function isOwner($project_id, $user_id)
    {
        if( count( $this->skipPresenter()->findWhere(['id' => $project_id, 'owner_id' => $user_id] ) ) ){
            return true;
        }
        return false;
    }

    /**
     * @param $project_id
     * @param $member_id
     * @return bool
     */
    public function hasMember($project_id, $member_id)
    {
        $project = $this->skipPresenter()->find($project_id);

        foreach($project->members as $member)
        {
            if($member->id == $member_id)
            {
                return true;
            }
        }
        return false;
    }

    public function presenter()
    {
        return ProjectPresenter::class;
    }
}
