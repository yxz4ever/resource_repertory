<?php

/**
 * 算法Demo
 */

$aInteger = [2, 3, 4, 9, 8, 7, 5, 6, 11, 13, 14, 16, 18, 12, 1];


//
// echo 8 ^ 8;
// echo "\n";
// echo 0 ^ 8;
// echo "\n";


$sort = mergeSort($aInteger);

print_r($sort);


/**
 * 冒泡排序
 * 原理:拿第一个元素依次与后面的元素比较,总循环数依次递减
 */
function bubbleSort($aInteger)
{

    if (!is_array($aInteger) || count($aInteger) <= 1) {
        return $aInteger;
    }

    // 计算总数
    $iTotal = count($aInteger);

    // 循环外层,最后一个数可以不用循环
    for ($i = 0; $i < $iTotal - 1; $i++) {
        // 总循环数一次递减
        for ($j = 0; $j < $iTotal - 1 - $i; $j++) {
            // 如果大于后面的数,开始位移
            if ($aInteger[$j] > $aInteger[$j + 1]) {
                $aInteger[$j]     = $aInteger[$j] ^ $aInteger[$j + 1];
                $aInteger[$j + 1] = $aInteger[$j] ^ $aInteger[$j + 1];
                $aInteger[$j]     = $aInteger[$j] ^ $aInteger[$j + 1];

                // 通俗写法
                // $temp = $aInteger[$j];
                // $aInteger[$j] = $aInteger[$j+1];
                // $aInteger[$j+1] = $temp;
            }
        }
    }

    return $aInteger;
}

/**
 * 选择排序
 * 原理: 拿第一个元素依次与后面的值比较,并与后面最小的值交换位置.
 */
function selectionSort($arr)
{
    $total = count($arr);
    for ($i = 0; $i < $total; $i++) {
        // 定参
        $minIndex = $i;

        for ($j = $i + 1; $j < $total; $j++) {
            if ($arr[$minIndex] > $arr[$j]) {
                $minIndex = $j;
            }
        }
        if ($i != $minIndex) {
            $arr[$i]        = $arr[$i] ^ $arr[$minIndex];
            $arr[$minIndex] = $arr[$i] ^ $arr[$minIndex];
            $arr[$i]        = $arr[$i] ^ $arr[$minIndex];
        }

        // $temp           = $arr[$minIndex];
        // $arr[$minIndex] = $arr[$i];
        // $arr[$i]        = $temp;
    }

    return $arr;
}


/**
 * 插入排序
 * 原理: 选定一个数值与前一个数值比较,如果小于前一个数值,前一个数值后移一位
 */
function insertionSort($aInteger)
{
    $iTotal = count($aInteger);
    for ($i = 1; $i < $iTotal; $i++) {
        // 定参     前一个位置的索引,当前位置的值
        $preIndex = $i - 1;
        $current  = $aInteger[$i];

        // 与前一个位置比较值,如果小于前一个位置的值,前一个位置就推后一位
        while ($preIndex >= 0 && $current < $aInteger[$preIndex]) {
            $aInteger[$preIndex + 1] = $aInteger[$preIndex];
            $preIndex--;
        }

        // 某个位置的值要比当前数小,就插入到此位置   或者原位置不动
        $aInteger[$preIndex + 1] = $current;
    }
    return $aInteger;
}

/**
 * 希尔排序
 * 原理: 先分成若干组,再用插入排序
 */
function shellSort($arr)
{

    $total = count($arr);

    // 计算每组相隔的元素大小 希尔增量
    for ($i = floor($total / 2); $i > 0; $i = floor($i / 2)) {
        // ex: 1,4,7 一组     2,5,8一组
        // 插入法
        for ($j = $i; $j < $total; $j++) {
            // 定参
            $preIndex = $j - $i;
            $current  = $arr[$j];

            while ($preIndex >= 0 && $arr[$preIndex] > $current) {
                $arr[$preIndex + $i] = $arr[$preIndex];
                $preIndex            -= $i;
            }
            $arr[$preIndex + $i] = $current;

        }
    }
    return $arr;
}

/**
 * 快速排序
 * 原理:
 * 1. 定义一个基准值,然后小于基准值得数放在左侧,大于基准值得数放在右侧!
 * 2. 根据基准值分成左右两个数组,依次递归数组
 */
function quickSort($arr)
{
    $total = count($arr);
    if ($total <= 1) return $arr;

    // 先定基准
    $middle = $arr[0];
    // 左右分组数据
    $leftArr  = [];
    $rightArr = [];

    for ($i = 1; $i < $total; $i++) {
        if ($middle >= $arr[$i]) {
            $leftArr[] = $arr[$i];
        } else {
            $rightArr[] = $arr[$i];
        }
    }

    $left = quickSort($leftArr);

    // 基准加入到左侧数据
    $left[] = $middle;


    $right = quickSort($rightArr);


    return array_merge($left, $right);

}

/**
 * 归并排序
 * 原理:
 *  1. 递归数组,把数组拆分成最小的单元,然后依次比较,
 *  2. 合并数组再次比较
 *  3.
 */
function mergeSort($arr)
{
    $total = count($arr);
    if ($total < 2) {
        return $arr;
    }

    $middle = floor($total / 2);

    // 将数组拆分
    $left  = array_slice($arr, 0, $middle);
    $right = array_slice($arr, $middle);

    return mergeArr(mergeSort($left),mergeSort($right));
}

// 合并数组
function mergeArr($leftArr,$rightArr){
    $returnArr = [];

    while (($left = current($leftArr)) != false && ($right = current($rightArr)) != false) {
        // 把小的数据,填充要返回的数组,小的数据侧指针后移一位
        if ($left > $right) {
            $returnArr[] = $right;
            next($rightArr);
        }else{
            $returnArr[] = $left;
            next($leftArr);
        }
    }

    // 判断当前数组是否到最后一个元素
    while (($left = current($leftArr)) != false) {
        $returnArr[] = $left;
        next($leftArr);
    }

    // 判断当前数组是否到最后一个元素
    while (($right = current($rightArr)) != false) {
        $returnArr[] = $right;
        next($rightArr);
    }
    return $returnArr;
}














