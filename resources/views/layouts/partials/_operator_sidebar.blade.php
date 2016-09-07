<ul class="side-nav blue-grey darken-1" id="slide-out">
    <li>
        <div class="userView">
            <img class="background" src="/img/cover.jpg"/>
            <a href="#!user">
                <img class="circle" src="/img/logo.png"/>
            </a>
                <span class="white-text name"> {{ auth()->user()->name }} </span>
                <span class="white-text email"> {{ auth()->user()->email }} </span>
            </span>
        </div>
    </li>
    <li>
        <a href="{{ route('operator.dashboard') }}">
            <i class="material-icons">dashboard</i> Dashboard
        </a>
    </li>
    <li>
        <a href="{{ route('patients.index') }}">
            <i class="material-icons">account_circle</i> Patients
        </a>
    </li>
    <li>
        <a href="{{ route('reports.index') }}">
            <i class="material-icons">report</i> Reports
        </a>
    </li>
    <li>
        <div class="divider"></div>
    </li>
    <li>
        <a class="wave-effect" href="{{ url('/logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <i class="material-icons">lock</i>
            Logout
        </a>

        <form action="{{ url('/logout') }}" id="logout-form" method="POST" style="display: none;">
            {{ csrf_field() }}
        </form>

    </li>
</ul>
