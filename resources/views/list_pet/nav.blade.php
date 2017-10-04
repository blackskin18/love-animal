<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title></title>
	<link rel="stylesheet" href="">
	<style>
	*{ 
		margin:  0;
		border: 0;
		padding: 0;
	 }
	nav{
		width: 100%;
		height: 60px;
		background-color: black;
	}
	nav>div{
		width: 100%;
		height: 100%;
	}
	nav .logo-page {
		height: 100%;
		width: 30%;
		background-color: blue;
		display:  inline-block;
	}
	nav .search-box{
		height: 100%;
		width: 45%;
		background-color: red;
		display:  inline-block;
	}
	nav .avatar-user{
		height: 100%;
		width: 20%;
		background-color: green;
		display:  inline-block;
		float:  right;
	}
	</style>
</head>
<body>
	<div>
		<nav>
			<div>
				<div class="logo-page"> logo </div>
				<div class="search-box"> tìm kiếm </div>
				<div class="avatar-user"> ảnh </div>
			</div>
		</nav>
	 	@yield('content')
	</div>

</body>
</html>