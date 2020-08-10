<div class="container portfolio_title">
    <div class="section-title">
        <h2>{{$title}} - <a href="/" class="btn btn-primary">Back to Frontpage</a> <a class="btn btn-danger" href="{{ route('logout') }}">Logout</a></h2>
    </div>
</div>
<div class="portfolio">
    <div id="filters" class="sixteen columns">
        <ul style="padding:0px 0px 0px 0px">
            <li><a  href="{{route('pagesAll')}}">
                    <h5>Pages list</h5>
                </a>
            </li>
            <li><a  href="{{route('portfolios.index')}}">
                    <h5>Portfolios</h5>
                </a>
            </li>
            <li><a href="{{route('services.index')}}">
                    <h5>Services</h5>
                </a>
            </li>
            <li><a href="{{route('galleries.index')}}">
                    <h5>Galleries</h5>
                </a>
            </li>
            <li><a href="{{route('employees.index')}}">
                    <h5>Contacts</h5>
                </a>
            </li>
        </ul>
    </div>

</div>
