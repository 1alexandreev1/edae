<?php

namespace App\Services\Settings;

use App\Models\Setting;
use App\Services\BaseService;
use Illuminate\Support\Facades\Auth;

class SettingService extends BaseService
{
    public $template = 'site.settings.';
    public $route = 'settings.';
    public $translation = 'settings.';
    public $model;

    function __construct()
    {
        parent::__construct(Setting::class);
    }

    public function outputData($adminPanel = false)
    {
        $with = $this->baseOutputData(false);
        $with['extendsTemplate'] = $this->adminTemplate;
        $with['permission'] = '';
        return $with;
    }

    public function getDatatableElements()
    {
        $query = $this->model::query();
        return $this->dataTableData($query)->make(true);
    }

    public function store($request)
    {
        $model = Auth::user()->settings()->create($request->all());
        return redirect()->route("{$this->route}show", $model);
    }

    public function edit($model = null, $show = false)
    {
        $with = $this->editElement($model, $show);
        return view($show ? "{$this->template}show" : 'edae.edit')->with($with);
    }

    public function save($request)
    {
        $models = $this->model::whereIn('slug', array_keys($request->settings))->get();
        foreach ($request->settings as $key => $items) {
            $models->firstWhere('slug', $key)->update([
                'settings' => $items
            ]);
        }
        return redirect()->route('admin.' . $this->route . 'index');
    }
}
