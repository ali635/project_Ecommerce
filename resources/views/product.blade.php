@extends('layouts.app')
@section('content')
	<section>
		<div class="container">
			<div class="row">

                @include('partials.sidebar')

				<div class="col-sm-9 padding-right">
					<div class="product-details"><!--product-details-->
						<div class="col-sm-5">
							<div class="view-product">
								<img src="{{ asset($product->photo) }}" alt="" />
								<h3>ZOOM</h3>
							</div>
							<div id="similar-product" class="carousel slide" data-ride="carousel">

								  <!-- Wrapper for slides -->
								    <div class="carousel-inner">
										<div class="item active">
                                            <a href=""><img src="{{ asset("images/product-details/similar1.jpg") }}" alt=""></a>
                                            <a href=""><img src="{{ asset("images/product-details/similar2.jpg") }}" alt=""></a>
										    <a href=""><img src="{{ asset("images/product-details/similar3.jpg") }}" alt=""></a>
										</div>
										<div class="item">
                                            <a href=""><img src="{{ asset("images/product-details/similar1.jpg") }}" alt=""></a>
										    <a href=""><img src="{{ asset("images/product-details/similar2.jpg") }}" alt=""></a>
										    <a href=""><img src="{{ asset("images/product-details/similar3.jpg") }}" alt=""></a>
										</div>
										<div class="item">
                                            <a href=""><img src="{{ asset("images/product-details/similar1.jpg") }}" alt=""></a>
                                            <a href=""><img src="{{ asset("images/product-details/similar2.jpg") }}" alt=""></a>
                                            <a href=""><img src="{{ asset("images/product-details/similar3.jpg") }}" alt=""></a>
										</div>

									</div>

								  <!-- Controls -->
								  <a class="left item-control" href="#similar-product" data-slide="prev">
									<i class="fa fa-angle-left"></i>
								  </a>
								  <a class="right item-control" href="#similar-product" data-slide="next">
									<i class="fa fa-angle-right"></i>
								  </a>
							</div>

						</div>
						<div class="col-sm-7">
							<div class="product-information"><!--/product-information-->
								<img src="images/product-details/new.jpg" class="newarrival" alt="" />
								<h2>{{ $product->title_en }}</h2>
								<p>ID: {{ $product->code }}</p>
                                <p>{{ $product->content_en }}</p>
								<img src="images/product-details/rating.png" alt="" />
								<span>
                                    <span>${{ $product->price }}</span>
									<label>Quantity:</label>
									<input type="text" value="3" />
									<button type="button" class="btn btn-fefault cart">
										<i class="fa fa-shopping-cart"></i>
										Add to cart
									</button>
								</span>
								<p><b>Availability:</b> {{ inStock($product->id) }}</p>
								<p><b>Brand:</b> {{ ucfirst($productBrand->name_en) }}</p>
								<a href=""><img src="images/product-details/share.png" class="share img-responsive"  alt="" /></a>
							</div><!--/product-information-->
						</div>
					</div><!--/product-details-->



					@include('partials.recommend-items')

				</div>
			</div>
		</div>
	</section>
@endsection
