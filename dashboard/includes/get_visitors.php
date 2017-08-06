<?php
require_once 'database_inc.php';
$connection = new Database('localhost', 'fouadfawzi', 'fouad01242451361210');


         function get_ip_address(){

            foreach (array('HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'HTTP_X_FORWARDED',
                         'HTTP_X_CLUSTER_CLIENT_IP', 'HTTP_FORWARDED_FOR',
                         'HTTP_FORWARDED', 'REMOTE_ADDR') as $key) {
                if (array_key_exists($key, $_SERVER) === true) {
                    foreach (explode(',', $_SERVER[$key]) as $ip) {
                        $ip = trim($ip); // just to be safe

                        if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE |
                                FILTER_FLAG_NO_RES_RANGE) !== false
                        ) {
                             return $ip;
                        }else{
                            return $ip;
                        }

                    }
                }
            }

        }

//get_ip_address();



function getOS() {

    global $user_agent;
    $user_agent     =   $_SERVER['HTTP_USER_AGENT'];
    $os_platform    =   "Unknown OS Platform";

    $os_array       =   array(
        '/windows nt 10/i'     =>  'Windows 10',
        '/windows nt 6.3/i'     =>  'Windows 8.1',
        '/windows nt 6.2/i'     =>  'Windows 8',
        '/windows nt 6.1/i'     =>  'Windows 7',
        '/windows nt 6.0/i'     =>  'Windows Vista',
        '/windows nt 5.2/i'     =>  'Windows Server 2003/XP x64',
        '/windows nt 5.1/i'     =>  'Windows XP',
        '/windows xp/i'         =>  'Windows XP',
        '/windows nt 5.0/i'     =>  'Windows 2000',
        '/windows me/i'         =>  'Windows ME',
        '/win98/i'              =>  'Windows 98',
        '/win95/i'              =>  'Windows 95',
        '/win16/i'              =>  'Windows 3.11',
        '/macintosh|mac os x/i' =>  'Mac OS X',
        '/mac_powerpc/i'        =>  'Mac OS 9',
        '/linux/i'              =>  'Linux',
        '/ubuntu/i'             =>  'Ubuntu',
        '/iphone/i'             =>  'iPhone',
        '/ipod/i'               =>  'iPod',
        '/ipad/i'               =>  'iPad',
        '/android/i'            =>  'Android',
        '/blackberry/i'         =>  'BlackBerry',
        '/webos/i'              =>  'Mobile'
    );


    foreach ($os_array as $regex => $value) {

        if (preg_match($regex, $user_agent)) {
            $os_platform    =   $value;
        }

    }

    return $os_platform;

}
//getOS();


function getBrowser() {

    global $user_agent;
    $user_agent     =   $_SERVER['HTTP_USER_AGENT'];
    $browser        =   "Unknown Browser";

    $browser_array  =   array(
        '/msie/i'       =>  'Internet Explorer',
        '/firefox/i'    =>  'Firefox',
        '/safari/i'     =>  'Safari',
        '/chrome/i'     =>  'Chrome',
        '/edge/i'       =>  'Edge',
        '/opera/i'      =>  'Opera',
        '/netscape/i'   =>  'Netscape',
        '/maxthon/i'    =>  'Maxthon',
        '/konqueror/i'  =>  'Konqueror',
        '/mobile/i'     =>  'Handheld Browser'
    );

    foreach ($browser_array as $regex => $value) {

        if (preg_match($regex, $user_agent)) {
            $browser    =   $value;
        }

    }

    return $browser;

}
//getBrowser();

/*function operating_system_detection(){
    if ( isset( $_SERVER ) ) {
        $agent = $_SERVER['HTTP_USER_AGENT'] ;
    }
    else {
        global $HTTP_SERVER_VARS ;
        if ( isset( $HTTP_SERVER_VARS ) ) {
            $agent = $HTTP_SERVER_VARS['HTTP_USER_AGENT'] ;
        }
        else {
            global $HTTP_USER_AGENT ;
            $agent = $HTTP_USER_AGENT ;
        }
    }
    $ros[] = array('Windows XP', 'Windows XP');
    $ros[] = array('Windows NT 5.1|Windows NT5.1)', 'Windows XP');
    $ros[] = array('Windows 2000', 'Windows 2000');
    $ros[] = array('Windows NT 5.0', 'Windows 2000');
    $ros[] = array('Windows NT 4.0|WinNT4.0', 'Windows NT');
    $ros[] = array('Windows NT 5.2', 'Windows Server 2003');
    $ros[] = array('Windows NT 6.0', 'Windows Vista');
    $ros[] = array('Windows NT 7.0', 'Windows 7');
    $ros[] = array('Windows CE', 'Windows CE');
    $ros[] = array('(media center pc).([0-9]{1,2}\.[0-9]{1,2})', 'Windows Media Center');
    $ros[] = array('(win)([0-9]{1,2}\.[0-9x]{1,2})', 'Windows');
    $ros[] = array('(win)([0-9]{2})', 'Windows');
    $ros[] = array('(windows)([0-9x]{2})', 'Windows');
    // Doesn't seem like these are necessary...not totally sure though..
    //$ros[] = array('(winnt)([0-9]{1,2}\.[0-9]{1,2}){0,1}', 'Windows NT');
    //$ros[] = array('(windows nt)(([0-9]{1,2}\.[0-9]{1,2}){0,1})', 'Windows NT'); // fix by bg
    $ros[] = array('Windows ME', 'Windows ME');
    $ros[] = array('Win 9x 4.90', 'Windows ME');
    $ros[] = array('Windows 98|Win98', 'Windows 98');
    $ros[] = array('Windows 95', 'Windows 95');
    $ros[] = array('(windows)([0-9]{1,2}\.[0-9]{1,2})', 'Windows');
    $ros[] = array('win32', 'Windows');
    $ros[] = array('(java)([0-9]{1,2}\.[0-9]{1,2}\.[0-9]{1,2})', 'Java');
    $ros[] = array('(Solaris)([0-9]{1,2}\.[0-9x]{1,2}){0,1}', 'Solaris');
    $ros[] = array('dos x86', 'DOS');
    $ros[] = array('unix', 'Unix');
    $ros[] = array('Mac OS X', 'Mac OS X');
    $ros[] = array('Mac_PowerPC', 'Macintosh PowerPC');
    $ros[] = array('(mac|Macintosh)', 'Mac OS');
    $ros[] = array('(sunos)([0-9]{1,2}\.[0-9]{1,2}){0,1}', 'SunOS');
    $ros[] = array('(beos)([0-9]{1,2}\.[0-9]{1,2}){0,1}', 'BeOS');
    $ros[] = array('(risc os)([0-9]{1,2}\.[0-9]{1,2})', 'RISC OS');
    $ros[] = array('os/2', 'OS/2');
    $ros[] = array('freebsd', 'FreeBSD');
    $ros[] = array('openbsd', 'OpenBSD');
    $ros[] = array('netbsd', 'NetBSD');
    $ros[] = array('irix', 'IRIX');
    $ros[] = array('plan9', 'Plan9');
    $ros[] = array('osf', 'OSF');
    $ros[] = array('aix', 'AIX');
    $ros[] = array('GNU Hurd', 'GNU Hurd');
    $ros[] = array('(fedora)', 'Linux - Fedora');
    $ros[] = array('(kubuntu)', 'Linux - Kubuntu');
    $ros[] = array('(ubuntu)', 'Linux - Ubuntu');
    $ros[] = array('(debian)', 'Linux - Debian');
    $ros[] = array('(CentOS)', 'Linux - CentOS');
    $ros[] = array('(Mandriva).([0-9]{1,3}(\.[0-9]{1,3})?(\.[0-9]{1,3})?)', 'Linux - Mandriva');
    $ros[] = array('(SUSE).([0-9]{1,3}(\.[0-9]{1,3})?(\.[0-9]{1,3})?)', 'Linux - SUSE');
    $ros[] = array('(Dropline)', 'Linux - Slackware (Dropline GNOME)');
    $ros[] = array('(ASPLinux)', 'Linux - ASPLinux');
    $ros[] = array('(Red Hat)', 'Linux - Red Hat');
    // Loads of Linux machines will be detected as unix.
    // Actually, all of the linux machines I've checked have the 'X11' in the User Agent.
    //$ros[] = array('X11', 'Unix');
    $ros[] = array('(linux)', 'Linux');
    $ros[] = array('(amigaos)([0-9]{1,2}\.[0-9]{1,2})', 'AmigaOS');
    $ros[] = array('amiga-aweb', 'AmigaOS');
    $ros[] = array('amiga', 'Amiga');
    $ros[] = array('AvantGo', 'PalmOS');
    //$ros[] = array('(Linux)([0-9]{1,2}\.[0-9]{1,2}\.[0-9]{1,3}(rel\.[0-9]{1,2}){0,1}-([0-9]{1,2}) i([0-9]{1})86){1}', 'Linux');
    //$ros[] = array('(Linux)([0-9]{1,2}\.[0-9]{1,2}\.[0-9]{1,3}(rel\.[0-9]{1,2}){0,1} i([0-9]{1}86)){1}', 'Linux');
    //$ros[] = array('(Linux)([0-9]{1,2}\.[0-9]{1,2}\.[0-9]{1,3}(rel\.[0-9]{1,2}){0,1})', 'Linux');
    $ros[] = array('[0-9]{1,2}\.[0-9]{1,2}\.[0-9]{1,3})', 'Linux');
    $ros[] = array('(webtv)/([0-9]{1,2}\.[0-9]{1,2})', 'WebTV');
    $ros[] = array('Dreamcast', 'Dreamcast OS');
    $ros[] = array('GetRight', 'Windows');
    $ros[] = array('go!zilla', 'Windows');
    $ros[] = array('gozilla', 'Windows');
    $ros[] = array('gulliver', 'Windows');
    $ros[] = array('ia archiver', 'Windows');
    $ros[] = array('NetPositive', 'Windows');
    $ros[] = array('mass downloader', 'Windows');
    $ros[] = array('microsoft', 'Windows');
    $ros[] = array('offline explorer', 'Windows');
    $ros[] = array('teleport', 'Windows');
    $ros[] = array('web downloader', 'Windows');
    $ros[] = array('webcapture', 'Windows');
    $ros[] = array('webcollage', 'Windows');
    $ros[] = array('webcopier', 'Windows');
    $ros[] = array('webstripper', 'Windows');
    $ros[] = array('webzip', 'Windows');
    $ros[] = array('wget', 'Windows');
    $ros[] = array('Java', 'Unknown');
    $ros[] = array('flashget', 'Windows');
    // delete next line if the script show not the right OS
    //$ros[] = array('(PHP)/([0-9]{1,2}.[0-9]{1,2})', 'PHP');
    $ros[] = array('MS FrontPage', 'Windows');
    $ros[] = array('(msproxy)/([0-9]{1,2}.[0-9]{1,2})', 'Windows');
    $ros[] = array('(msie)([0-9]{1,2}.[0-9]{1,2})', 'Windows');
    $ros[] = array('libwww-perl', 'Unix');
    $ros[] = array('UP.Browser', 'Windows CE');
    $ros[] = array('NetAnts', 'Windows');
    $file = count ( $ros );
    $os = '';
    for ( $n=0 ; $n<$file ; $n++ ){
        if ( @preg_match('/\b'.$ros[$n][0].'\b/i' , $agent, $name)){
            $os = @$ros[$n][1].' '.@$name[2];
            break;
        }
    }
    return trim ( $os );
}*/



    function  save_visitor()
    {
        $OS = getOS();
        $browser = getBrowser();
      $ip = get_ip_address();
      // echo  $ip_add =  $user->get_ip_address();
       // $browser= get_browser(null, true);
        //$browser = strtolower($browser['browser']);
      // echo $ip =  $ip_add;
        $time = time();
        $expired = $time - 120;
        if (!@mysql_select_db('f_dashboard')) {
            echo 'The table doesn\'t exist .';
        } else {
            //online visitors
            $all_select="SELECT * FROM `online_visitors` WHERE `IP_Address` = '".$ip."'";
            $all_query = mysql_query($all_select);
            if(mysql_num_rows($all_query) < 1){
                $sql = "INSERT INTO `online_visitors` (`id`, `ip_address`, `Date`, `Browser`, `Platform(OS)`, `Day`, `Time`) VALUES 
            (NULL,'". $ip."','".$time ."', '".$browser."','".$OS."', now(), now())";
                mysql_query($sql);
                @mysql_error($sql);
                $all_select="SELECT * FROM `max_visit`";
                $all_query = mysql_query($all_select);
                if(mysql_num_rows($all_query) < 1){
                    $sql_save = "INSERT INTO `max_visit` (`id`,`value`,`date`, `time`)
                          VALUES(NULL, '0',now(), now())";
                    mysql_query($sql_save);
                }
                $max_sql = "SELECT * FROM  `max_visit` ";
                $max_query = mysql_query($max_sql);
                if($row = mysql_fetch_array($max_query)){
                    $val =$row['value'] + 1 ;
                    $update = "UPDATE `max_visit` SET `value` ='".$val."' ";
                    if($quer =mysql_query($update)){
                    }else{
                        mysql_error($quer);
                    }
                }
                //update count time when the page has been reload
            }elseif(mysql_num_rows($all_query) == 1){
                $sql_update = "UPDATE `online_visitors` SET `Date` ='".$time."'  WHERE `IP_Address` = '".$ip."'";
                mysql_query($sql_update);
            }
            /////////////////////////////////////last 24hours visitors//////////////////////////////////////////
            $online_select="SELECT * FROM `last24` WHERE `IP_Address` = '".$ip."'";
            $online_query = mysql_query($online_select);
            if(mysql_num_rows($online_query) < 1){
                $sql1 = "INSERT INTO `last24` (`id`, `IP_Address`, `Date`, `Browser`, `Platform(OS)`, `Day`, `time`) VALUES 
            (NULL,'". $ip."','".$time ."', '".$browser."','".$OS."', now(), now())";
                mysql_query($sql1);
            }
           //////////////////////////////////////last week visitors///////////////////////////////////////////////
            $lastWeek_select="SELECT * FROM `vlast_week` WHERE `IP_Address` = '".$ip."'";
            $lastWeek_query = mysql_query($lastWeek_select);
            if(mysql_num_rows($lastWeek_query) < 1) {
                $sql2 = "INSERT INTO `vlast_week` (`id`, `IP_Address`, `Date`, `Browser`, `Platform(OS)`, `Day`, `time`) VALUES 
            (NULL,'". $ip."','".$time ."','".$browser."','".$OS."', now(), now())";
                mysql_query($sql2);
            } //////////////////////////////////////unique visitors///////////////////////////////////////////////
            $unique_select="SELECT * FROM `unique_visitors` WHERE `IP_Address` = '".$ip."'";
            $unique_query = mysql_query($unique_select);
            if(mysql_num_rows($unique_query) < 1) {
                $unique_sql = "INSERT INTO `unique_visitors` (`id`, `IP_Address`, `Date`, `Browser`, `Platform(OS)`, `Day`, `time`) VALUES 
            (NULL,'". $ip."','".$time ."','".$browser."','".$OS."', now(), now())";
                mysql_query($unique_sql);
            }
            //////////////////////////////////////last month visitors/////////////////////////////////////////////
            $month_select="SELECT * FROM `month_visitors` WHERE `IP_Address` = '".$ip."'";
            $month_query = mysql_query($month_select);
            if(mysql_num_rows($month_query) < 1) {
                $sql3 = "INSERT INTO `month_visitors` (`id`, `IP_Address`, `Date`, `Browser`, `Platform(OS)`, `Day`, `time`) VALUES 
            (NULL,'". $ip."','".$time ."','".$browser."','".$OS."', now(), now())";
                mysql_query($sql3);
            }
        }
    }
    //save_visitor();
?>