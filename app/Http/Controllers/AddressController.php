<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Services\RpcService;

class AddressController extends Controller
{
    /**
     * 地址详情
     * @param $address
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index($address)
    {

        $RpcService = new RpcService();

        $params = array(
            [$address,"latest"]
        );

        $data = $RpcService->rpc("eth_getBalance",$params);

        $data = isset($data[0])?$data[0]:array();
   
        $data['result'] = float_format(bcdiv(gmp_strval($data['result']) ,gmp_pow(10,18),18));

        $data['address'] = $address;

        return view("address.index",$data);
    }
}