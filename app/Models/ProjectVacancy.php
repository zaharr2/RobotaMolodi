<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectVacancy extends Model
{
    use ModelValidator;

    protected $table = 'projects_vacancies';
    protected $fillable = [
        'name',
        'description',
        'total',
        'free'
    ];

    private $rules = [
        'name'        => 'required|min:3|max:32',
        'description' => 'required|min:3|max:255',
        'total'       => 'required|integer',
        'free'        => 'required|integer',
    ];

    public function project()
    {
        return $this->belongsTo('App\Models\Project', 'project_id');
    }

    public function options()
    {
        return $this->hasMany('App\Models\ProjectVacancyOption','vacancy_id');
    }

    public function getGroup($key = null)
    {
        $data = [
            ProjectVacancyOption::ESSENTIALSKILLS => 'Essential skills',
            ProjectVacancyOption::PERSONALSKILLS => 'Personal skills',
            ProjectVacancyOption::BEPLUS => 'Would be a good plus',
            ProjectVacancyOption::FORYOU => 'What’s in it for you',
            ProjectVacancyOption::RESPONSIBILITIES => 'Responsibilities',
        ];
        if(is_null($key))
            return $data;
        else
            return $data[$key];
    }

    public function getOptions($type)
    {
        $c = $this->options()->where('group_id',$type)->get();
        if($c->isEmpty())
        {
            $c = collect([new ProjectVacancyOption(['value' => ''])]);
        }
        return $c;
    }

    public function toArray()
    {
        if($this->getError() === null)
            $error = [];
        else
            $error = $this->getError()->toArray();

        $instace = parent::toArray();
        $instace['error'] = $error;

        return $instace;
    }

    public function setCompositeKey($rooId)
    {
        if(!is_null($rooId))
        {
            $this->project_id = $rooId;
        }
    }

}
