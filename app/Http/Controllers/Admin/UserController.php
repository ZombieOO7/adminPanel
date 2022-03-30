<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Helpers\AdminHelper;
use App\Helpers\UserHelper;
use App\Http\Requests\Admin\UserFormRequest;
use App\Models\User;
use Illuminate\Http\Request;
use App\Traits\AjaxResponseTrait;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class UserController extends BaseController
{
    public $user,$helper,$view='admin.user.';
    /**
     * -------------------------------------------------------
     * | Create a new controller instance.                   |
     * |                                                     |
     * -------------------------------------------------------
     */
    public function __construct(UserHelper $helper)
    {
        $this->helper = $helper;
        parent::__construct();
    }

    /**
     * -------------------------------------------------------
     * | Get Admin Profile Page.                             |
     * |                                                     |
     * | @return View                                        |
     * -------------------------------------------------------
     */
    public function index(Request $request){
        try{
            $data['title'] = __('label.user_mng');
            return view($this->view.'index',$data);
        }catch(Exception $e){
            abort('404');
        }
    }

    /**
     * -------------------------------------------------------
     * | Get Admin Profile Page.                             |
     * |                                                     |
     * | @return View                                        |
     * -------------------------------------------------------
    */
    public function create(Request $request,$uuid=null){
        try{
            $data['title'] = __('label.user');
            if($uuid !=null){                
                $data['user'] = $this->helper->getData($uuid);
                $data['subTitle'] = __('label.edit');
            }
            return view($this->view.'create',$data);
        }catch(Exception $e){
            abort('404');
        }
    }

    /**
     * -------------------------------------------------------
     * | Get Admin Profile Page.                             |
     * |                                                     |
     * | @return View                                        |
     * -------------------------------------------------------
    */
    public function store(UserFormRequest $request,$id=null){
        $this->dbStart();
        try{
            $route = 'admin.user.index';
            $user = $this->helper->store($request,$id);
            $this->dbCommit();
            $msg = __('messages.save_success',['type'=>__('label.user')]);
            return AjaxResponseTrait::RedirectResponse('success',$route,$msg,$id);
        }catch(Exception $e){
            $this->dbEnd();
            return AjaxResponseTrait::RedirectResponse('errors',$route,$e->getMessage());
        }
    }

    /**
     * -------------------------------------------------------
     * | Get User list data.                                 |
     * |                                                     |
     * | @return Response                                    |
     * -------------------------------------------------------
    */
    public function getData(Request $request){
        $draw = intval($request->draw) + 1 ;
        $limit = @$request->length?? 10;
        $start = @$request->start ?? 0;
        $itemQuery = User::query()->select('*');
        $countTotal = $itemQuery->count();
        // $itemQuery = $itemQuery->skip($start)->take($limit);
        $users = $itemQuery->orderBy('created_at','desc')->get();
        // $countFilter = 0;
        // if ($countFilter == 0) {
        //     $countFilter = $countTotal;
        // }
        return DataTables::of($users)
                ->addColumn('action', function($data){
                    return view($this->view.'_action',['user'=>@$data]);
                })
                ->addColumn('checkbox', function($data){
                    return view($this->view.'_checkbox',['user'=>@$data]);
                })
                ->editColumn('created_at', function($data){
                    return @$data->proper_created_at;
                })
                ->editColumn('status', function($data){
                    return @$data->proper_status;
                })
                // ->with(['Total' => $countTotal, 'recordsTotal' => $countTotal, 'recordsFiltered' => $countFilter])
                ->rawColumns(['status','created_at','action','checkbox'])
                // ->skipPaging()
                ->make(true);
    }

    public function delete(Request $request,$uuid=null){
        $this->dbStart();
        try{
            $this->dbCommit();
        }catch(Exception $e){
            $this->dbEnd();
            return AjaxResponseTrait::RedirectResponse('errors',$route,$e->getMessage());
        }
    }
}
