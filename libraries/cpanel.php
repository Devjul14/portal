<?php
class Cpanel{
    function menu($link,$icon,$judul){
        return '<div style="float: left">
            <div class="icon">
                <a href="'.$link.'">
                    <img src="'.$icon.'">
                    <span>'.$judul.'</span>
                </a>
            </div>
        </div>';
    }
    function submenu($link,$icon,$judul,$class=NULL){
        return '<span style="float: right">
            <div class="icon">
                <a href="'.$link.'" class="'.$class.'">
                    <img src="'.$icon.'">
                    <span>'.$judul.'</span>
                </a>
            </div>
        </span>';
    }
}
?>
