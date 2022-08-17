<?php

namespace App\Http\Controllers;

use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class Controller extends BaseController
{
    public $service;

    function __construct($service)
    {
        $this->service = $service;
        $permission = $service->permission;
        if (Route::is("admin.{$this->service->route}index")) {
            $this->middleware("can:{$permission}-read", ['only' => ['index']]);
        }
        $this->middleware("can:$permission-create", ['only' => ['store', 'create']]);
        $this->middleware("can:$permission-edit", ['only' => ['edit', 'update']]);
        $this->middleware("can:$permission-delete", ['only' => ['destroy']]);
        //если нужно добавить каке либо ф-ции в наследуемом
        // $this->middleware("can:$service->permission-update", ['only' => []]);
    }

    public function index()
    {
        if (Route::is("admin.{$this->service->route}index")) {
            if (request()->ajax()) {
                return $this->service->getDatatableElements();
            }
            return view($this->service->template . 'admin')->with($this->service->outputData(true, true));
        }
        return view($this->service->template . 'index')->with($this->service->outputData());
    }

    public function create()
    {
        return $this->service->edit();
    }

    public function estimation($id, $estimation)
    {
        return $this->service->estimation($id, $estimation);
    }

    public function storeTag(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3|max:50'
        ], [], [
            'name' => 'Наименование тега'
        ]);
        if (request()->ajax()) {
            return $this->service->storeTag($request);
        }

        return abort(404);
    }

    public function storeComment($id, Request $request)
    {
        $request = $request->validate([
            'text' => 'required|string|min:1|max:500',
            'reply_to' => 'nullable|exists:users,id',
            'parrent_id' => 'nullable|exists:comments,id',
            'lastCommentDate' => 'required|date',
        ], [], [
            'text' => 'Комментарий',
            'reply_to' => 'Ответ пользователю',
            'parrent_id' => 'Для комментария',
            'lastCommentDate' => 'Дата последнего комментария',
        ]);
        if (request()->ajax()) {
            return $this->service->storeComment($id, $request);
        }
        return abort(404);
    }

    public function destroy($id)
    {
        if (request()->ajax()) {
            return [
                'status' => $this->service->destroy($id),
            ];
        }
        $this->service->destroy($id);
        return redirect()->route($this->service->route . 'index');
    }
}
