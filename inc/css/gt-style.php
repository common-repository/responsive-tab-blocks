<?php

$output .= '<style>

.gt_menu.style2 ul {
    text-align: center;
  display: inline-flex;
    margin: 0px;
    padding: 0px;
    margin-bottom: 25px;
    margin-top: 25px;
}
.gt_menu.style2 > ul >li.current a span,.gt_menu.style2 > ul >li:hover a  span{
    background: #267fd7 !important;
    border-color: #267fd7 !important;
    color: #fff;
    box-shadow: none !important;
}




@media screen and (min-width:'.$gt_breakpoint.'px){
.gt_menu.style2 > ul >li a.active{
color:#000;
}
.gt_menu.style2 > ul >li a.active span, .gt_menu.style2 > ul >li a span {
    width: 85px;
    position: relative;
    height: 85px;
    border-radius: 90px;
    background: #fff;
    padding: 0px;
    border: 0px;
    box-shadow: 0px 0px 11px -5px;
  
    margin: auto;
    margin-bottom: 10px;
    display:block;
    color:#000;
}

.gt_menu.style2 > ul >li a img {
    height: 48px !important;
    height: auto;
    max-height: inherit;
    margin: 0px;
    padding: 0px;
    margin: 16px 6px;
    position: initial;
    
}
.gt_menu.style2 {
    text-align: center;
}
.gt_menu.style2 > ul >li a.active span:before,.gt_menu.style2 > ul >li:hover a span:before {content: "";width: 100px;height: 100px;border: 1px solid #267fd7;position: absolute;border-radius: 90px;left: -8px;top: -8px;}


.gt_menu.style2 > ul >li a{
font-size: 15px;
}

.gt_menu.style2 > ul >li {
       margin-right: 21px;
    
    max-width: 100px;
    line-height: 17px;
}
}
@media screen and (max-width:'.$gt_breakpoint.'px){
.gt_menu.style2 ul {
    text-align: left;
    display: block;
    margin: 0px;
    padding: 0px;
    margin-bottom: 25px;
    margin-top: 25px;
}
    .gt_menu.style2 > ul >li a {
    display: block;
    padding: 0px 15px 7px 15px;
    background: white;
    color: black;
    border: 2px solid #ddd;
    margin-right: 10px;
    border-radius: 5px;
    text-align: left;
}
    .gt_menu.style2 > ul >li a{
    margin:0px;
        
    }
    }
}
</style>';


?>