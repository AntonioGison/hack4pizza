<?php //dd("working"); ?>
@extends('themes.new-theme.layouts.home')
<?php
if(isset($settings['site_title'])) {
    $title = $settings['site_title'];
}else {
    $title = "no title";
}
?>
