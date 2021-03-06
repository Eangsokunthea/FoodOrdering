@extends('FrontEnd.master')
@section('title')
    Dishes
@endsection

@section('content')
    <!-- products -->
	<div class="products">	 
		<div class="container">
			<div class="col-md-9 product-w3ls-right"> 
				<div class="product-top">
					<h4>Food Collection</h4>
					<div class="clearfix"> </div>
				</div>
				<div class="products-row">
                    @foreach($search_dish as $cateDish)
                        <div class="col-xs-6 col-sm-4 product-grids">
                            <div class="flip-container">
                                <div class="flipper agile-products">
                                    <div class="front"> 
                                        <img src="{{asset($cateDish->dish_image)}}" style="width: 250px; height:182px;" class="img-responsive" alt="img">
                                        <div class="agile-product-text">              
                                            <h5>{{$cateDish->dish_name}}</h5>  
                                        </div> 
                                    </div>
                                    <div class="back">
                                        <h4>{{$cateDish->dish_name}}</h4>
                                        <p style="border-bottom:none">{{$cateDish->dish_detail}}</p>
                                        <h6>{{$cateDish->full_price}}<sup>$</sup></h6>
										@if($cateDish->half_price==null)

										@else
											<p style="border-bottom:none">Half {{$cateDish->half_price}}<sup>$</sup></p>
										@endif
                                        <form action="{{route('add_to_cart')}}" method="post">
											@csrf
                                            <input type="hidden" name="dish_id" value="{{$cateDish->dish_id}}">
                                            <a href="#" data-toggle="modal" data-target="#myModal1{{$cateDish->dish_id}}">
												More <span class="w3-agile-line"> </span>
												<i class="fa fa-cart-plus" aria-hidden="true"></i> 
												Add to cart	
											</a>
                                        </form>
                                    </div>
                                </div>
                            </div> 
                        </div> 
						<!-- modal --> 
						<div class="modal video-modal fade" id="myModal1{{$cateDish->dish_id}}" tabindex="-1" role="dialog" aria-labelledby="myModal1">
							<div class="modal-dialog" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">??</span></button>						
									</div>
									<section>
										<div class="modal-body">
											<div class="col-md-5 modal_body_left">
												<img src="{{asset($cateDish->dish_image)}}" style="width: 250px; height:182px;" alt=" " class="img-responsive">
											</div>
											<div class="col-md-7 modal_body_right single-top-right"> 
												<h3 class="item_name">{{$cateDish->dish_name}}</h3>
												<p>{{$cateDish->dish_detail}}</p>
												<div class="single-rating">
													<ul>
														<li><i class="fa fa-star-o" aria-hidden="true"></i></li>
														<li><i class="fa fa-star-o" aria-hidden="true"></i></li>
														<li><i class="fa fa-star-o" aria-hidden="true"></i></li>
														<li><i class="fa fa-star-o" aria-hidden="true"></i></li>
														<li class="w3act"><i class="fa fa-star-o" aria-hidden="true"></i></li>
														<li class="rating">20 reviews</li>
														<li><a href="#">Add your review</a></li>
													</ul> 
												</div>
												<div class="single-price">
													<ul>
														<li>${{$cateDish->full_price}} $</li>  
														@if($cateDish->half_price==null)

														@else
															<li>Half {{$cateDish->half_price}} $</li>
															<input type="checkbox" name="half_price">
														@endif
														<!-- <li>Ends on : Dec,5th</li> -->
														<li><a href="#"><i class="fa fa-gift" aria-hidden="true"></i> Coupon</a></li>
													</ul>	
												</div> 
												<p class="single-price-text">Fusce a egestas nibh, eget ornare erat. Proin placerat, urna et consequat efficitur, sem odio blandit enim, sit amet euismod turpis est mattis lectus. Vestibulum maximus quam et quam egestas imperdiet. In dignissim auctor viverra. </p>
												<form action="{{route('add_to_cart')}}" method="post">
													@csrf
													<input type="hidden" name="dish_id" value="{{$cateDish->dish_id}}" />
													<h4>Quantity</h4>
													<input type="number" min="1" name="qty" /> 
													<button type="submit" class="w3ls-cart pw3ls-cart" >
														<i class="fa fa-cart-plus" aria-hidden="true"></i> 
														Add to cart
													</button>
												</form>
												<a href="#" class="w3ls-cart w3ls-cart-like"><i class="fa fa-heart-o" aria-hidden="true"></i> Add to Wishlist</a>
												<div class="single-page-icons social-icons"> 
													<ul>
														<li><h4>Share on</h4></li>
														<li><a href="#" class="fa fa-facebook icon facebook"> </a></li>
														<li><a href="#" class="fa fa-twitter icon twitter"> </a></li>
														<li><a href="#" class="fa fa-google-plus icon googleplus"> </a></li>
														<li><a href="#" class="fa fa-dribbble icon dribbble"> </a></li>
														<li><a href="#" class="fa fa-rss icon rss"> </a></li> 
													</ul>
												</div> 
											</div> 
											<div class="clearfix"> </div>
										</div>
									</section>
								</div>
							</div>
						</div> 
						<!-- //modal -->
                    @endforeach
					
					<div class="clearfix"> </div>
				</div>
			</div>
			<div class="col-md-3 rsidebar">
				<div class="rsidebar-top">
					<div class="slider-left">
						<h4>Categories</h4>            
						<div class="row row1">
							@foreach($categories as $cate)
								<label class="checkbox">
									<a href="{{route('show_category_dish', ['category_id'=>$cate->category_id])}}">
										{{$cate->category_name}}
									</a>
								</label>	
							@endforeach
						</div> 
					</div>	
				</div>
				<div class="clearfix"> </div> 
			</div>
		</div>
	</div>
	<!-- //products --> 
	<div class="container"> 
		<div class="w3agile-deals prds-w3text"> 
			<h5>Vestibulum maximus quam et quam egestas imperdiet. In dignissim auctor viverra.</h5>
		</div>
	</div>


@endsection