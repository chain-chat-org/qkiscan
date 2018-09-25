<?php

namespace App\Http\Controllers;

use App\Model\Account;
use App\Model\Block;
use App\Model\MasterNode;
use App\Model\Transaction;
use App\Model\TxOut;
use App\Service\APIService;
use App\Service\SyncService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{

    /**
     * 首页
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $data['currentPage'] = 'index';
        return view("index.index",$data);
    }

    /**
     * 搜索
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function search(Request $request)
    {
        $keyword = $request->input('keyword');

        //判断是否为数字，如果为数字，优先查询区块
        if(is_numeric($keyword))
        {
            $res = Block::where('height',$keyword)->first();
            if(isset($res) && $res->hash_id)
            {
                $url = "/block/detail?hash=".$res->hash_id;
                return redirect($url);

            }else{
                //todo 跳转404页面
                return back();
            }
        }else{
            //如果不为数字，优先查询交易
            $res = Transaction::where('tx_hash',$keyword)->count();
            if($res > 0)
            {
                $url = "/tx/".$keyword;
                return redirect($url);
            }else{
                //如果不是交易，则查询是否为区块
                $res = Block::where('hash_id',$keyword)->count();
                if($res > 0)
                {
                    $url = "/block/detail?hash=".$keyword;
                    return redirect($url);
                }else{
                    //如果不为区块，则查询是否为地址
                    $res = Account::where('address',$keyword)->count();
                    if($res > 0)
                    {
                        $url = "/address/".$keyword;
                        return redirect($url);
                    }else{
                        //todo 跳转404页面
                        return back();
                    }
                }


            }
        }
    }

}
