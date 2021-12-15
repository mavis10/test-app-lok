<div class="navbar navbar-expand-md navbar-dark">
    <div class="navbar-brand" >
        <h4>Lok</h4>
    </div>

    <div class="collapse navbar-collapse" id="navbar-mobile">
        <span class="ml-md-3 mr-md-auto"></span>
        <ul class="navbar-nav">
            <li class="nav-item dropdown dropdown-user">
                <a href="#" class="navbar-nav-link d-flex align-items-center dropdown-toggle" data-toggle="dropdown">
                    <span>@if(isset(Auth::user()->firstName)){{Auth::user()->firstName}} {{Auth::user()->lastName}}@endif</span>
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                    <a href="/logout" class="dropdown-item"><i class="icon-switch2"></i> Logout</a>
                </div>
            </li>
        </ul>
    </div>
</div>