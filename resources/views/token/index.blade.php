@extends('layout.app')
@section('content')
    <div data-v-1fd0f8d0="" class="vcontainer page" style="min-height: 812px!important;">
        <div data-v-1fd0f8d0="" class="header">
            <span data-v-1fd0f8d0="" class="name">合约地址</span>
            <span data-v-1fd0f8d0="" class="address">{{$address}}</span></div>
        <div data-v-1fd0f8d0="" class="main">
            <h4 data-v-1fd0f8d0="" class="vfs-18 vcolor-192330 mobile-padding">基本信息</h4>
            <div data-v-1fd0f8d0="" class="vshadow d-block d-lg-flex baseinfo">
                <div data-v-1fd0f8d0="" class="detail" style="width:100%">
                    <div data-v-1fd0f8d0="" class="vflex-between-center vborder-b balance">
                        <span data-v-1fd0f8d0="" class="vfs-12 vfw-500 vcolor-192330">积分总量</span>
                        <div data-v-1fd0f8d0="">
                            <span data-v-1fd0f8d0="" class="vfs-20 vcolor-52cbca">{{$result . " " . $symbol}}</span>
                            <span data-v-1fd0f8d0="" class="vfs-20 vcolor-192330 vpl-5">&nbsp;</span></div>
                    </div>


                </div>

            </div>

            <div data-v-cd5b40a0="" id="block-trade-detail" class="tradedetail" style="padding-bottom: 30px;">
                <div data-v-cd5b40a0="" class="top">
                    <span data-v-cd5b40a0="" class="title">交易明细</span>
                </div>
                <ul data-v-cd5b40a0="" class="middle">
                    @foreach($transactions as $v)
                        <li data-v-cd5b40a0="" class="item vshadow">
                            <div data-v-8701ced6="" data-v-cd5b40a0="" class="tx-detail">
                                <div data-v-8701ced6="" class="hash-section">
                                    <i data-v-8701ced6="" class="vicon icon-hash d-none d-lg-inline-block"></i>
                                    <a data-v-8701ced6="" href="/tx/{{$v['hash']}}" class="hash font-hash-title">
                                        <span data-v-8701ced6="" class="d-lg-inline-block">{{$v['hash']}}</span>
                                    </a>
                                    <span data-v-8701ced6="" style="color: #00b275;" class="output font-coin-title"> {{float_format($v['amount'])}} {{$symbol}}</span>
                                    <!----></div>

                            </div>
                        </li>
                    @endforeach
                </ul>
                <div style="display: flex;justify-content: space-between;padding: 0 5px;">
                    <div style="font-size: 14px;">当前第{{$transactions->currentPage()}}页</div>
                    {{$transactions->links('vendor.pagination.bootstrap-4')}}
                </div>
            </div>

        </div>
    </div>

@stop