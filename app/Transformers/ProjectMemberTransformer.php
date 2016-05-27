<?php

namespace CursoCode\Transformers;

use CursoCode\Entities\User;
use League\Fractal\TransformerAbstract;

class ProjectMemberTransformer extends TransformerAbstract
{
    /**
     * @param User $member
     * @return array
     */
    public function transform(User $member)
    {
        return [
            'member_id' => $member->id,
            'name' => $member->name,
            'email' => $member->email,
            'created' => $member->created_at,
            'updated' => $member->updated_at,
        ];
    }
}