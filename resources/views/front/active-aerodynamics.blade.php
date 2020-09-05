@extends('front.layout.master')
@section('Content')

<div class="container"
     style="background-image:url({{url('/public/front')}}/img/backgrounds/active-aerodynamics-2560b-min.jpg)"></div>

<div class="attract-loop-container">
    <div class="attract-loop">
        <video id="active-aerodynamics" class="shadow" poster="" width="350" autoplay muted plays-inline loop>
            <source src="{{url('/public/front/media')}}/active-aerodynamics.mp4" type="video/mp4"/>
        </video>
    </div>
</div>


<!-- BEGIN SIDE_BAR -->
@include('front.layout._sidebar')
<!-- END SIDE_BAR -->


<div id="media-player" class="popup">
    <div class="titlebar">
        <img class="logo" src="{{url('/public/front')}}/img/magna-logo.png">
        <h2 class="light">Media Player Popup</h2>
        <img class="popup-close" src="{{url('/public/front')}}/img/close-blk.png">
    </div>
    <div class="left-bg"></div>
    <div class="content">
        <div class="left">
            <h2></h2>
            <div id="media-player-menu">
            </div>
        </div>
        <div class="right">
            <div id="video-container-in-popup">
                <video
                        width="350"
                        plays-inline controls
                        poster="{{url('/public/front/content')}}/active-aerodynamics/media-splash.jpg">
                </video>
                <img src="{{url('/public/front/content')}}/active-aerodynamics/media-splash.jpg">
            </div>
            <h3 class="dark">Video Subtitle</h3>
            <p class="light">Video description</p>
        </div>
    </div>
</div>

<img class="info-icon infoButton" src="{{url('/public/front')}}/img/info.png">
<div id="popup-container"></div>

<div id="orientation-alert"><p>Please rotate your device.</p></div>

<script type="text/javascript" src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script type="text/javascript" src='https://ricostacruz.com/jquery.transit/jquery.transit.min.js'></script>
<script type="text/javascript" src="{{url('/public/front')}}/js/hotspots/active-aerodynamics.js"></script>
<script type="text/javascript" src="{{url('/public/front')}}/js/info-popup.js"></script>
<script type="text/javascript" src="{{url('/public/front')}}/js/mplayer-popup.js"></script>

<script type="text/javascript">
    /* 1. set position of info buttons and video container */

    const video = document.querySelector('#active-aerodynamics'),
        img_width = 2560,
        img_height = 1080,
        video_scale = 0.37,
        video_width = 70.8 * video_scale,
        video_height = 40.0 * video_scale,
        info = document.querySelector('.info-icon')

    const video_resize = () => {
        video.style.position = 'absolute'
        let unit, unit_val
        if (window.innerHeight / window.innerWidth > img_height / img_width) {
            unit = 'vh'
            unit_val = img_width / img_height
        } else {
            unit = 'vw'
            unit_val = 1.0
        }
        video.style.width = '' + (video_width * unit_val) + unit
        video.style.height = '' + (video_height * unit_val) + unit
        video.style.left = 'calc(50vw - ' + (video_width / 2 * unit_val) + unit + ')'
        video.style.top = 'calc(50vh - ' + ((video_height - 0.77) * unit_val) + unit + ')'

        info.style.position = 'absolute'
        info.style.width = '50px'
        info.style.height = '50px'
        info.style.left = 'calc(50vw - ' + ((video_width / 2 + 5) * unit_val) + unit + ')'
        info.style.top = 'calc(50vh - ' + ((video_height - 0.77 + 3.42) * unit_val) + unit + ')'
    }

    window.onresize = video_resize
    video_resize()


    /* 2. set mplayer popup */

    const popupMenus = {
        'Active Aerodynamics iPad': [
            {
                menutitle: 'Active Aerodynamics',
                title: 'Visible Active Grille Shutter',
                techsheet: "{{url('/content')}}/active-aerodynamics/1_Visible_Active_Grille_Shutter.jpg",
                video: "{{url('/videos')}}/active-aerodynamics/1_Sedan_Visible_Active_Grille_Shutter.mp4"
            },
            {
                title: 'Active Grille Shutter',
                techsheet: "{{url('/content')}}/active-aerodynamics/2_Active_Grille_Shutter.jpg",
                video: "{{url('/videos')}}/active-aerodynamics/2_SUV_Active_Grille_Shutter.mp4"
            },
            {
                title: 'Active Air Deflector',
                techsheet: "{{url('/content')}}/active-aerodynamics/3_Active_Air_Deflector.jpg",
                video: "{{url('/videos')}}/active-aerodynamics/3_Pickup_Active_Air_Deflector.mp4"
            },
            {
                title: 'Active Underbody Panel',
                techsheet: "{{url('/content')}}/active-aerodynamics/4_Active_Underbody_Panel.jpg",
                video: "{{url('/videos')}}/active-aerodynamics/4_Sedan_Active_Underbody_Panel.mp4"
            },
            {
                title: 'Active Front Wheel Deflector',
                techsheet: "{{url('/content')}}/active-aerodynamics/5_Active_Front_Wheel_Deflectors.jpg",
                video: "{{url('/videos')}}/active-aerodynamics/5_SUV_Front_Wheel_Deflector.mp4"
            },
            {
                title: 'Active Rear Diffuser',
                techsheet: "{{url('/content')}}/active-aerodynamics/6_Active_Rear_Diffuser.jpg",
                video: "{{url('/videos')}}/active-aerodynamics/6_SUV_Active_Rear_Diffuser.mp4"
            },
            {
                title: 'Active Spoiler',
                techsheet: "{{url('/content')}}/active-aerodynamics/7_Active_Spoiler.jpg",
                video: "{{url('/videos')}}/active-aerodynamics/7_SUV_Active_Spoiler.mp4"
            }
        ],
        'Active Aerodynamics Screen': [
            {
                menutitle: 'Active Aerodynamics',
                title: 'Faster, Further for Less',
                video: "{{url('/videos')}}/active-aerodynamics/faster-further-less.mp4"
            },
            {
                title: 'Wind Tunnel Experience',
                video: "{{url('/videos')}}/active-aerodynamics/wind-tunnel-experience.mp4"
            }
        ]
    }
    const openMplayerMethods = initMplayer(popupMenus)
    video.onclick = () => {
        openMplayerMethods[1]()[0]()
    }


    /* 3. set pdf popup */

    let dataA = {
        title_a: 'Active Aerodynamics',
        subtitle_a: "Blow Away the Competition with Active Aerodynamics",
        desc_a: 'Go Faster, Further for Less with our Active Aerodynamics shape-changing products that improve fuel efficiency, reduce emissions and make styling a breeze.',
        title_b: 'Registration Form',
        functions_b: ["Engineering", "Purchasing", "Product Development", "Marketing", "Other"],
        techs_b: ["Visible Active Grille Shutter", "Active Grille Shutter", "Active Air Deflector", "Active Underbody Panel", "Active Front Wheel Deflectors", "Active Rear Diffuser", "Active Spoiler", "All Tech Sheets"],
        techs_b_pdf: ["{{url('/pdfs')}}/active-aerodynamics/downloads/Visible_Active_Grille_Shutter.pdf", "{{url('/pdfs')}}/active-aerodynamics/downloads/Active_Grille_Shutter.pdf", "{{url('/pdfs')}}/active-aerodynamics/downloads/Active_Air_Deflector.pdf", "{{url('/pdfs')}}/active-aerodynamics/downloads/Active_Underbody_Panel.pdf", "{{url('/pdfs')}}/active-aerodynamics/downloads/Active_Front_Wheel_Deflectors.pdf", "{{url('/pdfs')}}/active-aerodynamics/downloads/Active_Rear_Diffuser.pdf", "{{url('/pdfs')}}/active-aerodynamics/downloads/Active_Spoiler.pdf", "{{url('/pdfs')}}/active-aerodynamics/downloads/Magna_Active_Aerodynamics.pdf"],
        bg_img_b: "{{url('/public/front')}}/img/backgrounds/Active-Aerodynamics-pdf-bg-min.jpg"
    }
    $(".infoButton").click(() => {
        showPdfPopup(dataA)
    })
</script>
<script type="text/javascript" src="{{url('/public/front')}}/js/fade-nav.js"></script>
<script type="text/javascript" src="{{url('/public/front')}}/js/bg-dragger.js"></script>
<script type="text/javascript">
    initFadedNavigation("{{url('/public/front')}}/img/backgrounds/active-aerodynamics-blur.jpg")
</script>

@endsection