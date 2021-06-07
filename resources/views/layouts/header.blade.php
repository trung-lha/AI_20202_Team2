<header class="navbar fixed-top bg-light" >
    <div style=" width: 190%;">
        <div>
            <p class="navbar-text-top">
                <br><b>Welcome to Human Pose Estimate Website!</b><br>
                <hr>
            </p>
        </div>
        <h3 class="mr-5">
            <nav style="text-align: right">
                <a href="#about" ><u>About Us</u></a>
                <a href="#" ><u>Introduction</u></a>
                @if(!Auth::user())
                <a href="{{ Route('register') }}" ><u>Register</u></a>
                <a href="{{ Route('login') }}"><u>Login</u></a>
                @else
                <p>Welcome {{Auth::user()->name}}</p>
                @endif
                </ul>
            </nav>
        </h3>
    </div>
</header>