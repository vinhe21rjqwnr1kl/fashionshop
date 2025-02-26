
@extends('main')
@section('content')

	
	<!-- Header -->
	

	<!-- Cart -->






	<!-- Content page -->
	<section class="bg0 p-t-100 p-b-20">
		<div class="container">
			<div class="row">
				<div class="col-md-8 col-lg-9 p-b-80">
					<div class="p-r-45 p-r-0-lg">
						<!--  -->
						<div class="wrap-pic-w how-pos5-parent">
							<img src="{{ $blogs->thumb }}" alt="IMG-BLOG">

							<div class="flex-col-c-m size-123 bg9 how-pos5">
								<span class="ltext-107 cl2 txt-center">
									22
								</span>

								<span class="stext-109 cl3 txt-center">
									Jan 2018
								</span>
							</div>
						</div>

						<div class="p-t-32">
							<span class="flex-w flex-m stext-111 cl2 p-b-19">
								<span>
									<span class="cl4">By</span> Admin  
									<span class="cl12 m-l-4 m-r-6">|</span>
								</span>

								<span>
									22 Jan, 2018
									<span class="cl12 m-l-4 m-r-6">|</span>
								</span>

								<span>
									StreetStyle, Fashion, Couple  
									<span class="cl12 m-l-4 m-r-6">|</span>
								</span>

								<span>
									8 Comments
								</span>
							</span>

							<h4 class="ltext-109 cl2 p-b-28">
								{{ $blogs->title }}
							</h4>

							<p class="stext-117 cl6 p-b-26">
                                {!! $blogs->content !!}
							</p>

						
						</div>

						<div class="flex-w flex-t p-t-16">
							<span class="size-216 stext-116 cl8 p-t-4">
								Tags
							</span>

							<div class="flex-w size-217">
								<a href="#" class="flex-c-m stext-107 cl6 size-301 bor7 p-lr-15 hov-tag1 trans-04 m-r-5 m-b-5">
									Streetstyle
								</a>

								<a href="#" class="flex-c-m stext-107 cl6 size-301 bor7 p-lr-15 hov-tag1 trans-04 m-r-5 m-b-5">
									Crafts
								</a>
							</div>
						</div>

						<!--  -->
						<div class="p-t-40">
							<h5 class="mtext-113 cl2 p-b-12">
								Leave a Comment
							</h5>

							<p class="stext-107 cl6 p-b-40">
								Your email address will not be published. Required fields are marked *
							</p>

							<form action="/comment"method="POST">
                                @csrf
								<div class="bor19 m-b-20">
                                    <input type="text " hidden name="blog_id" value="{{ $blogs->id }}">
									<textarea  name="comment"  class="stext-111 cl2 plh3 size-124 p-lr-18 p-tb-15" name="cmt" placeholder="Comment..."></textarea>
								</div>


								<button type="submit" class="flex-c-m stext-101 cl0 size-125 bg3 bor2 hov-btn3 p-lr-15 trans-04">
									Post Comment
								</button>
							</form>
                            <div class="list_comment p-t-20">
                                 
                            </div>
						</div>
					</div>
				</div>

                <script>
            document.addEventListener('DOMContentLoaded', async () => {
    const apiUrl = '/list_comment/{{ $blogs->id }}'; // Đảm bảo URL chính xác cho API
    const list = document.querySelector('.list_comment');

    try {
        // Gọi dữ liệu từ API
        const response = await fetch(apiUrl, {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json',
            },
        });

        // Kiểm tra xem API có trả về thành công không
        if (!response.ok) {
            throw new Error('Lỗi khi tải dữ liệu');
        }

        // Chuyển dữ liệu trả về thành JSON
        const data = await response.json();
        console.log(data); // Kiểm tra dữ liệu trả về

        // Xóa nội dung cũ trước khi thêm nội dung mới
        list.innerHTML = '';

        // Kiểm tra nếu có dữ liệu
        if (data && data.length > 0) {
            // Duyệt qua mảng dữ liệu và thêm vào danh sách
            data.forEach(comment => {
                const listItem = document.createElement('div');
                listItem.className = 'container';

                // Tạo phần card cho bình luận
                const card = document.createElement('div');
                card.className = 'card';

                const cardBody = document.createElement('div');
                cardBody.className = 'card-body';

                const row = document.createElement('div');
                row.className = 'row';

                const col1 = document.createElement('div');
                col1.className = 'col-md-2';
                const img = document.createElement('img');
                
                // Kiểm tra thumb của người dùng và hiển thị ảnh
                img.src = comment.user.thumb ? comment.user.thumb : "https://image.ibb.co/jw55Ex/def_face.jpg"; // Nếu không có thumb, dùng ảnh mặc định
                img.className = 'img img-rounded img-fluid';
                const time = document.createElement('p');
                time.className = 'text-secondary text-center';
                time.textContent = '15 Minutes Ago'; // Bạn có thể thay thế bằng thời gian thực
                col1.appendChild(img);
                col1.appendChild(time);

                const col2 = document.createElement('div');
                col2.className = 'col-md-10';
                const nameLink = document.createElement('a');
                nameLink.className = 'float-left';
                nameLink.href = '#'; // Thêm link nếu cần
                const strongName = document.createElement('strong');
                strongName.textContent = comment.user.name; // Lấy tên người dùng từ API
                nameLink.appendChild(strongName);

                // Tạo phần stars
                const stars = document.createElement('span');
                stars.className = 'stars float-end';
                stars.innerHTML = `<i class="text-warning fa fa-star"></i>
                                    <i class="text-warning fa fa-star"></i>
                                    <i class="text-warning fa fa-star"></i>
                                    <i class="text-warning fa fa-star"></i>`; // Bạn có thể tùy chỉnh sao

                // Thêm nội dung bình luận dưới tên người dùng
                const commentText = document.createElement('p');
                commentText.textContent = comment.content; // Chắc chắn có trường "content" trong dữ liệu

                // Thêm các nút hành động (reply, like)
                const actionButtons = document.createElement('p');
                const replyBtn = document.createElement('a');
                replyBtn.className = 'float-right btn btn-outline-primary ml-2';
                replyBtn.href = '#'; // Thêm link cho chức năng reply nếu cần
                replyBtn.innerHTML = '<i class="fa fa-reply"></i> Reply';
                const likeBtn = document.createElement('a');
                likeBtn.className = 'float-right btn text-white btn-danger';
                likeBtn.href = '#'; // Thêm link cho chức năng like nếu cần
                likeBtn.innerHTML = '<i class="fa fa-heart"></i> Like';

                actionButtons.appendChild(replyBtn);
                actionButtons.appendChild(likeBtn);

                col2.appendChild(nameLink); // Đây là phần hiển thị tên người dùng
                col2.appendChild(stars);    // Phần hiển thị sao
                col2.appendChild(commentText); // Phần hiển thị nội dung bình luận
                col2.appendChild(actionButtons);

                row.appendChild(col1);
                row.appendChild(col2);

                cardBody.appendChild(row);
                card.appendChild(cardBody);

                listItem.appendChild(card);
                list.appendChild(listItem);
            });
        } else {
            // Nếu không có dữ liệu
            list.innerHTML = '<li>Không có bình luận nào.</li>';
        }
    } catch (error) {
        console.error('Error:', error);
        list.innerHTML = '<li>Không thể tải dữ liệu. Vui lòng thử lại sau.</li>';
    }
});

                </script>
                
                                            <style>
                                /* Đảm bảo rằng phần stars được căn phải */
                            .col-md-10 {
                                display: flex;
                                flex-direction: column; /* Đảm bảo các phần tử trong cột này xếp chồng lên nhau */
                            }

                            .stars {
                                margin-top: 10px;
                                margin-left: auto;  /* Đảm bảo stars nằm bên phải */
                                display: inline-block;  /* Đảm bảo stars nằm trên một dòng riêng biệt */
                            }


                                            </style>
                
                
				<div class="col-md-4 col-lg-3 p-b-80">
					<div class="side-menu">
						<div class="bor17 of-hidden pos-relative">
							<input class="stext-103 cl2 plh4 size-116 p-l-28 p-r-55" type="text" name="search" placeholder="Search">

							<button class="flex-c-m size-122 ab-t-r fs-18 cl4 hov-cl1 trans-04">
								<i class="zmdi zmdi-search"></i>
							</button>
						</div>

						<div class="p-t-55">
							<h4 class="mtext-112 cl2 p-b-33">
								Categories
							</h4>

							<ul>
								<li class="bor18">
									<a href="#" class="dis-block stext-115 cl6 hov-cl1 trans-04 p-tb-8 p-lr-4">
										Fashion
									</a>
								</li>

							
							</ul>
						</div>

						<div class="p-t-65">
							<h4 class="mtext-112 cl2 p-b-33">
								Featured Products
							</h4>

							<ul>
								<li class="flex-w flex-t p-b-30">
									<a href="#" class="wrao-pic-w size-214 hov-ovelay1 m-r-20">
										<img src="/template/images/product-min-01.jpg" alt="PRODUCT">
									</a>

									<div class="size-215 flex-col-t p-t-8">
										<a href="#" class="stext-116 cl8 hov-cl1 trans-04">
											White Shirt With Pleat Detail Back
										</a>

										<span class="stext-116 cl6 p-t-20">
											$19.00
										</span>
									</div>
								</li>

								<li class="flex-w flex-t p-b-30">
									<a href="#" class="wrao-pic-w size-214 hov-ovelay1 m-r-20">
										<img src="/template/images/product-min-02.jpg" alt="PRODUCT">
									</a>

									<div class="size-215 flex-col-t p-t-8">
										<a href="#" class="stext-116 cl8 hov-cl1 trans-04">
											Converse All Star Hi Black Canvas
										</a>

										<span class="stext-116 cl6 p-t-20">
											$39.00
										</span>
									</div>
								</li>

								<li class="flex-w flex-t p-b-30">
									<a href="#" class="wrao-pic-w size-214 hov-ovelay1 m-r-20">
										<img src="/template/images/product-min-03.jpg" alt="PRODUCT">
									</a>

									<div class="size-215 flex-col-t p-t-8">
										<a href="#" class="stext-116 cl8 hov-cl1 trans-04">
											Nixon Porter Leather Watch In Tan
										</a>

										<span class="stext-116 cl6 p-t-20">
											$17.00
										</span>
									</div>
								</li>
							</ul>
						</div>

						<div class="p-t-55">
							<h4 class="mtext-112 cl2 p-b-20">
								Archive
							</h4>

							<ul>
								<li class="p-b-7">
									<a href="#" class="flex-w flex-sb-m stext-115 cl6 hov-cl1 trans-04 p-tb-2">
										<span>
											July 2018
										</span>

										<span>
											(9)
										</span>
									</a>
								</li>

								<li class="p-b-7">
									<a href="#" class="flex-w flex-sb-m stext-115 cl6 hov-cl1 trans-04 p-tb-2">
										<span>
											June 2018
										</span>

										<span>
											(39)
										</span>
									</a>
								</li>

								<li class="p-b-7">
									<a href="#" class="flex-w flex-sb-m stext-115 cl6 hov-cl1 trans-04 p-tb-2">
										<span>
											May 2018
										</span>

										<span>
											(29)
										</span>
									</a>
								</li>

								<li class="p-b-7">
									<a href="#" class="flex-w flex-sb-m stext-115 cl6 hov-cl1 trans-04 p-tb-2">
										<span>
											April  2018
										</span>

										<span>
											(35)
										</span>
									</a>
								</li>

								<li class="p-b-7">
									<a href="#" class="flex-w flex-sb-m stext-115 cl6 hov-cl1 trans-04 p-tb-2">
										<span>
											March 2018
										</span>

										<span>
											(22)
										</span>
									</a>
								</li>

								<li class="p-b-7">
									<a href="#" class="flex-w flex-sb-m stext-115 cl6 hov-cl1 trans-04 p-tb-2">
										<span>
											February 2018
										</span>

										<span>
											(32)
										</span>
									</a>
								</li>

								<li class="p-b-7">
									<a href="#" class="flex-w flex-sb-m stext-115 cl6 hov-cl1 trans-04 p-tb-2">
										<span>
											January 2018
										</span>

										<span>
											(21)
										</span>
									</a>
								</li>

								<li class="p-b-7">
									<a href="#" class="flex-w flex-sb-m stext-115 cl6 hov-cl1 trans-04 p-tb-2">
										<span>
											December 2017
										</span>

										<span>
											(26)
										</span>
									</a>
								</li>
							</ul>
						</div>

						<div class="p-t-50">
							<h4 class="mtext-112 cl2 p-b-27">
								Tags
							</h4>

							<div class="flex-w m-r--5">
								<a href="#" class="flex-c-m stext-107 cl6 size-301 bor7 p-lr-15 hov-tag1 trans-04 m-r-5 m-b-5">
									Fashion
								</a>

								<a href="#" class="flex-c-m stext-107 cl6 size-301 bor7 p-lr-15 hov-tag1 trans-04 m-r-5 m-b-5">
									Lifestyle
								</a>

								<a href="#" class="flex-c-m stext-107 cl6 size-301 bor7 p-lr-15 hov-tag1 trans-04 m-r-5 m-b-5">
									Denim
								</a>

								<a href="#" class="flex-c-m stext-107 cl6 size-301 bor7 p-lr-15 hov-tag1 trans-04 m-r-5 m-b-5">
									Streetstyle
								</a>

								<a href="#" class="flex-c-m stext-107 cl6 size-301 bor7 p-lr-15 hov-tag1 trans-04 m-r-5 m-b-5">
									Crafts
								</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>	
    <script>

    </script>
	@endsection
		

