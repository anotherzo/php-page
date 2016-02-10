<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
       "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
  <title>{$pageTitle}</title>

  <link rel="stylesheet" href="{$uriHead}css/screen.css"  type="text/css" />
{if isset($loggedIn)}
  <link rel="stylesheet" href="{$uriHead}css/admin.css"  type="text/css" />
{/if}
  <link media="screen" rel="stylesheet" href="{$uriHead}css/colorbox.css" />

  <script src="{$uriHead}js/jquery-1.4.2.min.js" type="text/javascript"></script>
  <script src="{$uriHead}js/jquery-ui-1.8.5.custom.min.js" type="text/javascript"></script>
  <script src="{$uriHead}js/jquery.colorbox.js" type="text/javascript"></script>
</head>
<body>
  <div class="head">
    <div class="head_top"></div>
    <div class="head_text"><span class="german">Spielpartituren für Duos, Trios und Quartette</span> &mdash; <span class="english">Playing Scores for Duos, Trios and Quartets</span></div>
    <div class="head_bottom"></div>
  </div>
  <table class="content">
    <tr>
