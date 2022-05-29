<nav class="navbar navbar-expand-lg navbar-dark bg-success">
    <div class="container">
        <a class="navbar-brand" href="/">Warnetku</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link active" href="/computer">Computer</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="/price">Price</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="/operator">Operator</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="/transaction">Transaction</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="/report">Daily Report</a>
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
                        <li class="dropdown-divider"></li>
                        <li class="dropdown-item">
                            <a href="/logout" class="link-danger">Logout</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>