<!DOCTYPE html>
<html>
<head>
 <title>Full text search</title>
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
 <style type="text/css">
 .box{
   width:600px;
   margin:0 auto;
}
</style>
</head>
<body>
 <br />
 <div class="container box">
    <h3 align="center">Gợi ý tìm kiếm fulltext search</h3><br />   
    <div class="form-group">
       <div class="header-search">
           <form method="POST" id="header-search">
           <input type="text" name="search" class="form-control m-input" placeholder="Enter Country Name"/>
           {{ csrf_field() }}
           </form>
       </div>
       <div id="search-suggest" class="s-suggest"></div>
   </div>
</div>
</div>
</body>
</html>

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