<?php

function p ($array){
    dump($array, 1, '<pre>', 0);
}


/**
 * 检测验证码
 */
function check_verify($code, $id =''){
    $verify = new \Think\Verify();
    return $verify->check($code, $id);
}



//获取用户头像
function get_avatar($uid,$size = 'm'){
    $size = in_array($size, array('l', 'm', 's')) ? $size : 'm';
    $uid = abs(intval($uid)); //UID取整数绝对值
    $uid = sprintf("%09d", $uid); //前边加0补齐8位，例如UID为31的用户变成 00,00,00/31
    $dir1 = substr($uid, 0, 3);  //取左边2位，即 00
    $dir2 = substr($uid, 3, 2);  //取4-5位，即00
    $dir3 = substr($uid, 5, 2);  //取6-7位，即00
    // 下面拼成用户头像路径，即000/00/00/31_avatar_middle.jpg

    // get_headers($path) 看网络上有没有这个文件
    //$path = 'http://imgs.zzbm.com/avatar/'.$dir1.'/'.$dir2.'/'.$dir3.'/'.substr($uid, -2).'_'.$size.'.jpg';   
    $path = 'http://zzbm.com/Avatar/'.$dir1.'/'.$dir2.'/'.$dir3.'/'.substr($uid, -2).'_'.$size.'.jpg';  
    //http://www.zzbm.com/avatar/000/00/00/18.jpg

    return $path;

    if(count(get_headers($path)) == 8 ) {
        return $path;
    }else{
        return 'http://7nimg.zzbm.com/default_'.$size.'.jpg';
    }
}






/**
 * 检测用户是否登录
 * @return integer 0-未登录，大于0-当前登录用户ID
 * @author 麦当苗儿 <zuojiazi@vip.qq.com>
 */
function is_login(){
    $uid = session('uid');
    if (empty($uid)) {
        return 0;
    } else {
        return $uid;
    }
}
// function is_login(){
//     $user = session('user_auth');
//     if (empty($user)) {
//         return 0;
//     } else {
//         return session('user_auth_sign') == data_auth_sign($user) ? $user['uid'] : 0;
//     }
// }





/**
 * 检测当前用户是否为管理员
 * @return boolean true-管理员，false-非管理员
 * @author 麦当苗儿 <zuojiazi@vip.qq.com>
 */
function is_administrator($uid = null){
    $uid = is_null($uid) ? is_login() : $uid;
    return $uid && (intval($uid) === C('USER_ADMINISTRATOR'));
}




/**
 * 字符串转换为数组，主要用于把分隔符调整到第二个参数
 * @param  string $str  要分割的字符串
 * @param  string $glue 分割符
 * @return array
 * @author 麦当苗儿 <zuojiazi@vip.qq.com>
 */
function str2arr($str, $glue = ','){
    return explode($glue, $str);
}


/**
 * 数组转换为字符串，主要用于把分隔符调整到第二个参数
 * @param  array  $arr  要连接的数组
 * @param  string $glue 分割符
 * @return string
 * @author 麦当苗儿 <zuojiazi@vip.qq.com>
 */
function arr2str($arr, $glue = ','){
    return implode($glue, $arr);
}


/**
 * 格式化字节大小
 * @param  number $size      字节数
 * @param  string $delimiter 数字和单位分隔符
 * @return string            格式化后的带单位的大小
 * @author 麦当苗儿 <zuojiazi@vip.qq.com>
 */
function format_bytes($size, $delimiter = '') {
    $units = array('B', 'KB', 'MB', 'GB', 'TB', 'PB');
    for ($i = 0; $size >= 1024 && $i < 5; $i++) $size /= 1024;
    return round($size, 2) . $delimiter . $units[$i];
}


/**
 * 字符串截取，支持中文和其他编码
 * @static
 * @access public
 * @param string $str 需要转换的字符串
 * @param string $start 开始位置
 * @param string $length 截取长度
 * @param string $charset 编码格式
 * @param string $suffix 截断显示字符
 * @return string
 */
function msubstr($str, $start=0, $length, $suffix=true, $charset="utf-8") {
    if(function_exists("mb_substr"))
        $slice = mb_substr($str, $start, $length, $charset);
    elseif(function_exists('iconv_substr')) {
        $slice = iconv_substr($str,$start,$length,$charset);
        if(false === $slice) {
            $slice = '';
        }
    }else{
        $re['utf-8']   = "/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|[\xe0-\xef][\x80-\xbf]{2}|[\xf0-\xff][\x80-\xbf]{3}/";
        $re['gb2312'] = "/[\x01-\x7f]|[\xb0-\xf7][\xa0-\xfe]/";
        $re['gbk']    = "/[\x01-\x7f]|[\x81-\xfe][\x40-\xfe]/";
        $re['big5']   = "/[\x01-\x7f]|[\x81-\xfe]([\x40-\x7e]|\xa1-\xfe])/";
        preg_match_all($re[$charset], $str, $match);
        $slice = join("",array_slice($match[0], $start, $length));
    }
    return $suffix ? $slice.'...' : $slice;
}




/**
 * 设置跳转页面URL
 * 使用函数再次封装，方便以后选择不同的存储方式（目前使用cookie存储）
 * @author 麦当苗儿 <zuojiazi@vip.qq.com>
 */
function set_redirect_url($url){
    cookie('redirect_url', $url);
}

/**
 * 获取跳转页面URL
 * @return string 跳转页URL
 * @author 麦当苗儿 <zuojiazi@vip.qq.com>
 */
function get_redirect_url(){
    $url = cookie('redirect_url');
    return empty($url) ? __APP__ : $url;
}



/**
 * 时间戳格式化
 * @param int $time
 * @return string 完整的时间显示
 * @author huajie <banhuajie@163.com>
 */
function time_format($time = NULL,$format='Y-m-d H:i'){
    $time = $time === NULL ? NOW_TIME : intval($time);
    return date($format, $time);
}




/**
 * 根据用户ID获取用户名
 * @param  integer $uid 用户ID
 * @return string       用户名
 */
function get_username($uid = 0){
    static $list;
    if(!($uid && is_numeric($uid))){ //获取当前登录用户名
        return session('user_auth.username');
    }

    /* 获取缓存数据 */
    if(empty($list)){
        $list = S('sys_active_user_list');
    }

    /* 查找用户信息 */
    $key = "u{$uid}";
    if(isset($list[$key])){ //已缓存，直接使用
        $name = $list[$key];
    } else { //调用接口获取用户信息
        $User = new User\Api\UserApi();
        $info = $User->info($uid);
        if($info && isset($info[1])){
            $name = $list[$key] = $info[1];
            /* 缓存用户 */
            $count = count($list);
            $max   = C('USER_MAX_CACHE');
            while ($count-- > $max) {
                array_shift($list);
            }
            S('sys_active_user_list', $list);
        } else {
            $name = '';
        }
    }
    return $name;
}



/**
 * 根据用户ID获取用户昵称
 * @param  integer $uid 用户ID
 * @return string       用户昵称
 */
function get_nickname($uid = 0){
    static $list;
    if(!($uid && is_numeric($uid))){ //获取当前登录用户名
        return session('user_auth.username');
    }

    /* 获取缓存数据 */
    if(empty($list)){
        $list = S('sys_user_nickname_list');
    }

    /* 查找用户信息 */
    $key = "u{$uid}";
    if(isset($list[$key])){ //已缓存，直接使用
        $name = $list[$key];
    } else { //调用接口获取用户信息
        $info = M('Member')->field('nickname')->find($uid);
        if($info !== false && $info['nickname'] ){
            $nickname = $info['nickname'];
            $name = $list[$key] = $nickname;
            /* 缓存用户 */
            $count = count($list);
            $max   = C('USER_MAX_CACHE');
            while ($count-- > $max) {
                array_shift($list);
            }
            S('sys_user_nickname_list', $list);
        } else {
            $name = '';
        }
    }
    return $name;
}



/**
 * 记录行为日志，并执行该行为的规则
 * @param string $action 行为标识
 * @param string $model 触发行为的模型名
 * @param int $record_id 触发行为的记录id
 * @param int $user_id 执行行为的用户id
 * @return boolean
 * @author huajie <banhuajie@163.com>
 */
function action_log($action = null, $model = null, $record_id = null, $user_id = null){

    //参数检查
    if(empty($action) || empty($model) || empty($record_id)){
        return '参数不能为空';
    }
    if(empty($user_id)){
        $user_id = is_login();
    }

    //查询行为,判断是否执行
    $action_info = M('Action')->getByName($action);
    if($action_info['status'] != 1){
        return '该行为被禁用或删除';
    }

    //插入行为日志
    $data['action_id']      =   $action_info['id'];
    $data['user_id']        =   $user_id;
    $data['action_ip']      =   ip2long(get_client_ip());
    $data['model']          =   $model;
    $data['record_id']      =   $record_id;
    $data['create_time']    =   NOW_TIME;

    //解析日志规则,生成日志备注
    if(!empty($action_info['log'])){
        if(preg_match_all('/\[(\S+?)\]/', $action_info['log'], $match)){
            $log['user']    =   $user_id;
            $log['record']  =   $record_id;
            $log['model']   =   $model;
            $log['time']    =   NOW_TIME;
            $log['data']    =   array('user'=>$user_id,'model'=>$model,'record'=>$record_id,'time'=>NOW_TIME);
            foreach ($match[1] as $value){
                $param = explode('|', $value);
                if(isset($param[1])){
                    $replace[] = call_user_func($param[1],$log[$param[0]]);
                }else{
                    $replace[] = $log[$param[0]];
                }
            }
            $data['remark'] =   str_replace($match[0], $replace, $action_info['log']);
        }else{
            $data['remark'] =   $action_info['log'];
        }
    }else{
        //未定义日志规则，记录操作url
        $data['remark']     =   '操作url：'.$_SERVER['REQUEST_URI'];
    }

    M('ActionLog')->add($data);

    if(!empty($action_info['rule'])){
        //解析行为
        $rules = parse_action($action, $user_id);

        //执行行为
        $res = execute_action($rules, $action_info['id'], $user_id);
    }
}

/**
 * 解析行为规则
 * 规则定义  table:$table|field:$field|condition:$condition|rule:$rule[|cycle:$cycle|max:$max][;......]
 * 规则字段解释：table->要操作的数据表，不需要加表前缀；
 *              field->要操作的字段；
 *              condition->操作的条件，目前支持字符串，默认变量{$self}为执行行为的用户
 *              rule->对字段进行的具体操作，目前支持四则混合运算，如：1+score*2/2-3
 *              cycle->执行周期，单位（小时），表示$cycle小时内最多执行$max次
 *              max->单个周期内的最大执行次数（$cycle和$max必须同时定义，否则无效）
 * 单个行为后可加 ； 连接其他规则
 * @param string $action 行为id或者name
 * @param int $self 替换规则里的变量为执行用户的id
 * @return boolean|array: false解析出错 ， 成功返回规则数组
 * @author huajie <banhuajie@163.com>
 */
function parse_action($action = null, $self){
    if(empty($action)){
        return false;
    }

    //参数支持id或者name
    if(is_numeric($action)){
        $map = array('id'=>$action);
    }else{
        $map = array('name'=>$action);
    }

    //查询行为信息
    $info = M('Action')->where($map)->find();
    if(!$info || $info['status'] != 1){
        return false;
    }

    //解析规则:table:$table|field:$field|condition:$condition|rule:$rule[|cycle:$cycle|max:$max][;......]
    $rules = $info['rule'];
    $rules = str_replace('{$self}', $self, $rules);
    $rules = explode(';', $rules);
    $return = array();
    foreach ($rules as $key=>&$rule){
        $rule = explode('|', $rule);
        foreach ($rule as $k=>$fields){
            $field = empty($fields) ? array() : explode(':', $fields);
            if(!empty($field)){
                $return[$key][$field[0]] = $field[1];
            }
        }
        //cycle(检查周期)和max(周期内最大执行次数)必须同时存在，否则去掉这两个条件
        if(!array_key_exists('cycle', $return[$key]) || !array_key_exists('max', $return[$key])){
            unset($return[$key]['cycle'],$return[$key]['max']);
        }
    }

    return $return;
}

/**
 * 执行行为
 * @param array $rules 解析后的规则数组
 * @param int $action_id 行为id
 * @param array $user_id 执行的用户id
 * @return boolean false 失败 ， true 成功
 * @author huajie <banhuajie@163.com>
 */
function execute_action($rules = false, $action_id = null, $user_id = null){
    if(!$rules || empty($action_id) || empty($user_id)){
        return false;
    }

    $return = true;
    foreach ($rules as $rule){

        //检查执行周期
        $map = array('action_id'=>$action_id, 'user_id'=>$user_id);
        $map['create_time'] = array('gt', NOW_TIME - intval($rule['cycle']) * 3600);
        $exec_count = M('ActionLog')->where($map)->count();
        if($exec_count > $rule['max']){
            continue;
        }

        //执行数据库操作
        $Model = M(ucfirst($rule['table']));
        $field = $rule['field'];
        $res = $Model->where($rule['condition'])->setField($field, array('exp', $rule['rule']));

        if(!$res){
            $return = false;
        }
    }
    return $return;
}













/** 
*    匹配手机号码 
*    规则： 
*        手机号码基本格式： 
*        前面三位为： 
*        移动：134-139 147 150-152 157-159 182 187 188 
*        联通：130-132 155-156 185 186 
*        电信：133 153 180 189 
*        后面八位为： 
*        0-9位的数字 
*/  
function is_mobile($mobile){          
    $rule  = "/^((13[0-9])|147|(15[0-35-9])|180|182|(18[5-9]))[0-9]{8}$/A";  
    preg_match($rule,$mobile,$result);  
    return count($result);  
}  

/** 
*        匹配邮箱 
*        规则： 
*            邮箱基本格式是  *****@**.** 
*            @以前是一个 大小写的字母或者数字开头，紧跟0到多个大小写字母或者数字或 . _ - 的字符串 
*            @之后到.之前是 1到多个大小写字母或者数字的字符串 
*            .之后是 1到多个 大小写字母或者数字或者.的字符串 
*/  
function is_email($email){  
    $rule = '/^[a-zA-Z0-9][a-zA-Z0-9._-]*\@[a-zA-Z0-9]+\.[a-zA-Z0-9\.]+$/A';  
    preg_match($rule,$email,$result);  
    return count($result);  
}  


/** 
*       匹配身份证号 
*       规则： 
*           15位纯数字或者18位纯数字或者17位数字加一位x 
*/  
function is_pid($pid){  
    $rule = '/^(([0-9]{15})|([0-9]{18})|([0-9]{17}x))$/';         
    preg_match($rule,$pid,$result);  
    return count($result);  
}  

/** 
*    匹配邮编 
*        规则：六位数字，第一位不能为0 
*/  
function is_zipcode($zipcode){  
    $rule ='/^[1-9]\d{5}$/';  
    preg_match($rule,$zipcode,$result);  
    return count($result);  
}  


//utf8下匹配中文  
function is_cn($string){  
    $rule ='/([\x{4e00}-\x{9fa5}]){1}/u';  
    preg_match_all($rule,$string,$result);  
    return $result;  
} 


/**
 * 检查字符串是否是UTF8编码
 * @param string $string 字符串
 * @return Boolean
 */
function is_utf8($string) {
    return preg_match('%^(?:
         [x09x0Ax0Dx20-x7E]            # ASCII
       | [xC2-xDF][x80-xBF]             # non-overlong 2-byte
       |  xE0[xA0-xBF][x80-xBF]        # excluding overlongs
       | [xE1-xECxEExEF][x80-xBF]{2}  # straight 3-byte
       |  xED[x80-x9F][x80-xBF]        # excluding surrogates
       |  xF0[x90-xBF][x80-xBF]{2}     # planes 1-3
       | [xF1-xF3][x80-xBF]{3}          # planes 4-15
       |  xF4[x80-x8F][x80-xBF]{2}     # plane 16
    )*$%xs', $string);
}











/**
 * www.leipi.org
 * PHP检测机器人访问
 */
function is_robot(){
    $_robot = null;
    if(is_null($_robot)) {
        $spiders = 'Bot|Crawl|Spider|slurp|sohu-search|lycos|robozilla';
        $browsers = 'MSIE|Netscape|Opera|Konqueror|Mozilla';
        if(preg_match(" /($browsers)/", $_SERVER['HTTP_USER_AGENT'])) {
            $_robot = false ;
        } elseif(preg_match(" /($spiders)/", $_SERVER['HTTP_USER_AGENT'])) {
            $_robot = true;
        } else {
            $_robot = false;
        }
    }
    return $_robot;
}







/**
 * 友好的时间显示
 * 调用方法：{$timeStamp|friendtime}
 * @param int    $sTime 待显示的时间
 * @param string $type  类型. normal | mohu | full | ymd | other
 * @param string $alt   已失效
 * @return string
 */
function friend_time($sTime,$type = 'normal',$alt = 'false') {
    //sTime=源时间，cTime=当前时间，dTime=时间差
    $cTime        =    time();
    $dTime        =    $cTime - $sTime;
    $dDay         =    intval(date("z",$cTime)) - intval(date("z",$sTime));
    //$dDay       =    intval($dTime/3600/24);
    $dYear        =    intval(date("Y",$cTime)) - intval(date("Y",$sTime));
    //normal：n秒前，n分钟前，n小时前，日期
    if($type=='normal'){
        if( $dTime < 60 ){
            return $dTime."秒前";
        }elseif( $dTime < 3600 ){
            return intval($dTime/60)."分钟前";
        //今天的数据.年份相同.日期相同.
        }elseif( $dYear==0 && $dDay == 0  ){
            //return intval($dTime/3600)."小时前";
            return '今天'.date('H:i',$sTime);
        }elseif($dYear==0){
            return date("m月d日 H:i",$sTime);
        }else{
            return date("Y-m-d H:i",$sTime);
        }
    }elseif($type=='mohu'){
        if( $dTime < 60 ){
            return $dTime."秒前";
        }elseif( $dTime < 3600 ){
            return intval($dTime/60)."分钟前";
        }elseif( $dTime >= 3600 && $dDay == 0  ){
            return intval($dTime/3600)."小时前";
        }elseif( $dDay > 0 && $dDay<=7 ){
            return intval($dDay)."天前";
        }elseif( $dDay > 7 &&  $dDay <= 30 ){
            return intval($dDay/7) . '周前';
        }elseif( $dDay > 30 ){
            return intval($dDay/30) . '个月前';
        }
    //full: Y-m-d , H:i:s
    }elseif($type=='full'){
        return date("Y-m-d , H:i:s",$sTime);
    }elseif($type=='ymd'){
        return date("Y-m-d",$sTime);
    }else{
        if( $dTime < 60 ){
            return $dTime."秒前";
        }elseif( $dTime < 3600 ){
            return intval($dTime/60)."分钟前";
        }elseif( $dTime >= 3600 && $dDay == 0  ){
            return intval($dTime/3600)."小时前";
        }elseif($dYear==0){
            return date("Y-m-d H:i:s",$sTime);
        }else{
            return date("Y-m-d H:i:s",$sTime);
        }
    }
}













/**
 * 系统非常规MD5加密方法
 * @param  string $str 要加密的字符串
 * @return string 
 */
function system_md5($str, $key = 'Y3N1C50O*xXx(o_O)26'){
    return '' === $str ? '' : md5(sha1($str) . $key);
}

/**
 * 系统加密方法
 * @param string $data 要加密的字符串
 * @param string $key  加密密钥
 * @param int $expire  过期时间 (单位:秒)
 * @return string 
 */
function system_encrypt($data, $key, $expire = 0) {
    $key  = md5($key);
    $data = base64_encode($data);
    $x    = 0;
    $len  = strlen($data);
    $l    = strlen($key);
    $char =  '';
    for ($i = 0; $i < $len; $i++) {
        if ($x == $l) $x=0;
        $char  .= substr($key, $x, 1);
        $x++;
    }
    $str = sprintf('%010d', $expire ? $expire + time() : 0);
    for ($i = 0; $i < $len; $i++) {
        $str .= chr(ord(substr($data,$i,1)) + (ord(substr($char,$i,1)))%256);
    }
    return str_replace('=', '', base64_encode($str));
}

/**
 * 系统解密方法
 * @param string $data 要解密的字符串 （必须是passport_encrypt方法加密的字符串）
 * @param string $key  加密密钥
 * @return string 
 */
function system_decrypt($data, $key){
    $key    = md5($key);
    $x      = 0;
    $data   = base64_decode($data);
    $expire = substr($data, 0, 10);
    $data   = substr($data, 10);
    if($expire > 0 && $expire < time()) {
        return '';
    }
    $len  = strlen($data);
    $l    = strlen($key);
    $char = $str = '';
    for ($i = 0; $i < $len; $i++) {
        if ($x == $l) $x = 0;
        $char  .= substr($key, $x, 1);
        $x++;
    }
    for ($i = 0; $i < $len; $i++) {
        if (ord(substr($data, $i, 1)) < ord(substr($char, $i, 1))) {
            $str .= chr((ord(substr($data, $i, 1)) + 256) - ord(substr($char, $i, 1)));
        }else{
            $str .= chr(ord(substr($data, $i, 1)) - ord(substr($char, $i, 1)));
        }
    }
    return base64_decode($str);
}















function send_registermail($email, $nickname, $code) {

    $url = 'http://sendcloud.sohu.com/webapi/mail.send.json';
    //不同于登录SendCloud站点的帐号，您需要登录后台创建发信子帐号，使用子帐号和密码才可以进行邮件的发送。
    $param = array(
                'api_user' => 'postmaster@registermail.sendcloud.org',
                'api_key' => 'teXC9fBp',
                'from' => 'postmaster@zzbm.com',
                'fromname' => '郑州便民服务网',
                'to' => $email,
                'subject' => '你好：'.$nickname.', 欢迎注册, 请激活验证邮箱。',
                'html' => '点击验证 <a href="http://www.zzbm.com/passport/enableEmail?v='.$code.'">点击验证</a> go password.',
            );

    $options = array('http' => array('method'  => 'POST','content' => http_build_query($param)));
    $context  = stream_context_create($options);
    $result = file_get_contents($url, false, $context);

    return $result;
}













/**
*   递归重组节点信息为多维数组
*   $node   [要处理的节点数组]
*   $pid    [父级ID]
***/
function node_merge($node, $access = null, $pid = 0){

    $arr = array();

    foreach ($node as $v) {
        if(is_array($access)){
            $v['access'] = in_array($v['id'], $access) ? 1 : 0;
        }

        if ($v['pid'] == $pid){
            $v['child'] = node_merge($node, $access, $v['id']);
            $arr[] = $v;
        }    
    }

    return $arr;

}




/**
*   递归无限级分类的类
*/
function unlimitedForLevel($cate, $html ='--', $fid = 0, $level = 0){
    $arr = array();
    foreach ($cate as $v) {
        if ($v['fid'] == $fid){
            $v['level'] = $level + 1;
            $v['html'] = str_repeat($html, $level);
            $arr[] = $v;
            $arr = array_merge($arr, unlimitedForLevel($cate, $html, $v['id'], $level+1));
        }
    }
    return $arr;
}


//组合多维数组
function unlimitedForLayer($cate, $name='child', $fid = 0){
    $arr = array();
    foreach ($cate as $v) {
        if ($v['fid'] == $fid){
            $v['child'] = unlimitedForLayer($cate, $name, $v['id']);
            $arr[] = $v;                
        }
    }
    return $arr;
}


//传递一个子分类ID返回有的父级分类
function getParents($cate, $id){
    $arr = array();
    foreach ($cate as $v) {
        if ($v['id'] == $id){
            $arr[] = $v;    
            $arr = array_merge(getParents($cate, $v['fid']) , $arr);            
        }
    }
    return $arr;
}

//传递一个父分类ID返回有的子级分类
function getChildsID($cate, $fid){
    $arr = array();
    foreach ($cate as $v) {
        if ($v['fid'] == $fid){
            $arr[] = $v['id'];  
            $arr = array_merge($arr , getChildsID($cate, $v['id']));            
        }
    }
    return $arr;
}


//传递一个父级分类ID返回有的子级分类
function getChilds($cate, $fid){
    $arr = array();
    foreach ($cate as $v) {
        if ($v['fid'] == $fid){
            $arr[] = $v;    
            $arr = array_merge($arr , getChilds($cate, $v['id']));          
        }
    }
    return $arr;
}





//网址生成二维码的方法 function Name = generateQRfromGoogle

// $url = "http://www.google.com.hk";
// createQRCodeByGoogle($url);
function createQRCodeByGoogle($chl,$widhtHeight ='150',$EC_level='L',$margin='0'){
   return  '<img src="http://chart.apis.google.com/chart?chs='.$widhtHeight.'x'.$widhtHeight.'&cht=qr&chld='.$EC_level.'|'.$margin.'&chl='.urlencode($chl).'" alt="QR code" widhtHeight="'.$size.'" widhtHeight="'.$size.'"/>';
}




//生成二维码名片的方法 function Name = generateQRfromGoogle

// $vname = 'test';  
// $vtel = '13800000000';  
// generateQRfromGoogle($vname,$vtel);

function createQRCardByGoogle($vname,$vtel,$widhtHeight ='150',$EC_level='L',$margin='0'){
    if($vname&&$vtel){  
       $chl = "BEGIN:VCARD\nVERSION:3.0". //vcard头信息  
       "\nFN:$vname".  
       "\nTEL:$vtel".  
       "\nEND:VCARD"; //vcard尾信息  
       return '<img src="http://chart.apis.google.com/chart?chs='.$widhtHeight.'x'.$widhtHeight.'&cht=qr&chld='.$EC_level.'|'.$margin.'&chl='.urlencode($chl).'" alt="QR code" widhtHeight="'.$size.'" widhtHeight="'.$size.'"/>';
    }
}



