
<nav class="navbar navbar-expand-lg navbar-light bg-secondary">
    <a class="navbar-brand" href="#">
        <img src="{{asset("images/logo.png")}}" width="30" height="30" class="d-inline-block align-top" alt="">
        Bambini Fashion
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item active">
                <a class="nav-link" href="{{ route("products") }}">Products </a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="{{ route("orders") }}">Orders</a>
            </li>

            <li class="nav-item">
                <a class="nav-link disabled" href="#">Basket</a>
            </li>
        </ul>
    </div>
</nav>