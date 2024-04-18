<nav class="navbar navbar-expand-lg" data-bs-theme="dark">
    <div class="container-fluid">
        <a class="navbar-brand nav-title" aria-current="page" href="?command=home">
            <h1>FlickVault</h1>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <?php $current_page = $_GET['command']; ?>
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 gap-2">
                <li class="nav-item active">
                    <a class="nav-link fs-5 <?php if ($current_page === 'watchlist') echo 'active border rounded'; ?>" href="?command=watchlist">Watch List</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link fs-5 <?php if ($current_page === 'history') echo 'active border rounded'; ?>" href="?command=history">Watch History</a>
                </li>
            </ul>
            <form id="nav-search-form" class="d-flex" role="search" action="" method="get">
                <input type="hidden" name="command" value="search">
                <input id="nav-search-input" class="form-control me-2" type="search" name="query" placeholder="Search" aria-label="Search">
                <button class="nav-search" type="submit">Search</button>
            </form>

            <div class="nav-item dropdown active ms-5 me-3">
                <a id="userInfo" class="btn btn-secondary rounded-circle p-2 ms-2" style="width: 40px; height: 40px;" href="#" role="button" data-bs-toggle="dropdown">
                    <i class="fa fa-user text-white" style="font-size: 1.3rem; margin-left: 0.1rem;"></i>
                </a>
                <ul class="dropdown-menu dropdown-menu-end mt-2">
                    <li>
                        <p id="userId" class="dropdown-item disabled"></p>
                    </li>
                    <li>
                        <p id="userEmail" class="dropdown-item disabled"></p>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li><a class="dropdown-item" href="?command=logout">Sign out</a></li>
                </ul>
            </div>
        </div>
    </div>
</nav>

<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script>
    $(() => {
        $('#userInfo').on('click', (event) => {
            $.ajax({
                type: 'GET',
                url: 'http://localhost:8080/flickvault/?command=getUser',
                success: (response) => {
                    const { id, email } = response
                    $('#userId').html(`<span>User ID: ${id}</span>`)
                    $('#userEmail').html(email)
                },
                error: (xhr, status, error) => {
                    console.error(error);
                }
            });
        });
    });
</script>