<nav class="navbar navbar-expand-lg" data-bs-theme="dark">
    <div class="container-fluid">
        <a class="navbar-brand nav-title" aria-current="page" href="?command=home">
            <h1>FlickVault</h1>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" href="?command=watchlist">Watch List</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="?command=history">Watch History</a>
                </li>
            </ul>
            <form id="nav-search-form" class="d-flex" role="search" action="" method="get">
                <input type="hidden" name="command" value="search">
                <input class="form-control me-2" type="search" name="query" placeholder="Search" aria-label="Search">
                <button class="btn nav-search" type="submit">Search</button>
            </form>

            <div class="nav-item active ms-5">
                <a href="?command=logout" class="btn btn-danger rounded-circle p-2" style="width: 40px; height: 40px;">
                    <i class="fa fa-sign-out text-white" style="font-size: 1.3rem; margin-left: 0.1rem;"></i>
                </a>
            </div>
        </div>
    </div>
</nav>