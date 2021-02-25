<?php

function sanitizeName($name){
    $delescript = preg_replace('#<script(.*?)>(.*?)</script>#is', '', $name);
    $nostring = filter_var($delescript, FILTER_SANITIZE_STRING);
    $tinyName = preg_replace('/[^a-z .A-Z ]+/','',$nostring);
    $explodeName = explode(" ",$tinyName);
    $correctNames = array_map('correctCase',$explodeName);
    $joinstring = implode(" ",$correctNames);
    $deletespace = preg_replace('/[ ]+/'," ",$joinstring);
    $deletespaceend = trim($deletespace);
    return $deletespaceend;
}

function correctCase($name){
    // aAa | AAA | aaA --> aaa
    $nameLowercase = strtolower($name);
    // aaa --> Aaa
    $uppercaseName = ucfirst($nameLowercase);
    return $uppercaseName;
}