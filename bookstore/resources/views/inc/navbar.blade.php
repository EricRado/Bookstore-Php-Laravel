<nav class="navbar navbar-expand-md navbar-dark fixed-top  flex-column bg-dark " role="navigation">
     
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
    
    
        
        <div class="navbar-collapse collapse flex-md-column" id="navbarCollapse">
            
            <div class="input-group" >
                <a class="navbar-brand ml-auto" href="#" > BRAND NAME</a>
                <!-- Search for books form -->
                {!! Form::open(['action' => 'BooksController@searchBookByTitle', 'method' => 'GET', 'class' => 'form-inline mr-small-2']) !!}

                {!! Form::text('input', '', ['required', 'class' => 'form-control input md mr-sm-4', 'placeholder' => 'Search for a book']) !!}
                {!! Form::submit('Search', ['class' => 'btn btn-outline-success my-2 my-sm-0']) !!}

                {!! Form::close() !!}

                @if (!Auth::guest())

                <li class="nav-item">
                    <a style="color: white" class="nav-link" href="#">Hello {{ Auth::user()->username }}</a>
                </li>

                @endif

                <!-- Link to Shopping Cart -->
                <a style="color: white" class="nav-link" href="/shoppingCart/show">Cart</a>

            </div>

        <div class="input-group">
            <ul class="navbar-nav ">
                
                <!-- Link to Home page -->
                <li class="nav-item"> 
                    <a style="color: white" class="navTabColor nav-link" href="/">Home 
                        <span class="sr-only">(current)</span>
                    </a>
                </li>
                
                <!-- Link to Tech Valley Times Books -->
                <li class="nav-item">
                    <a style="color: white" href="/books/techValleyTimes"
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
                <li class="dropdown nav-item"> 
                    <a style="color: white;" id="navbarDropdown" class="dropdown-toggle nav-link" 
                    data-toggle="dropdown" role="button" href="#" aria-haspopup="true" aria-expanded="false">Books
                        <span class="caret"></span>
                    </a>

                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        
                        <a class="dropdown-item" href="/books/topRated">Top Rated Books</a>
                        <a class="dropdown-item" href="/books/genre/scifi">Science Fiction</a>
                        <a class="dropdown-item" href="/books/genre/gaming">Gaming</a>
                        <a class="dropdown-item" href="/books/genre/iot">Internet of Things</a>
                        <a class="dropdown-item" href="/books/genre/history">History</a>    
                        <a class="dropdown-item" href="/books/genre/social">Social</a>
                        
                    </div>
                </li>
                
                <!-- Link to About page -->
                <li class="nav-item">
                    <a style="color: white;" href="/about" class="nav-link">About</a>
                </li>
            </ul>
            
            <!-- Right Side of navigation bar -->

            
            <ul class="nav navbar-nav ml-auto">
                
                @if(!Auth::guest())
                    <li class="nav-item"> 
                        <a style="color: white;" href="{{route('logout')}}" class="nav-link" onclick="event.preventDefault();
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
                        role="button" href="" aria-haspopup="true" aria-expanded="false">My Account
                        <span class="caret"></span>
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
                            <a href="/shoppingCart/orderHistory">Purchase History</a>
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