<div class="recommended_items"><!--recommended_items-->
    <h2 class="title text-center">recommended items</h2>
    <div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <div class="item active">

                @foreach($recommndProduct as $reProduct)

                    <div class="col-sm-4">
                        <div class="product-image-wrapper">
                            <div class="single-products">
                                <div class="productinfo text-center">
                                    <img src="{{ asset($reProduct->photo) }}" alt="" />
                                    <h2>${{ $reProduct->price }}</h2>
                                    <a href="{{ route('product.show', $reProduct->id) }}"><p>{{ $reProduct->title_en }}</p></a>
                                    <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                                </div>
                            </div>
                        </div>
                    </div>

                @endforeach

            </div>
        </div>
    </div>
</div><!--/recommended_items-->
