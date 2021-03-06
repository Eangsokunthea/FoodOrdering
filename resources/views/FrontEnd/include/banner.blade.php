<div class="banner">
		<!-- header -->
		<?php
            $content = Cart::content();
        ?>
		<div class="header">
			<div class="w3ls-header"><!-- header-one --> 
				<div class="container">
					<div class="w3ls-header-left">
						<p>Free home delivery at your doorstep For Above $30</p>
					</div>
					<div class="w3ls-header-right">
						<ul> 
							<li class="head-dpdn">
								<i class="fa fa-phone" aria-hidden="true"></i> Call us: +08 122 50896 
							</li> 
							@if(Session::get('customer_id'))
							<li class="head-dpdn">
								<a href="#" onclick="document.getElementById('customerLogout').submit();"><i class="fa fa-sign-in" aria-hidden="true"></i> SignOut</a>
								<form action="{{route('sign_out')}}" method="post" id="customerLogout">
									@csrf

								</form>
							</li> 
							@else
							<li class="head-dpdn">
								<a href="{{route('sign_in')}}"><i class="fa fa-sign-in" aria-hidden="true"></i> SignIn</a>
							</li> 
							@endif
							@if(Session::get('customer_id'))
							<li class="head-dpdn">
								<a href="{{route('sign_up')}}"><i class="fa fa-user-plus" aria-hidden="true"></i>
									{{Session::get('customer_name')}}
								</a>
							</li> 
							@else
							<li class="head-dpdn">
								<a href="{{route('sign_up')}}"><i class="fa fa-user-plus" aria-hidden="true"></i> SignUp</a>
							</li> 
							@endif

							<li class="head-dpdn">
								<a href="offers.html"><i class="fa fa-gift" aria-hidden="true"></i> Offers</a>
							</li> 
							<li class="head-dpdn">
								<a href="help.html"><i class="fa fa-question-circle" aria-hidden="true"></i> Help</a>
							</li>
						</ul>
					</div>
					<div class="clearfix"> </div> 
				</div>
			</div>
			<!-- //header-one -->    
			<!-- navigation -->
			<div class="navigation agiletop-nav">
				<div class="container">
					<nav class="navbar navbar-default">
						<!-- Brand and toggle get grouped for better mobile display -->
						<div class="navbar-header w3l_logo">
							<button type="button" class="navbar-toggle collapsed navbar-toggle1" data-toggle="collapse" data-target="#bs-megadropdown-tabs">
								<span class="sr-only">Toggle navigation</span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>  
							<h1><a href="{{url('/')}}">Staple<span>Best Food Collection</span></a></h1>
						</div> 
						<div class="collapse navbar-collapse" id="bs-megadropdown-tabs">
							<ul class="nav navbar-nav navbar-right">
								<li><a href="{{route('show_all_dish')}}">Home</a></li>
								<li class="w3pages"><a href="{{route('show_all_dish')}}" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Type Dish<span class="caret"></span></a>
									<ul class="dropdown-menu">
										@foreach($categories as $cate)
										<li>
											<a href="{{route('show_category_dish', ['category_id'=>$cate->category_id])}}">
												{{$cate->category_name}}
											</a>
										</li>	
										@endforeach    
									</ul>
								</li> 
								<li><a href="{{route('about')}}">About</a></li> 
								<li><a href="{{route('contact')}}">Contact Us</a></li>
							</ul>
						</div>
						<div class="cart cart box_1"> 
							<a href="{{route('show_cart')}}" class="last"> 
								<button class="w3view-cart" type="submit" name="submit" value="" ><i class="fa fa-cart-arrow-down" aria-hidden="true"></i><sup style="color: #ffff; font-size: 15px;">{{Cart::count()}}</sup></button>
							</a>  
						</div> 
					</nav>
				</div>
			</div>
			<!-- //navigation --> 
		</div>
		<!-- //header-end --> 
		<!-- banner-text -->
		<div class="banner-text">	
			<div class="container">
				<h2>Delicious food from the <br> <span>Best Chefs For you.</span></h2>
				<div class="agileits_search">
					<form action="{{route('search_dish')}}" method="post">
						@csrf
						<input name="keywords_submit" type="text" placeholder="Enter Your Area Name" required="">
						<select id="agileinfo_search" name="agileinfo_search" required="">
							<option value="">Popular Cities</option>
							<option value="navs">New York</option>
							<option value="quotes">VietNam</option>
							<option value="all">Other</option>
						</select>
						<input type="submit" value="Search">
					</form>
				</div> 
			</div>
		</div>
	</div>