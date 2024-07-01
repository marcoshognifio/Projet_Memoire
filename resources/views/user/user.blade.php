<!DOCTYPE html>
<html lang="fr">

	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>@yield('title') | User</title>
	</head>

	<body>
			<div class="container">

				@if(session('success'))

					<div>
						{{ session('success') }} 
					</div>

				@endif

				@if(session('success_use'))

					<div>
						{{ session('success_use') }} 
					</div>

				@endif

				@yield('content')
			</div>
	</body>
</html>