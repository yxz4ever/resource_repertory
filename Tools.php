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
    
    /**
     * 删除多余的数据
     * @author 氷落
     * @param [] $aData     一维数组
     * @param [] $aUnset    要删除的字段数组
     * @return []
     */
    public static function _unsetData($aData,$aUnset){
        foreach((array)$aUnset as $key) {
            if(array_key_exists($key, $aData)) {
                unset($aData[$key]);
            }
        }
        return $aData;
    }
}
