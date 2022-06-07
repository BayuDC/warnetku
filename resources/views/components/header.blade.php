<nav class="navbar navbar-expand-lg navbar-dark bg-success">
    <div class="container">
        <a class="navbar-brand" href="{{route('home')}}">Warnetku</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link active" href="{{ route('computer.index') }}">Computer</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="{{ route('price.index') }}">Price</a>
                </li>
                @can('is-owner')
                <li class="nav-item">
                    <a class="nav-link active" href="{{ route('operator.index') }}">Operator</a>
                </li>
                @endcan
                <li class="nav-item">
                    <a class="nav-link active" href="{{ route('transaction.index') }}">Transaction</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="{{ route('report') }}">Report</a>
                </li>
            </ul>
            <ul class="navbar-nav ms-auto">
                <li class="nav-item dropdown">
                    <div class="text-light dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        {{ Auth::user()->username }}
                    </div>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li>
                            <h6 class="dropdown-header">Login as <span class="fw-bold">{{ Auth::user()->fullname }}</span></h6>
                        </li>
                        <li class="dropdown-item">
                            <a href="{{ route('me.show') }}" class="link-dark">My Profile</a>
                        </li>
                        <li class="dropdown-divider"></li>
                        <li class="dropdown-item">
                            <form action="{{ route('logout') }}" method="post">
                                @csrf
                                <button type="submit" class="border-0 bg-transparent text-decoration-underline link-danger">
                                    Logout
                                </button>
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
