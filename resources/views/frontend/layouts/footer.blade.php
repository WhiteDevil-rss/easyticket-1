 <!-- ==========Newslater-Section========== -->
 <footer class="footer-section">
    <div class="container">
        <div class="footer-top">
            <div class="logo">
                <a href="{{route('home')}}">
                     <img src="{{url('public/frontend/images/logo/logo.png')}}" alt="EasyTicket">
                </a>
            </div>
        </div>
        <div class="footer-bottom">
            <div class="footer-bottom-area">
                <div class="left">
                    <p>Copyright © {{Carbon\Carbon::now()->format('Y')}} .All Rights Reserved By <a href="#0">{{ env('APP_NAME') }} </a></p>
                </div>
                <ul class="links">
                    <li>
                        <a href="#0">About</a>
                    </li>
                    <li>
                        <a href="#0">Terms Of Use</a>
                    </li>
                    <li>
                        <a href="#0">Privacy Policy</a>
                    </li>
                    <li>
                        <a href="#0">FAQ</a>
                    </li>
                    <li>
                        <a href="#0">Feedback</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</footer>
<!-- ==========Newslater-Section========== -->
<script>
    var base_url = "{{url('/')}}";
    function setCookie(name,value,exp_days) {
    var d = new Date();
    d.setTime(d.getTime() + (exp_days*24*60*60*1000));
    var expires = "expires=" + d.toGMTString();
    document.cookie = name + "=" + value + ";" + expires + ";path=/";
    }

    function getCookie(name) {
    var cname = name + "=";
    var decodedCookie = decodeURIComponent(document.cookie);
    var ca = decodedCookie.split(';');
    for(var i = 0; i < ca.length; i++){
        var c = ca[i];
        while(c.charAt(0) == ' '){
            c = c.substring(1);
        }
        if(c.indexOf(cname) == 0){
            return c.substring(cname.length, c.length);
        }
    }
    return "";
}

</script>
<script src="{{url('public/frontend/js/modernizr-3.6.0.min.js')}}"></script>
<script src="{{url('public/frontend/js/plugins.js')}}"></script>
<script src="{{url('public/frontend/js/bootstrap.min.js')}}"></script>
<script src="{{url('public/frontend/js/heandline.js')}}"></script>
<script src="{{url('public/frontend/js/isotope.pkgd.min.js')}}"></script>
<script src="{{url('public/frontend/js/magnific-popup.min.js')}}"></script>
<script src="{{url('public/frontend/js/owl.carousel.min.js')}}"></script>
<script src="{{url('public/frontend/js/wow.min.js')}}"></script>
<script src="{{url('public/frontend/js/countdown.min.js')}}"></script>
<script src="{{url('public/frontend/js/odometer.min.js')}}"></script>
<script src="{{url('public/frontend/js/viewport.jquery.js')}}"></script>
<script src="{{url('public/frontend/js/nice-select.js')}}"></script>
<script src="{{url('public/frontend/js/main.js')}}"></script>
</body>


<!-- Mirrored from pixner.net/boleto/demo/index-2.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 20 Dec 2022 09:11:14 GMT -->
</html>