<nav class="navbar navbar-dark bg-dark fixed-top navbar-expand-md" role="navigation">
        <div class="container">
            <button class="navbar-toggler collapsed" type="button" data-toggle="collapse"
            data-target="#navbarTop" aria-controls="navbar" aria-expanded="false"> <span class="sr-only">Toggle Navigation</span>
    &#x2630;</button> <a class="navbar-brand"
            href="#"><img src="{{ asset('img/homelogo.png')}}" class="result" height="80" width="300"></a>
            <div class="navbar-collapse collapse" id="navbarTop">
                <ul class="nav navbar-nav navbar-center">
                    <li class="nav-item">
                        
                        <!-- Search for books form -->
                        <form class="form-inline my-2 my-lg-0" action="" method="GET">
                            <input class="form-control input-md  mr-sm-4" type="search" name="bookSearch"
                            placeholder="Search Book">
                            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">
                                <span style="color:black" class="glyphicon glyphicon-search"></span>
                            </button>
                        </form>
                    </li>
                </ul>
                
                <!-- Link to Shopping Cart -->
                <ul class="nav navbar-nav ml-auto">
                    @if (!Auth::guest())
                        <li class="nav-item">
                            <a style="color: white" class="nav-link" href="#">Hello {{ Auth::user()->username }}</a>
                        </li>
                    @endif
                    <li class="nav-item"><a style="color: white" class="nav-link" href="{% url &apos;payments:shoppingCart&apos; %}">
                        <span class="glyphicon glyphicon-shopping-cart"></span> Cart</a>
                    </li>
                </ul>
        </div>
        <button class="navbar-toggler collapsed" type="button" data-toggle="collapse"
            data-target="#navbar" aria-controls="navbar" aria-expanded="false"> <span class="sr-only">Toggle Navigation</span>
        </button>
        
        <div class="navbar-collapse collapse" id="navbar">
            <ul class="nav navbar-nav">
                
                <!-- Link to Home page -->
                <li class="nav-item"> 
                    <a style="color: white" class="navTabColor nav-link" href="/">Home 
                        <span class="sr-only">(current)</span>
                    </a>
                </li>
                
                <!-- Link to Tech Valley Times Books -->
                <li class="nav-item">
                    <a style="color: white" href="{% url &apos;products:techValleyTimes&apos; %}"
                        class="nav-link">Tech Valley Times
                    </a>
                </li>
                
                <!-- Link to Best Sellers -->
                <li class="nav-item">
                    <a style="color: white" href="/books/bestSellers"
                        class="nav-link">Best Sellers
                    </a>
                </li>
                
                <!-- Link to Dropdown for genre of Books -->
                <li class="dropdown nav-item"> <a style="color: white" class="dropdown-toggle nav-link" data-toggle="dropdown"
                    role="button" href="#" aria-haspopup="true" aria-expanded="false">Books<span class="caret"></span>
    
                        </a>
                    <ul class="dropdown-menu">
                        <li class="dropdown-item">
                            <a href="/books/topRated">Top Rated Books</a>
                        </li>
                        <li class="dropdown-item">
                            <a href="/books/genre/scifi">Science Fiction</a>
                        </li>
                        <li class="dropdown-item">
                            <a href="/books/genre/gaming">Gaming</a>
                        </li>
                        <li class="dropdown-item">
                            <a href="/books/genre/iot">Internet of Things</a>
                        </li>
                        <li class="dropdown-item">
                            <a href="/books/genre/history">History</a>
                        </li>
                        <li class="dropdown-item">
                            <a href="/books/genre/social">Social</a>
                        </li>
                    </ul>
                </li>
                
                <!-- Link to About page -->
                <li class="nav-item">
                    <a style="color: white" href="/about" class="nav-link">About</a>
                </li>
            </ul>
            
            <!-- Right Side of navigation bar -->

            <ul class="nav navbar-nav ml-auto">
               
                @if(!Auth::guest())
                    <li class="nav-item"> 
                        <a style="color: white" href="{{route('logout')}}" class="nav-link" onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">Logout</a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                        </form>

                    </li>
                @else
                    <li class="nav-item">
                        <!-- Login id target --> 
                        <a style="color: white" href="#" class="nav-link"
                         data-toggle="modal" data-target="#modalSignIn" >Login</a>
                    </li>
                @endif 
                
                @if(!Auth::guest())
                
                <!-- Link to Dropdown for My Account -->
                <li class="dropdown nav-item">
                    <a style="color: white" class="dropdown-toggle nav-link" data-toggle="dropdown"
                        role="button" href="" aria-haspopup="true" aria-expanded="false">My Account<span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="dropdown-item">
                            <a href="{% url &apos;accounts:manageAccount&apos; %}">Manage Account</a>
                        </li>
                        <li class="dropdown-item">
                            <a href="{% url &apos;accounts:changePassword&apos; %}">Change Password</a>
                        </li>
                        <li class="dropdown-item">
                            <a href="/creditCards/{{ Auth::user()->id }}">Manage Payment Method</a>
                        </li>
                        <li class="dropdown-item">
                            <a href="/addresses/{{ Auth::user()->id}}">Manage Shipping Address</a>
                        </li>
                        <li class="dropdown-item">
                            <a href="{% url &apos;payments:orderHistory&apos; %}">Purchase History</a>
                        </li>
                    </ul>
                </li>
                
                @else
                <li class="nav-item"> 
                    <a style="color: white" href="{{route('register')}}" class="nav-link">Register</a>
                </li>
                
                @endif
            </ul>
        </div>  
    </div>
</nav>


 <!-- Sign In Modal -->
 <div class="modal fade" id="modalSignIn" role="dialog">
    <div class="modal-dialog">
        <!-- Sign In Modal Content -->
        <div class="modal-content">
            @include('auth.login')
        </div>
    </div>
 </div>