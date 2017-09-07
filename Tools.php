<?php
/**
 * 工具类集合
 * 静态集合
 * @author kingnet
 * @version 0.0.1
 */
class Tools {
    /**
     * php获取毫秒数
     * @return Float
     */
    public static function _getMillisecond() {
        list($t1, $t2) = explode(' ', microtime());
        return (float) sprintf('%.0f', (floatval($t1) + floatval($t2)) * 1000);
    }
}
