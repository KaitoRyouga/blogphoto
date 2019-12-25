<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Chụp Ảnh Kỷ Yếu</title>
	<link rel="stylesheet" href="lib/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="style.css">
	<link rel="stylesheet" href="font-awesome/css/all.css">

	<script type="text/javascript" src="lib/jquery-3.4.1.min.js"></script>
	{{-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/typeahead.js/0.11.1/typeahead.bundle.min.js"></script> --}}
	<script type="text/javascript" src="lib/popper.min.js"></script>
	<script type="text/javascript" src="lib/bootstrap/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="script.js"></script>

</head>
<body>
	<div class="chuatatca">
		<div class="header"> <!-- start header -->
			@include('layouts.elements.header')
		</div><!--  end header -->
		<div class="main-content"><!-- phần nội dung chính -->
			@yield('content')
		</div> <!-- end content -->
		<div class="footer"> <!-- bắt đầu footer -->
			@include('layouts.elements.footer')
		</div>  <!-- end footer -->
		<div class="back-to-top">
			<i class="fas fa-angle-double-up"></i>
		</div>
		<div class="search-box">
			<i class="fas fa-search"></i>
		</div>
		<form id="header-search" action="search/name">
			<div class="table-search-box">
				<span>&times;</span>
				<h3>TÌM KIẾM</h3>
				<input type="search" name="search" class="form-control m-input" placeholder="Nhập từ khóa..." autocomplete="off">
				<div id="search-suggest" class="s-suggest"></div>
				{{ csrf_field() }}
				<button>TÌM</button>
			</div>
		</form>
		
		<div class="nenmo">
		</div>
	</div>

<script type="text/javascript">
   $('#header-search').on('keyup', function() {
       var search = $(this).serialize();
       if ($(this).find('.m-input').val() == '') {
           $('#search-suggest div').hide();
       } else {
           $.ajax({
               url: '/search',
               type: 'POST',
               data: search,
           })
           .done(function(res) {
               $('#search-suggest').html('');
               $('#search-suggest').append(res)
           })
       };
   });
</script>

</body>
</html>