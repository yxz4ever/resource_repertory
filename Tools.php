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
    
    /**
     * 筛选数据
     * @param type $subject
     * @param type $select
     * @author 氷落
     * @create_time  2018-01-10 15:15:27
     */
    public static function _FilterData($aData,$select) {
        if(!is_array($aData) || empty($aData) || empty($select)) {
            return $aData;
        }
        $aReturnData = [];
        foreach((array)$aData as $k => $aItem) {
            foreach((array)$aItem as $key => $value) {
                if(in_array($key, $select)) {
                    $aReturnData[$k][$key] = $value;
                }
            }
        }
        return $aReturnData;
    }
    
    
    /**
     * 记录文件
     * @param string $dir           文件目录
     * @param string $filename      文件名
     * @param array $data           存贮数据
     * @param string $Separator     分隔符
     * @return boolean
     */
    public static function _RecordsFile( $dir,$filename,$data=array(),$Separator="," ){
        if( !$dir || !$filename ||!is_array($data) )
            return false;
        if(!is_dir($dir)) mkdir($dir);
        $content = implode( $Separator,$data );
        $result = file_put_contents( $dir.'/'.$filename,(date('Y-m-d H:i:s',time())).' '.$content."\r\n",FILE_APPEND | LOCK_EX );
        return $result;
    }
}
