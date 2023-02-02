<?php
/*
Plugin Name: BM_Announcement
Description: Announcement Banner
Version: 1.0
Author: Andre Campos
*/ 

// Add Announcement button to wordpress admin menu.
add_action('admin_menu', 'my_menu_pages');
function my_menu_pages(){
    add_menu_page('Annoucement', 'Announcement', 'manage_options', 'my-menu', 'my_menu_output', null, 6 );
    // add_submenu_page('my-menu', 'Submenu Page Title', 'Whatever You Want', 'manage_options', 'my-menu' );
    // add_submenu_page('my-menu', 'Submenu Page Title2', 'Whatever You Want2', 'manage_options', 'my-menu2' );
}


// What is showing on Annoucement menu on wordpress admin menu.
function my_menu_output() {

    $plugin_url = plugin_dir_url( __FILE__ );
    wp_enqueue_style( 'css', $plugin_url . 'css/css.css' );
	wp_enqueue_script( 'js', $plugin_url . 'js/js.js' );

    $jsonurl = $plugin_url . 'json/db.json';
    $jsonfile = file_get_contents($jsonurl);
    $json = json_decode($jsonfile, true);
    $status = $json['announcement']['display'];
    $title = $json['announcement']['title'];
    $subtitle = $json['announcement']['subtitle'];
    $size = $json['announcement']['size'];
    $titlecolor = $json['announcement']['titlecolor'];
    $subtitlecolor = $json['announcement']['subtitlecolor'];
    $backgroundcolor = $json['announcement']['backgroundcolor'];
    $backgroundimage = $json['announcement']['background'];
    $btype = $json['announcement']['backgroundtype'];
    

    //verifica se foi update
    $newstatus = $_GET['status'];
    $newtitle = $_GET['title'];
    $newsubtitle = $_GET['subtitle'];
    $newsize = $_GET['size'];
    $newtitlecolor = $_GET['titlecolor'];
    $newsubtitlecolor = $_GET['subtitlecolor'];
    $newbackgroundcolor = $_GET['backgroundcolor'];
    $newbackgroundimage = $_GET['banner'];
    $newbtype = $_GET['btype'];

    if($newstatus){
        $json['announcement']['display'] = $newstatus;
        $json['announcement']['title'] = $newtitle;
        $json['announcement']['subtitle'] = $newsubtitle;
        $json['announcement']['size'] = $newsize;
        $json['announcement']['titlecolor'] = $newtitlecolor;
        $json['announcement']['subtitlecolor'] = $newsubtitlecolor;
        $json['announcement']['backgroundcolor'] = $newbackgroundcolor;
        $json['announcement']['background'] = $newbackgroundimage;
        $json['announcement']['backgroundtype'] = $newbtype;
        $json_object = json_encode($json, true);
        $file = WP_PLUGIN_DIR . '/bm_announcement/json/db.json';
        file_put_contents($file, $json_object);
        echo '<div class="wrap" style="width:90%;height:40px;background-color:yellowgreen;">';
            echo "<h3 style='padding-top:10px;padding-left:10px;'>Announcement Updated</h3>";
	    echo '</div><br>';
        $status = $newstatus;
        $title = $newtitle;
        $subtitle = $newsubtitle;
        $size = $newsize;
        $titlecolor = $newtitlecolor;
        $subtitlecolor = $newsubtitlecolor;
        $backgroundcolor = $newbackgroundcolor;
        $backgroundimage = $newbackgroundimage;
        $btype = $newbtype;
    }

	echo '<div class="wrap">';
        echo '<h2>Announcement Plugin</h2>';
	echo '</div><br>';

    echo '<label class="switch">';
        if($status == "on"){
            echo '<input id="status" onclick="myFunction()" type="checkbox" checked>';
        }else{
            echo '<input id="status" onclick="myFunction()" type="checkbox">';
        }
        echo '<span class="slider round"></span>';
    echo '</label><br><br>';

    if($status == "on"){
        $statusdisplay = "none";
    }else{
        $statusdisplay = "block";   
    }

    echo '<div class="wrap">';
        echo '<h3>Text</h3>';
	echo '</div>';

    echo "<div id='announcementplugininformation' class='wrap'>";
        echo '<label for="fname">Title</label><br>';
        echo "<input type='text' id='apititle' name='apititle' value='$title'><br><br>";
        echo '<label for="fname">SubTitle</label><br>';
        echo "<input type='text' id='apisubtitle' name='apisubtitle' value='$subtitle'>";
    echo '</div><br>';

    echo '<div class="wrap">';
        echo '<h3>Size</h3>';
	echo '</div>';

    if($size == "small"){
        echo "<input type='radio' id='sizesmall' name='size' value='small' checked>";
    }else{
        echo "<input type='radio' id='sizesmall' name='size' value='small'>";
    }
    echo "<label >Small</label><br>";
    if($size == "medium"){
        echo "<input type='radio' id='sizemedium' name='size' value='medium' checked>";
    }else{
        echo "<input type='radio' id='sizemedium' name='size' value='medium'>";
    }
    echo "<label >Medium</label><br>";
    if($size == "large"){
        echo "<input type='radio' id='sizelarge' name='size' value='large' checked>";
    }else{
        echo "<input type='radio' id='sizelarge' name='size' value='large'>";
    }
    echo "<label >Large</label><br>";


    echo '<div class="wrap">';
        echo '<h3>Text Color</h3>';
	echo '</div>';


    echo '<div id="announcementplugininformation" class="wrap">';
        echo '<label for="fname">Title</label><br>';
        echo "<input type='color' id='apititlecolor' name='apititlecolor' value='#$titlecolor'><br><br>";
        echo '<label for="fname">SubTitle</label><br>';
        echo "<input type='color' id='apisubtitlecolor' name='apisubtitlecolor' value='#$subtitlecolor'>";
    echo '</div><br>';

    echo '<div class="wrap">';
        echo '<h3>Background Type</h3>';
	echo '</div>';

    if($btype == "color"){
        echo "<input type='radio' id='bcolor' name='btype' value='color' checked>";
    }else{
        echo "<input type='radio' id='bcolor' name='btype' value='color'>";
    }
    echo "<label >Color</label><br>";
    if($btype == "image"){
        echo "<input type='radio' id='bimage' name='btype' value='image' checked>";
    }else{
        echo "<input type='radio' id='bimage' name='btype' value='image'>";
    }
    echo "<label >Image</label><br>";

    echo '<div class="wrap">';
        echo '<h3>Background Color</h3>';
    echo '</div>';


    echo '<div id="announcementplugininformation" class="wrap">';
        echo '<label for="fname">Background Color</label><br>';
        echo "<input type='color' id='apibackgroundcolor' name='apibackgroundcolor' value='#$backgroundcolor'><br><br>";
    echo '</div><br>';

    echo '<div class="wrap">';
        echo '<h3>Background Image</h3>';
    echo '</div>';

    if($backgroundimage == "banner01"){
        echo "<input type='radio' id='banner01' name='banner' value='banner01' checked>";
    }else{
        echo "<input type='radio' id='banner01' name='banner' value='banner01'>";
    }
    $backgroundimage01url =  $plugin_url . 'img/banner01.png';
    echo "<img src='$backgroundimage01url' alt='banner' style='width:200px;height:50px;'><br>";

    if($backgroundimage == "banner02"){
        echo "<input type='radio' id='banner02' name='banner' value='banner02' checked>";
    }else{
        echo "<input type='radio' id='banner02' name='banner' value='banner02'>";
    }
    $backgroundimage02url =  $plugin_url . 'img/banner02.png';
    echo "<img src='$backgroundimage02url' alt='banner' style='width:200px;height:50px;'><br>";

    if($backgroundimage == "banner03"){
        echo "<input type='radio' id='banner03' name='banner' value='banner03' checked>";
    }else{
        echo "<input type='radio' id='banner03' name='banner' value='banner03'>";
    }
    $backgroundimage03url =  $plugin_url . 'img/banner03.png';
    echo "<img src='$backgroundimage03url' alt='banner' style='width:200px;height:50px;'><br>";

    echo '<div class="wrap">';
        echo "<button id='announcementbutton' onclick='buttonsave()' style='width:80px;height:35px;'>Save</button></a>";
    echo '</div>';

}

function myannouncement() {

$plugin_url = plugin_dir_url( __FILE__ );
$jsonurl = $plugin_url . 'json/db.json';
$jsonfile = file_get_contents($jsonurl);
$json = json_decode($jsonfile, true);
$status = $json['announcement']['display'];
$width = $json['announcement']['width'];
$height = $json['announcement']['height'];
$titlecolor = $json['announcement']['titlecolor'];
$subtitlecolor = $json['announcement']['subtitlecolor'];
$btype = $json['announcement']['backgroundtype'];
$backgroundcolor = $json['announcement']['backgroundcolor'];
$backgroundimage = $json['announcement']['background'];
$backgroundimageurl =  $plugin_url . 'img/' . $backgroundimage;
$size = $json['announcement']['size'];
$title = $json['announcement']['title'];
$subtitle = $json['announcement']['subtitle'];

if ($btype == "color"){
    $background = "background-color:#".$backgroundcolor;
}else{
    $background = "background-image: url(\"" . $backgroundimageurl .  ".png\");background-repeat: repeat;background-size: contain";
}

if($size == "small"){
    $height = "80px";
    $titlefontsize = "20px";
    $subtitlefontsize = "18px";
    if ($subtitle != ""){
        $padding = "5px";
    }else{
        $padding = "22px";
    }
}
if($size == "medium"){
    $height = "120px";
    $titlefontsize = "22px";
    $subtitlefontsize = "20px";
    if ($subtitle != ""){
        $padding = "25px";
    }else{
        $padding = "42px";
    }
}
if($size == "large"){
    $height = "160px";
    $titlefontsize = "24px";
    $subtitlefontsize = "22px";
    if ($subtitle != ""){
        $padding = "45px";
    }else{
        $padding = "62px";
    }
}


if($status == "on"){
    echo "<div id='announcementdiv' style='$background;width:100%;height:$height;'>";
        echo "<div style='max-width:$width;margin: 0 auto;height:100%;'>";
            echo "<div style='vertical-align: middle;padding-top:$padding;'>";
                echo "<div style='width:auto;height:35px;font-size:$titlefontsize;color:#$titlecolor;text-align:center;font-weight: bold;'>$title</div>";
                if ($subtitle != ""){
                echo "<div style='width:auto;height:35px;font-size:$titlefontsize;color:#$subtitlecolor;text-align:center;'>$subtitle</div>";
                }
            echo '</div>';
        echo '</div>';
    echo '</div>';
}

}
add_action('wp_body_open', 'myannouncement');
?>