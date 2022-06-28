<?php
$inputcontent = $_POST['url'] ?? null;
if (empty($inputcontent)) {
    $arr = array('msg' => "failed", 'data' => "empty value");
    echo json_encode($arr, 320);
    exit();
} else {
    $diyscript = urldecode($_POST['sortscript']);
    $target = urldecode($_POST['target']);
    $url = urldecode($_POST['url']);
    $config = urldecode($_POST['config']);
    $exclude = urldecode($_POST['exclude']);
    $include = urldecode($_POST['include']);
    $tls13 = urldecode($_POST['tls13']);
    $rename = urldecode($_POST['rename']);
    $surgeForce = urldecode($_POST['surgeForce']);
    $emoji = urldecode($_POST['emoji']);
    $list = urldecode($_POST['list']);
    $udp = urldecode($_POST['udp']);
    $tfo = urldecode($_POST['tfo']);
    $expand = urldecode($_POST['expand']);
    $scv = urldecode($_POST['scv']);
    $fdn = urldecode($_POST['fdn']);
    $newname = urldecode($_POST['newname']);
    $str = <<<EOD
[Profile]
target=$target
url=$url
config=$config
exclude=$exclude
include=$include
tls13=$tls13
rename=$rename
strict=$surgeForce
emoji=$emoji
list=$list
udp=$udp
tfo=$tfo
expand=$expand
scv=$scv
fdn=$fdn
newname=$newname
EOD;
    function mk_dir()
    {
        $dir = 'script';
        if (is_dir('./' . $dir)) {
            return $dir;
        } else {
            mkdir('./' . $dir, 0777, true);
            return $dir;
        }
    }

    function mk_inidir()
    {
        $inidir = 'subconverter';
        if (is_dir('./' . $inidir)) {
            return $inidir;
        } else {
            mkdir('./' . $inidir, 0777, true);
            return $inidir;
        }
    }

    $md5content = md5($diyscript);
    $jspath = '/' . mk_dir() . '/' . $md5content . '.' . 'js';
    file_put_contents(".$jspath", $diyscript);
    $inipath = '/' . mk_inidir() . '/' . $md5content . '.' . 'ini';
    file_put_contents(".$inipath", $str);
    $md5encode = urlencode(md5($diyscript));
    $arr = array('code' => 0, 'msg' => "success", 'data' => "https://subapi.d1.mk/redirect.php?token=$md5encode");
    echo json_encode($arr, 320);
}