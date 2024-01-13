<?php
namespace GeneralsQueries;
use Illuminate\Support\Facades\DB;
use App\Helpers\Exceptions;
class UserComposer extends ComposerQueries{
    private $model;
    private $view;
    private $account;
    public $message;
    public function __construct($model, $view, $message, $account) {
        parent::__construct($model, $view, $message);
        $this->model = $model;
        $this->view = $view;
        $this->account = $account;
        $this->message = $message;
    }

    public function add_account($request){
        try {
            // EL TOKEN SE PUEDE ELIMINAR, PUEDE QUE SEA INNECESARIO
            $request['user']['token_verification'] = sha1(uniqid());
            DB::beginTransaction();
            $account = $this->account::create($request['account']);
            if ($account) {
                $request['user']['account_id'] = $account->id;
                $user = $this->model::create($request['user']);
                if ($user) {
                    DB::commit();
                    $this->info['result'] = true;
                    $this->info['message'] = $this->helper()->getNotify('success', ucfirst("$this->message ha sido creado."));
                } else {
                    DB::rollBack();
                    $this->info['result'] = false;
                    $this->info['message'] = $this->helper()->getNotify('error', ucfirst("$this->message no se pudo crear."));
                }        
            } else {
                DB::rollBack();
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
}