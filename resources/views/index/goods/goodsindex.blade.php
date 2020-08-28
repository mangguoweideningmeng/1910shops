@extends('layout.shop')
@section('title','主页')
@section('content')

	<!-- navbar top -->
	@include('layout.top')
	<!-- end navbar top -->

	<!-- side nav right-->
	@include('layout.navright')
	<!-- end side nav right-->

	<!-- navbar bottom -->
	@include('layout.bottom')
	<!-- end navbar bottom -->

	<!-- menu -->
	<div class="menus" id="animatedModal2">
		<div class="close-animatedModal2 close-icon">
			<i class="fa fa-close"></i>
		</div>
		<div class="modal-content">
			<div class="container">
				<div class="row">
					<div class="col s4">
						<a href="index.html" class="button-link">
							<div class="menu-link">
								<div class="icon">
									<i class="fa fa-home"></i>
								</div>
								Home
							</div>
						</a>
					</div>
					<div class="col s4">
						<a href="product-list.html" class="button-link">
							<div class="menu-link">
								<div class="icon">
									<i class="fa fa-bars"></i>
								</div>
								Product List
							</div>
						</a>
					</div>
					<div class="col s4">
						<a href="shop-single.html" class="button-link">
							<div class="menu-link">
								<div class="icon">
									<i class="fa fa-eye"></i>
								</div>
								Single Shop
							</div>
						</a>
					</div>
				</div>
				<div class="row">
					<div class="col s4">
						<a href="wishlist.html" class="button-link">
							<div class="menu-link">
								<div class="icon">
									<i class="fa fa-heart"></i>
								</div>
								Wishlist
							</div>
						</a>
					</div>
					<div class="col s4">
						<a href="cart.html" class="button-link">
							<div class="menu-link">
								<div class="icon">
									<i class="fa fa-shopping-cart"></i>
								</div>
								Cart
							</div>
						</a>
					</div>
					<div class="col s4">
						<a href="checkout.html" class="button-link">
							<div class="menu-link">
								<div class="icon">
									<i class="fa fa-credit-card"></i>
								</div>
								Checkout
							</div>
						</a>
					</div>
				</div>
				<div class="row">
					<div class="col s4">
						<a href="blog.html" class="button-link">
							<div class="menu-link">
								<div class="icon">
									<i class="fa fa-bold"></i>
								</div>
								Blog
							</div>
						</a>
					</div>
					<div class="col s4">
						<a href="blog-single.html" class="button-link">
							<div class="menu-link">
								<div class="icon">
									<i class="fa fa-file-text-o"></i>
								</div>
								Blog Single
							</div>
						</a>
					</div>
					<div class="col s4">
						<a href="error404.html" class="button-link">
							<div class="menu-link">
								<div class="icon">
									<i class="fa fa-hourglass-half"></i>
								</div>
								404
							</div>
						</a>
					</div>
				</div>
				<div class="row">
					<div class="col s4">
						<a href="testimonial.html" class="button-link">
							<div class="menu-link">
								<div class="icon">
									<i class="fa fa-support"></i>
								</div>
								Testimonial
							</div>
						</a>
					</div>
					<div class="col s4">
						<a href="about-us.html" class="button-link">
							<div class="menu-link">
								<div class="icon">
									<i class="fa fa-user"></i>
								</div>
								About Us
							</div>
						</a>
					</div>
					<div class="col s4">
						<a href="contact.html" class="button-link">
							<div class="menu-link">
								<div class="icon">
									<i class="fa fa-envelope-o"></i>
								</div>
								Contact
							</div>
						</a>
					</div>
				</div>
				<div class="row">
					<div class="col s4">
						<a href="setting.html" class="button-link">
							<div class="menu-link">
								<div class="icon">
									<i class="fa fa-cog"></i>
								</div>
								Settings
							</div>
						</a>
					</div>
					<div class="col s4">
						<a href="login.html" class="button-link">
							<div class="menu-link">
								<div class="icon">
									<i class="fa fa-sign-in"></i>
								</div>
								Login
							</div>
						</a>
					</div>
					<div class="col s4">
						<a href="register.html" class="button-link">
							<div class="menu-link">
								<div class="icon">
									<i class="fa fa-user-plus"></i>
								</div>
								Register
							</div>
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end menu -->

	<!-- cart menu -->

	<!-- end cart menu -->

	<!-- slider -->
	<div class="slider">

		<ul class="slides">
			<li>
				<img src="https://timgsa.baidu.com/timg?image&quality=80&size=b9999_10000&sec=1597379463351&di=96f640a639f2474454b0ac54fccf1819&imgtype=0&src=http%3A%2F%2Fb-ssl.duitang.com%2Fuploads%2Fitem%2F201610%2F17%2F20161017235346_ymCWV.jpeg" alt="">
				<div class="caption slider-content  center-align">
					<h2>WELCOME TO MSTORE</h2>
					<h4>Lorem ipsum dolor sit amet.</h4>
					<a href="{{url('index/goodsshop')}}" class="btn button-default">SHOP NOW</a>
				</div>
			</li>
			<li>
				<img src="https://ss0.bdstatic.com/70cFuHSh_Q1YnxGkpoWK1HF6hhy/it/u=702835865,3126427433&fm=15&gp=0.jpg" alt="">
				<div class="caption slider-content center-align">
					<h2>JACKETS BUSINESS</h2>
					<h4>Lorem ipsum dolor sit amet.</h4>
					<a href="{{url('index/goodsshop')}}" class="btn button-default">SHOP NOW</a>
				</div>
			</li>
			<li>
				<img src="https://timgsa.baidu.com/timg?image&quality=80&size=b9999_10000&sec=1597379716277&di=77739d156b52544ee336e4c7e00b275e&imgtype=0&src=http%3A%2F%2Fhbimg.b0.upaiyun.com%2F36cdae8fee1f3ccee63827bfaab53a3b240af22a235c2-waDvMX_fw658" alt="">
				<div class="caption slider-content center-align">
					<h2>FASHION SHOP</h2>
					<h4>Lorem ipsum dolor sit amet.</h4>
					<a href="{{url('index/goodsshop')}}" class="btn button-default">SHOP NOW</a>
				</div>
			</li>
		</ul>

	</div>
	<!-- end slider -->

	<!-- features -->
	<!-- end features -->

	<!-- quote -->
	<div class="section quote">
		<div class="container">
			<h4>FASHION UP TO 50% OFF</h4>
			<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquid ducimus illo hic iure eveniet</p>
		</div>
	</div>
	<!-- end quote -->

	<!-- product -->
	<div class="section product">
		<div class="container">
			<div class="section-head">
				<h4>ALL PRODUCT</h4>
				<div class="divider-top"></div>
				<div class="divider-bottom"></div>
			</div>
			<div class="row margin-bottom">
				@foreach($res as $k=>$v)
				<div class="col s6">
					<div class="content">
						<a href="{{url('index/goodslists/'.$v->goods_id)}}"><img src="/upload/{{$v->goods_img}}" alt=""></a>
						<h6><a href="">{{$v->goods_name}}</a></h6>
						<div class="price">
							${{$v->goods_price}}
						</div>
						<button class="btn button-default">加入购物车</button>
					</div>
				</div>
				@endforeach
			</div>
		</div>
	</div>
	<!-- end product -->

	<!-- promo -->

	<!-- end promo -->

	<!-- product -->
	<div class="section product">
		<div class="container">
			<div class="section-head">
				<h4>NEW PRODUCT</h4>
				<div class="divider-top"></div>
				<div class="divider-bottom"></div>
			</div>
			<div class="row margin-bottom">
				@foreach($re as $k=>$v)
				<div class="col s6">
					<div class="content">
						<a href="{{url('index/goodslists/'.$v->goods_id)}}"><img src="/storage/{{$v->goods_img}}" alt=""></a>
						<h6><a href="">{{$v->goods_name}}</a></h6>
						<div class="price">
							${{$v->goods_price}}
						</div>
						<button class="btn button-default">加入购物车</button>
					</div>
				</div>
				@endforeach
			</div>

			<div class="section product">

	</div>
	<div class="pagination-product">
				<ul>
					{{$res->links()}}
				</ul>
			</div>
		</div>
	</div>
	<!-- end product -->

	<!-- loader -->
	<div id="fakeLoader"></div>
	<!-- end loader -->

	<!-- footer -->
	@include('layout.foot')
	<!-- end footer -->
	@endsection
