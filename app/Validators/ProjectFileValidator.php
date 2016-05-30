<?php

namespace CursoCode\Validators;


use Prettus\Validator\LaravelValidator;

class ProjectFileValidator extends LaravelValidator
{
    protected $rules = [
        'project_id'  => 'required|integer',
        'file'        => 'required|mimes:jpeg,jpg,png,gif,pdf',
        'name'        => 'required',
        'description' => 'required'
    ];
}