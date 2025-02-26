@extends('main')
@section('content')
<body class="animsition" style="animation-duration: 1500ms; opacity: 1;">
	<section class="bg-img1 txt-center p-lr-15 p-tb-92" style="background-image: url('/template/images/bg-01.jpg');">
		<h2 class="ltext-105 cl0 txt-center">
			{{ __('messages.Contact') }}

		</h2>
	</section>	

	<section class="bg0 p-t-104 p-b-116">
		<div class="container">
			<div class="flex-w flex-tr">
				<div class="size-210 bor10 p-lr-70 p-t-55 p-b-70 p-lr-15-lg w-full-md">
					@if(session('success'))
						<div class="alert alert-success">
							{{ session('success') }}
						</div>
					@endif

					<form method="POST" action="{{ route('contact.send') }}">
						@csrf
						<h4 class="mtext-105 cl2 txt-center p-b-30">
							{{ __('messages.Send') }}

						</h4>

						<div class="bor8 m-b-20 how-pos4-parent">
							<input class="stext-111 cl2 plh3 size-116 p-l-62 p-r-30" type="text" name="email" placeholder="{{ __('messages.YEA') }}" required>
							<img class="how-pos4 pointer-none" src="/template/images/icons/icon-email.png" alt="ICON">
						</div>

						<div class="bor8 m-b-30">
							<textarea class="stext-111 cl2 plh3 size-120 p-lr-28 p-tb-25" name="msg" placeholder="{{ __('messages.Can_We') }}" required></textarea>
						</div>

						<button type="submit" class="flex-c-m stext-101 cl0 size-121 bg3 bor1 hov-btn3 p-lr-15 trans-04 pointer">
							{{ __('messages.SUBMIT') }}

						</button>
					</form>
				</div>

				<div class="size-210 bor10 flex-w flex-col-m p-lr-93 p-tb-30 p-lr-15-lg w-full-md">
					<!-- Contact Information -->
					<div class="flex-w w-full p-b-42">
						<span class="fs-18 cl5 txt-center size-211">
							<span class="lnr lnr-map-marker"></span>
						</span>
						<div class="size-212 p-t-2">
							<span class="mtext-110 cl2">{{ __('messages.Address') }}</span>
							<p class="stext-115 cl6 size-213 p-t-18">{{ __('messages.CS') }}</p>
						</div>
					</div>
					<div class="flex-w w-full p-b-42">
						<span class="fs-18 cl5 txt-center size-211">
							<span class="lnr lnr-phone-handset"></span>
						</span>
						<div class="size-212 p-t-2">
							<span class="mtext-110 cl2">{{ __('messages.Talk') }}</span>
							<p class="stext-115 cl1 size-213 p-t-18">+1 800 1236879</p>
						</div>
					</div>
					<div class="flex-w w-full">
						<span class="fs-18 cl5 txt-center size-211">
							<span class="lnr lnr-envelope"></span>
						</span>
						<div class="size-212 p-t-2">
							<span class="mtext-110 cl2">{{ __('messages.Sale_Support') }}</span>
							<p class="stext-115 cl1 size-213 p-t-18">contact@example.com</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
@endsection
