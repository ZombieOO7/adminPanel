<?php
namespace App\Helpers;

use Illuminate\Support\Facades\DB;

class BaseHelper{
    public $mode;
    /**
     * -------------------------------------------------------
     * | Create a new helper instance.                       |
     * |                                                     |
     * -------------------------------------------------------
     */
    public function __construct()
    {

    }

    /**
     * -------------------------------------------------------
     * | Begin Transaction.                                  |
     * |                                                     |
     * -------------------------------------------------------
     */
    public function dbStart()
    {
        return DB::beginTransaction();
    }

    /**
     * -------------------------------------------------------
     * | Commit Transaction.                                 |
     * |                                                     |
     * -------------------------------------------------------
     */
    public function dbCommit()
    {
        return DB::commit();
    }

    /**
     * -------------------------------------------------------
     * | RollBack Transaction.                               |
     * |                                                     |
     * -------------------------------------------------------
     */
    public function dbEnd()
    {
        return DB::rollback();
    }

    /**
     * -------------------------------------------------------
     * | Unset null value from @request.                     |
     * |                                                     |
     * | @return request                                     |
     * -------------------------------------------------------
     */
    public function unsetRequestValue($request){
        foreach($request->all() as $key=> $value){
            if($value == null || $value==''){
                $request->request->remove($key);
            }
        }
        return $request;
    }
}
?>