<!DOCTYPE html>
<html lang="en">
<head>
<title>@yield('title', 'TItle')</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
@yield('custom_css')
<style>
body,h1,h2,h3,h4,h5 {font-family: "Raleway", sans-serif}
.w3-third img{margin-bottom: -6px; opacity: 0.8; cursor: pointer}
.w3-third img:hover{opacity: 1}
.w3-button.active {
  background-color: #9E9E9E !important;
}

</style>
</head>
<body class="w3-light-grey w3-content" style="max-width:1600px">


@php
  $as =  request()->route()->action['as'];
@endphp

<!-- Sidebar/menu -->
<nav class="w3-sidebar w3-bar-block w3-white w3-animate-left w3-text-grey w3-collapse w3-top w3-center" style="z-index:3;width:300px;font-weight:bold" id="mySidebar"><br>
  <h3 class="w3-padding-64 w3-center"><b>FRUIT</b></h3>
  <a href="javascript:void(0)"  class="w3-bar-item w3-button w3-padding w3-hide-large">CLOSE</a>
  <a href="{{ route('home') }}"  class="w3-bar-item w3-button {{ $as == 'home' ? 'active' : '' }}">Catelory</a> 
  <a href="{{ route('prodcut.index') }}"  class="w3-bar-item w3-button {{ $as == 'prodcut.index' ? 'active' : '' }}">Prodcut</a> 
  <a href="{{ route('invoice.index') }}"  class="w3-bar-item w3-button {{ $as == 'invoice.index' ? 'active' : '' }}"> Invoice </a>
</nav>

<!-- Top menu on small screens -->
<header class="w3-container w3-top w3-hide-large w3-white w3-xlarge w3-padding-16">
  <span class="w3-left w3-padding">SOME NAME</span>
  <a href="javascript:void(0)" class="w3-right w3-button w3-white" onclick="w3_open()">☰</a>
</header>

<!-- Overlay effect when opening sidebar on small screens -->
<div class="w3-overlay w3-hide-large w3-animate-opacity" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>

<!-- !PAGE CONTENT! -->
<div class="w3-main" style="margin-left:300px">

  <!-- Push down content on small screens --> 

  <!-- Contact section -->
  @yield('content')

  <!-- Footer -->
 
  
<!-- End page content -->
</div>

@yield('custum_js')

</body>
</html>
