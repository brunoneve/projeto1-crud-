<?php

namespace CursoCode\Validators;


use Prettus\Validator\LaravelValidator;

class ProjectTaskValidator extends LaravelValidator
{
    protected $rules = [
        'project_id'  => 'required|integer',
        'name'  => 'required|max:255',
        'status'  => 'required'
    ];
}