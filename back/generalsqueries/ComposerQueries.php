<?php
namespace GeneralsQueries;
use App\Helpers\HelperNotify;
use Illuminate\Support\Facades\Log;

class ComposerQueries {
    private $model;
    private $view;
    public $info = ['result' => false, 'message' => ['title' => 'Error!', 'content' => 'Internal Server Error.']];
    public $message;
    

    public function __construct($model, $view, $message) {
        $this->model = $model;
        $this->view = $view;
        $this->message = $message;
    }

    public function helper () {
        return new HelperNotify();
    }

    public function create ($data) {
        try {
            $create = $this->model::create($data);
            if ($create) {
                $this->info['result'] = true;
                $this->info['message'] = $this->helper()->getNotify('success', ucfirst("$this->message ha sido creado."));
            } else {
                $this->info['result'] = false;
                $this->info['message'] = $this->helper()->getNotify('error', ucfirst("$this->message no se pudo crear."));
            }
        } catch (\Exception $e) {
            $exception = new Exceptions();
            $this->info['result'] = false;
            $this->info['message'] = $exception->codeErrors($e);
        }
        return $this->info;
    }

    public function update ($id, $data) {
        
        try {
            $update = $this->model::where('id', $id)->update($data);
            if ($update) {
                $this->info['result'] = true;
                $this->info['message'] = $this->helper()->getNotify('success', ucfirst("$this->message ha sido actualizado."));
            } else {
                $this->info['result'] = false;
                $this->info['message'] = $this->helper()->getNotify('error', ucfirst("$this->message no se pudo actualizar."));
            }
        } catch (\Exception $e) {
            $exception = new Exceptions();
            $this->info['result'] = false;
            $this->info['message'] = $exception->codeErrors($e);
        }
        return $this->info;
    }

    public function delete ($id) {
        
        try {
            $delete = $this->model::where('id', $id)->delete();
            if ($delete) {
                $this->info['result'] = true;
                $this->info['message'] = $this->helper()->getNotify('success', ucfirst("$this->message ha sido eliminado."));
            } else {
                $this->info['result'] = false;
                $this->info['message'] = $this->helper()->getNotify('error', ucfirst("$this->message no se pudo eliminar."));
            }
        } catch (\Exception $e) {
            $exception = new Exceptions();
            $this->info['result'] = false;
            $this->info['message'] = $exception->codeErrors($e);
        }
        return $this->info;
    }

    public function pagination_model ($columns, $filter) {
        $where = '';
        $or = '';
        $and = '';
        $getAll = $this->model::query();
        if (count($columns)) {
            $getAll->select($columns);
        }
        $handle = new HandleFilters();
        if (isset($filter['conditions'])) {
            foreach ($filter['conditions'] as $key => $value) {
                $and .= $value[0]. " ".$value[1]." ".$handle->type_data($value[2]). " AND ";
            }
            $where .= rtrim($and, ' AND');
        }
        if (isset($filter['filter'])) {
            foreach ($filter['filter'] as $key => $value) {
                $or .= $value[0] ." LIKE '%".$value[1]."%' OR ";
            }
            $position = strrpos($or,'OR');
            if ($position !== false) {
                $or = substr($or, 0, $position - 1);
            }
            if ($where !== '') {
                $where .= " AND ( ".$or." ) ";
            }else {
                $where .= " ".$or." ";
            }
        }
        
        if (isset($filter['pagination'])) {
            $sortBy = $filter['pagination']['sortBy'];
            $desc = $filter['pagination']['descending'] == 'true' ? 'desc' : 'asc';
            $getAll->orderBy($sortBy, $desc);
            if ($where !== '') {
                $getAll->whereRaw($where)->get();
            }else {
                $getAll->get();
            }
            $this->info['result'] = $getAll->count() > 0 ? true : false;
            $this->info['data'] = $getAll->paginate($filter['pagination']['rowsPerPage'], ['*'], 'page', $filter['pagination']['page']);
            
            
        }else {
            if ($where !== '') {

                $this->info['data'] = $getAll->whereRaw($where)->get();
                $this->info['result'] = $getAll->count() > 0 ? true : false;
            }else {
                $this->info['data'] = $getAll->get();
                
                $this->info['result'] = $getAll->count() > 0 ? true : false;
            }
        }
        
        return $this->info;
    }

    public function get_model_by ($data) {
        return $this->model;
    }

    public function pagination_view ($data) {
        return $this->view;
    }

    public function get_view_by ($data) {
        return $this->view;
    }
}