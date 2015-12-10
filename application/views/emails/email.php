<html>
<head>
<link href='https://fonts.googleapis.com/css?family=Roboto:400,500,700' rel='stylesheet' type='text/css'>
</head>
<body>

	Hello <strong><?= $username ?>,</strong>
	<p>
		An account has been created  on 'collection App'.
	</p>
	
	<p>
	
		If you haven't requested for an account kindly discard this message.<br /><br /><br />

		
		<strong>Your login details</strong>
		<table style="border-collapse:collapse;">
			<tr>
				<th style="padding:5px; border: 1px solid #aaa;">Username:</th>
				<td style="padding:5px; border: 1px solid #aaa;"><?= $username ?></td>
			</tr>
			<tr>
				<th style="padding:5px; border: 1px solid #aaa;">Password</th>
				<td style="padding:5px; border: 1px solid #aaa;"><?= $password ?></td>
			</tr>
		</table><br />
		Thank you<br />
		Collection team
	</p>
</body>
</html>