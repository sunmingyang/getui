<?php

return [
    'id'       => env('GT_APP_ID'),
    'key'      => env('GT_APP_KEY'),
    'secret'   => env('GT_APP_SECRET'),
    'master'   => env('GT_MASTER_SECRET'),
    'strategy' => [
        'default' => 4, // 默认所有厂商都走的策略
        //        'ios'     => 4, // iOS
        //        'st'      => 4, // 锤子？
        //        'hw'      => 4, // 华为
        //        'xm'      => 4, // 小米
        //        'vv'      => 4, // vivo
        //        'mz'      => 4, // 魅族
        //        'op'      => 4, // oppo
    ],
    'intent'   => 'intent:#Intent;action=android.intent.action.gtpush;component=com.wh.wang.scroopclassproject/.gtpush.OpenClickActivity;S.gttask=;S.payload=%s;end'
    //    'intent' => 'intent:#Intent;launchFlags=0x10000000;action=android.intent.action.gtpush;package=com.getui.demo;component=com.getui.demo/com.getui.demo.TestActivity;f.floatType=1.0;l.longType=1;B.booleanType=true;S.stringType=string;d.doubleType=1.0;i.intType=1;end'
];
