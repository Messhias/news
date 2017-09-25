<div>
	Hello {{ $username }},

	<br>

	Please the link below to activate your link.

	<br>

	<a href="{{ url('activate/'.Crypt::encrypt($email)."/".Crypt::encrypt($username)) }}">
		<strong>
			Active my account.
		</strong>
	</a>

</div>