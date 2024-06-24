@extends('layout')
@section('title', 'Chi tiết '.$product->title.' | Furnitica')
@section('content')
<div id="wrapper-site">
    <div id="content-wrapper">
        <div id="main">
            <div class="page-home">

                <!-- breadcrumb -->
                <nav class="breadcrumb-bg">
                    <div class="container no-index">
                        <div class="breadcrumb">
                            <ol>
                                <li>
                                    <a href="{{ route('home') }}">
                                        <span>Trang chủ</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('product.detail',$id) }}">
                                        <span>Chi tiết sản phẩm '{{$product->title}}'</span>
                                    </a>
                                </li>
                            </ol>
                        </div>
                    </div>
                </nav>
                <div class="container">
                    <div class="content">
                        <div class="row">
                            <div class="sidebar-3 sidebar-collection col-lg-3 col-md-3 col-sm-4">

                                <!-- category -->
                                <div class="sidebar-block">
                                    <div class="title-block">Danh mục</div>
                                    <div class="block-content">
                                        <div class="cateTitle hasSubCategory open level1">
                                            <span class="arrow collapse-icons collapsed" data-toggle="collapse" data-target="#livingroom">
                                                <i class="zmdi zmdi-minus"></i>
                                                <i class="zmdi zmdi-plus"></i>
                                            </span>
                                            <a class="cateItem" href="{{url('/shop')}}">Tất cả danh mục</a>
                                            <div class="subCategory collapse" id="livingroom" aria-expanded="true" role="status">
                                                @foreach($categories as $cate)
                                                <div class="cateTitle">
                                                    <a href="{{ route('product.categories',$cate->id) }}" class="cateItem">{{$cate->name}}</a>
                                                </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- best seller -->
                                <div class="sidebar-block">
                                    <div class="title-block">
                                        Bán chạy
                                    </div>
                                    <div class="product-content tab-content">
                                        <div class="row">
                                            @foreach($bestsellers as $pro)
                                            <div class="item col-md-12">
                                                <div class="product-miniature item-one first-item d-flex">
                                                    <div class="thumbnail-container border">
                                                        <a href="{{ route('product.detail',$pro->id) }}">
                                                            <img class="img-fluid image-cover" src="{{asset('storage/products/'.$pro->image)}}" alt="img">
                                                            <img class="img-fluid image-secondary" src="{{asset('storage/products/'.$pro->image1)}}" alt="img">
                                                        </a>
                                                    </div>
                                                    <div class="product-description">
                                                        <div class="product-groups">
                                                            <div class="product-title text-truncate" style="max-width: 135px;">
                                                                <a href="{{ route('product.detail',$pro->id) }}">{{$pro->title}}</a>
                                                            </div>
                                                            <div class="rating">
                                                                <div class="star-content">
                                                                    <div class="star"></div>
                                                                    <div class="star"></div>
                                                                    <div class="star"></div>
                                                                    <div class="star"></div>
                                                                    <div class="star"></div>
                                                                </div>
                                                            </div>
                                                            <div class="product-group-price">
                                                                <div class="product-price-and-shipping">
                                                                    <span class="price">{{number_format($pro->sale, 0, ',', '.')}} VND</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-8 col-lg-9 col-md-9">
                                @if(session('success'))
                                <div class="bg-success mb-5 text-light p-3 rounded">{{session('success')}}</div>
                                @endif
                                <div class="main-product-detail">
                                    <h2>{{$product->title}}</h2>
                                    <div class="product-single row">
                                        <div class="product-detail col-xs-12 col-md-5 col-sm-5">
                                            <div class="page-content" id="content">
                                                <div class="images-container">
                                                    <div class="js-qv-mask mask tab-content border">
                                                        <div id="item1" class="tab-pane fade active in show">
                                                            <img src="{{asset('storage/products/'.$product->image)}}" alt="img">
                                                        </div>
                                                        <div id="item2" class="tab-pane fade">
                                                            <img src="{{asset('storage/products/'.$product->image1)}}" alt="img">
                                                        </div>
                                                        <div id="item3" class="tab-pane fade">
                                                            <img src="{{asset('storage/products/'.$product->image2)}}" alt="img">
                                                        </div>
                                                        <div id="item4" class="tab-pane fade">
                                                            <img src="{{asset('storage/products/'.$product->image3)}}" alt="img">
                                                        </div>
                                                        <div class="layer hidden-sm-down" data-toggle="modal" data-target="#product-modal">
                                                            <i class="fa fa-expand"></i>
                                                        </div>
                                                    </div>
                                                    <ul class="product-tab nav nav-tabs d-flex">
                                                        <li class="active col">
                                                            <a href="#item1" data-toggle="tab" aria-expanded="true" class="active show">
                                                                <img src="{{asset('storage/products/'.$product->image)}}" alt="img">
                                                            </a>
                                                        </li>
                                                        <li class="col">
                                                            <a href="#item2" data-toggle="tab">
                                                                <img src="{{asset('storage/products/'.$product->image1)}}" alt="img">
                                                            </a>
                                                        </li>
                                                        <li class="col">
                                                            <a href="#item3" data-toggle="tab">
                                                                <img src="{{asset('storage/products/'.$product->image2)}}" alt="img">
                                                            </a>
                                                        </li>
                                                        <li class="col">
                                                            <a href="#item4" data-toggle="tab">
                                                                <img src="{{asset('storage/products/'.$product->image3)}}" alt="img">
                                                            </a>
                                                        </li>
                                                    </ul>
                                                    <div class="modal fade" id="product-modal" role="dialog">
                                                        <div class="modal-dialog">

                                                            <!-- Modal content-->
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <div class="modal-body">
                                                                        <div class="product-detail">
                                                                            <div>
                                                                                <div class="images-container">
                                                                                    <div class="js-qv-mask mask tab-content">
                                                                                        <div id="modal-item1" class="tab-pane fade active in show">
                                                                                            <img src="{{asset('storage/products/'.$product->image)}}" alt="img">
                                                                                        </div>
                                                                                        <div id="modal-item2" class="tab-pane fade">
                                                                                            <img src="{{asset('storage/products/'.$product->image1)}}" alt="img">
                                                                                        </div>
                                                                                        <div id="modal-item3" class="tab-pane fade">
                                                                                            <img src="{{asset('storage/products/'.$product->image2)}}" alt="img">
                                                                                        </div>
                                                                                        <div id="modal-item4" class="tab-pane fade">
                                                                                            <img src="{{asset('storage/products/'.$product->image3)}}" alt="img">
                                                                                        </div>
                                                                                    </div>
                                                                                    <ul class="product-tab nav nav-tabs">
                                                                                        <li class="active">
                                                                                            <a href="#modal-item1" data-toggle="tab" class=" active show">
                                                                                                <img src="{{asset('storage/products/'.$product->image)}}" alt="img">
                                                                                            </a>
                                                                                        </li>
                                                                                        <li>
                                                                                            <a href="#modal-item2" data-toggle="tab">
                                                                                                <img src="{{asset('storage/products/'.$product->image1)}}" alt="img">
                                                                                            </a>
                                                                                        </li>
                                                                                        <li>
                                                                                            <a href="#modal-item3" data-toggle="tab">
                                                                                                <img src="{{asset('storage/products/'.$product->image2)}}" alt="img">
                                                                                            </a>
                                                                                        </li>
                                                                                        <li>
                                                                                            <a href="#modal-item4" data-toggle="tab">
                                                                                                <img src="{{asset('storage/products/'.$product->image3)}}" alt="img">
                                                                                            </a>
                                                                                        </li>
                                                                                    </ul>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="product-info col-xs-12 col-md-7 col-sm-7">
                                            <div class="detail-description">
                                                <div class="price-del">
                                                    <span class="price">{{number_format($product->sale, 0, ',', '.')}} VND</span>
                                                    <del class="regular-price">{{number_format($product->price, 0, ',', '.')}} VND</del>
                                                    <span class="float-right">
                                                        <span class="availb">Tình trạng: </span>
                                                        <span class="check">
                                                            <i class="fa fa-check-square-o" aria-hidden="true"></i>CÒN HÀNG</span>
                                                    </span>
                                                </div>
                                                <p class="description">{{$product->description}}</p>
                                                <div class="has-border cart-area">
                                                    <div class="product-quantity">
                                                        <form id="add-product-form">
                                                            <div class="qty">
                                                                <div class="input-group">
                                                                    <div class="quantity">
                                                                        <span class="control-label">Số lượng : </span>
                                                                        <input type="hidden" id="id" value="{{$product->id}}" class="input-group form-control">
                                                                        <input type="hidden" id="title" value="{{$product->title}}" class="input-group form-control">
                                                                        <input type="hidden" id="price" value="{{$product->price}}" class="input-group form-control">
                                                                        <input type="hidden" id="sale" value="{{$product->sale}}" class="input-group form-control">
                                                                        <input type="hidden" id="image" value="{{$product->image}}" class="input-group form-control">
                                                                        <input type="text" name="qty" id="quantity" value="1" class="input-group form-control">
                                                                        <span class="input-group-btn-vertical">
                                                                            <button class="btn btn-touchspin js-touchspin bootstrap-touchspin-up" type="button">+</button>
                                                                            <button class="btn btn-touchspin js-touchspin bootstrap-touchspin-down" type="button">-</button>
                                                                        </span>
                                                                    </div>
                                                                    <span class="add">
                                                                        <button class="btn btn-primary add-to-cart add-item" data-button-action="add-to-cart" type="submit">
                                                                            <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                                                            <span>Thêm vào giỏ hàng</span>
                                                                        </button>
                                                                        <a class="addToWishlist" href="#">
                                                                            <i class="fa fa-heart" aria-hidden="true"></i>
                                                                        </a>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                    <div class="clearfix"></div>
                                                    <p class="product-minimal-quantity">
                                                    </p>
                                                </div>
                                                <div class="d-flex2 has-border">
                                                    <div class="btn-group">
                                                        <a href="#">
                                                            <i class="zmdi zmdi-share"></i>
                                                            <span>Chia sẻ</span>
                                                        </a>
                                                        <a href="#" class="email">
                                                            <i class="fa fa-envelope" aria-hidden="true"></i>
                                                            <span>Gửi cho bạn</span>
                                                        </a>
                                                        <a href="#" class="print">
                                                            <i class="zmdi zmdi-print"></i>
                                                            <span>In</span>
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="rating-comment has-border d-flex">
                                                    <div class="review-description d-flex">
                                                        <span>Đánh giá :</span>
                                                        <div class="rating">
                                                            <div class="star-content">
                                                                <div class="star"></div>
                                                                <div class="star"></div>
                                                                <div class="star"></div>
                                                                <div class="star"></div>
                                                                <div class="star"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="read after-has-border">
                                                        <a href="#review">
                                                            <i class="fa fa-commenting-o color" aria-hidden="true"></i>
                                                            <span>Lượt đánh giá (3)</span>
                                                        </a>
                                                    </div>
                                                    <div class="apen after-has-border">
                                                        <a href="#review">
                                                            <i class="fa fa-pencil color" aria-hidden="true"></i>
                                                            <span>Viết đánh giá</span>
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="content">
                                                    <p>Danh mục :
                                                        <span class="content2">
                                                            @foreach($categories as $cate)
                                                            @if($product->category_id===$cate->id)
                                                            <a href="{{ route('product.categories',$cate->id) }}">{{$cate->name}}</a>
                                                            @endif
                                                            @endforeach
                                                        </span>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="review">
                                        <ul class="nav nav-tabs">
                                            <li class="active">
                                                <a data-toggle="tab" href="#description" class="active show">Mô tả</a>
                                            </li>
                                            <li>
                                                <a data-toggle="tab" href="#review">Đánh giá (2)</a>
                                            </li>
                                        </ul>

                                        <div class="tab-content">
                                            <div id="description" class="tab-pane fade in active show">
                                                <p>
                                                    {{$product->detail}}
                                                </p>
                                            </div>

                                            <div id="review" class="tab-pane fade">
                                                <div class="spr-form">
                                                    <div class="user-comment">
                                                        <div class="spr-review">
                                                            <div class="spr-review-header">
                                                                <span class="spr-review-header-byline">
                                                                    <strong>Peter Capidal</strong> -
                                                                    <span>Apr 14, 2018</span>
                                                                </span>
                                                                <div class="rating">
                                                                    <div class="star-content">
                                                                        <div class="star"></div>
                                                                        <div class="star"></div>
                                                                        <div class="star"></div>
                                                                        <div class="star"></div>
                                                                        <div class="star"></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="spr-review-content">
                                                                <p class="spr-review-content-body">In feugiat venenatis enim, non finibus metus bibendum
                                                                    eu. Proin massa justo, eleifend fermentum varius
                                                                    quis, semper gravida quam. Cras nec enim sed
                                                                    lacus viverra luctus. Nunc quis accumsan mauris.
                                                                    Aliquam fermentum sit amet est id scelerisque.
                                                                    Nam porta risus metus.</p>
                                                            </div>
                                                        </div>
                                                        <div class="spr-review preview2">
                                                            <div class="spr-review-header">
                                                                <span class="spr-review-header-byline">
                                                                    <strong>David James</strong> -
                                                                    <span>Apr 13, 2018</span>
                                                                </span>
                                                                <div class="rating">
                                                                    <div class="star-content">
                                                                        <div class="star"></div>
                                                                        <div class="star"></div>
                                                                        <div class="star"></div>
                                                                        <div class="star"></div>
                                                                        <div class="star"></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="spr-review-content">
                                                                <p class="spr-review-content-body">In feugiat venenatis enim, non finibus metus bibendum
                                                                    eu. Proin massa justo, eleifend fermentum varius
                                                                    quis, semper gravida quam. Cras nec enim sed
                                                                    lacus viverra luctus. Nunc quis accumsan mauris.
                                                                    Aliquam fermentum sit amet est id scelerisque.
                                                                    Nam porta risus metus.</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <form method="post" action="#" class="new-review-form">
                                                    <input type="hidden" name="review[rating]" value="3">
                                                    <input type="hidden" name="product_id">
                                                    <h3 class="spr-form-title">Write a review</h3>
                                                    <fieldset>
                                                        <div class="spr-form-review-rating">
                                                            <label class="spr-form-label">Your Rating</label>
                                                            <fieldset class="ratings">
                                                                <input type="radio" id="star5" name="rating" value="5" />
                                                                <label class="full" for="star5" title="Awesome - 5 stars"></label>
                                                                <input type="radio" id="star4half" name="rating" value="4 and a half" />
                                                                <input type="radio" id="star4" name="rating" value="4" />
                                                                <label class="full" for="star4" title="Pretty good - 4 stars"></label>
                                                                <input type="radio" id="star3half" name="rating" value="3 and a half" />
                                                                <input type="radio" id="star3" name="rating" value="3" />
                                                                <label class="full" for="star3" title="Meh - 3 stars"></label>
                                                                <input type="radio" id="star2half" name="rating" value="2 and a half" />
                                                                <input type="radio" id="star2" name="rating" value="2" />
                                                                <label class="full" for="star2" title="Kinda bad - 2 stars"></label>
                                                                <input type="radio" id="star1half" name="rating" value="1 and a half" />
                                                                <input type="radio" id="star1" name="rating" value="1" />
                                                                <label class="full" for="star1" title="Sucks big time - 1 star"></label>
                                                                <input type="radio" id="starhalf" name="rating" value="half" />
                                                            </fieldset>
                                                        </div>
                                                    </fieldset>
                                                    <fieldset class="spr-form-contact">
                                                        <div class="spr-form-contact-name">
                                                            <input class="spr-form-input spr-form-input-text form-control" value="" placeholder="Enter your name">
                                                        </div>
                                                        <div class="spr-form-contact-email">
                                                            <input class="spr-form-input spr-form-input-email form-control" value="" placeholder="Enter your email">
                                                        </div>
                                                    </fieldset>
                                                    <fieldset>
                                                        <div class="spr-form-review-body">
                                                            <div class="spr-form-input">
                                                                <textarea class="spr-form-input-textarea" rows="10" placeholder="Write your comments here"></textarea>
                                                            </div>
                                                        </div>
                                                    </fieldset>
                                                    <div class="submit">
                                                        <input type="submit" name="addComment" id="submitComment" class="btn btn-default" value="Submit Review">
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="related">
                                        <div class="title-tab-content  text-center">
                                            <div class="title-product justify-content-start">
                                                <h2>Sản phẩm tương tự</h2>
                                            </div>
                                        </div>
                                        <div class="tab-content">
                                            <div class="row">
                                                @foreach($sameproducts as $pro)
                                                <div class="item text-center col-md-4">
                                                    <div class="product-miniature js-product-miniature item-one first-item">
                                                        <div class="thumbnail-container border border">
                                                            <a href="{{ route('product.detail',$pro->id) }}">
                                                                <img class="img-fluid image-cover" src="{{asset('storage/products/'.$pro->image)}}" alt="img">
                                                                <img class="img-fluid image-secondary" src="{{asset('storage/products/'.$pro->image1)}}" alt="img">
                                                            </a>
                                                            <div class="highlighted-informations">
                                                                <div class="variant-links">
                                                                    <a href="#" class="color beige" title="Beige"></a>
                                                                    <a href="#" class="color orange" title="Orange"></a>
                                                                    <a href="#" class="color green" title="Green"></a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="product-description">
                                                            <div class="product-groups">
                                                                <div class="product-title">
                                                                    <a href="{{ route('product.detail',$pro->id) }}">{{$pro->title}}</a>
                                                                </div>
                                                                <div class="rating">
                                                                    <div class="star-content">
                                                                        <div class="star"></div>
                                                                        <div class="star"></div>
                                                                        <div class="star"></div>
                                                                        <div class="star"></div>
                                                                        <div class="star"></div>
                                                                    </div>
                                                                </div>
                                                                <div class="product-group-price">
                                                                    <div class="product-price-and-shipping">
                                                                        <span class="price">{{number_format($pro->sale, 0, ',', '.')}} VND</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="product-buttons d-flex justify-content-center">
                                                                <form action="#" method="post" class="formAddToCart">
                                                                    <a class="add-to-cart" href="#" data-button-action="add-to-cart">
                                                                        <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                                                    </a>
                                                                </form>
                                                                <a class="addToWishlist" href="#" data-rel="1" onclick="">
                                                                    <i class="fa fa-heart" aria-hidden="true"></i>
                                                                </a>
                                                                <a href="#" class="quick-view hidden-sm-down" data-link-action="quickview">
                                                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection