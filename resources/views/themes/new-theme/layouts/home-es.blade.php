<!DOCTYPE html>
<html>
@include('themes.new-theme.includes.head-es')


<body >
<div
    class="topbar" style="    position: absolute;
    top: 20px;
    z-index: 101;">
    <div
        class="row-fluid">
        <div
            class="span12">
            <div
                class="container">
                <div
                    class="navbar" >
                    <div
                        class="span12">
                        <ul
                            class="nav" style="margin: 0 10px 0 27%;">
                            <li
                                class="active"> <a style="color: white !important;"
                                    href="{{route("home-es")}}">INICIO</a></li>
                            <li
                                class=""> <a style="color: white !important;"
                                    href="{{route("agency-es")}}">AGENCIA</a></li>
                            <li
                                class=""> <a style="color: white !important;"
                                    href="{{route("girls-es")}}">MODELOS/ANFITRIONAS</a></li>

                            <li>
                                <div
                                    class="languageSelector"> <a
                                        class='selected' href='{{route("home")}}' title='English' rel='en' >
                                        <img src="{{asset("uploads/uk-f.png")}}" alt="" width="35">
                                    </a>
                                    <a
                                        class='' href='{{route("home-es")}}' title='Spanish' rel='es' >
                                        <img src="{{asset("uploads/es-f.png")}}" alt="" width="35">
                                    </a></div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="myCarousel" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->


    <!-- Wrapper for slides -->
    <div class="carousel-inner">
        @php
            $sn = 0;
        @endphp
        @foreach($sliders as $slider)
            <div class="item @if($sn==0) active @endif">
                <img src="{{asset("uploads/sliders/$slider->pic")}}" alt="{{$slider->title_es}}" style="width:100%;">
                <div class="carousel-caption">
                    <h3>{{$slider->title_es}}</h3>
                    <p>{{$slider->description_es}}</p>
                </div>
            </div>
            @php $sn++; @endphp
        @endforeach
    </div>

    <!-- Left and right controls -->

</div>
@include('themes.new-theme.includes.footer-es')
@include('themes.new-theme.includes.scripts')

</body>
</html>

