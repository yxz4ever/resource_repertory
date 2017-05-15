<?php

/**
 * 抽奖算法
 * 简介:抽奖算法,抽奖算法适合老虎机,刮刮卡,大转盘,摇一摇,九宫格抽奖等等.搜集来自网络  
 * 算法主要是用在后台开发中,不管是什么抽奖,都属于数学问题,这个算法被很多游戏使用.
 */

/**
 * 概率算法
 * proArr array(100,200,300，400)
 */
function get_rand($proArr) {
    $result = '';
    $proSum = array_sum($proArr);
    foreach ($proArr as $key => $proCur) {
        $randNum = mt_rand(1, $proSum);
        if ($randNum <= $proCur) {
            $result = $key;
            break;
        } else {
            $proSum -= $proCur;
        }
    }
    unset($proArr);
    return $result;
}

/*
  获取中奖
 */

function get_prize() {
    $prize_arr = array(
        array('id' => 1, 'prize' => '平板电脑', 'v' => 1),
        array('id' => 2, 'prize' => '数码相机', 'v' => 1),
        array('id' => 3, 'prize' => '音箱设备', 'v' => 1),
        array('id' => 4, 'prize' => '4G优盘', 'v' => 1),
        array('id' => 5, 'prize' => '10Q币', 'v' => 1),
        array('id' => 6, 'prize' => '下次没准就能中哦', 'v' => 95),
    );
    foreach ($prize_arr as $key => $val) {
        $arr[$val['id']] = $val['v'];
    }
    $ridk = get_rand($arr); //根据概率获取奖项id 

    $res['yes'] = $prize_arr[$ridk - 1]['prize']; //中奖项 
    unset($prize_arr[$ridk - 1]); //将中奖项从数组中剔除，剩下未中奖项 
    shuffle($prize_arr); //打乱数组顺序 
    for ($i = 0; $i < count($prize_arr); $i++) {
        $pr[] = $prize_arr[$i]['prize'];
    }
    $res['no'] = $pr;
    return $res;
}

/**
 * 红包算法更新,发送一个正常返回,比如0.01元发1个人,1元发一个人和1元发100人正常返回0.01每人
 */

/**
 * $total 红包总额
 * $num 发几个
 * $min  最小红包
 */
function get_hongbao($total, $num = 10, $min = 0.01) {
    $money_arr = array();
    $return_arr = array();
    for ($i = 1; $i < $num; ++$i) {
        $max = round($total, 2) / ($num - $i);
        $random = 0.01 + mt_rand() / mt_getrandmax() * (0.99 - 0.01);
        $money = $random * $max;
        $money = $money <= $min ? 0.01 : $money;
        $money = floor($money * 100) / 100;
        $total = $total - $money;
        $money_arr[$i] = round($money, 2);
    }
    $money_arr[$i] = round($total, 2);
    shuffle($money_arr);
    $return_arr['money'] = $money_arr;
    $return_arr['total'] = array_sum($money_arr);
    return $return_arr;
}
