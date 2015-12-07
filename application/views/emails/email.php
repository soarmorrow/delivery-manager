<html>
<head>
<link href='https://fonts.googleapis.com/css?family=Roboto:400,500,700' rel='stylesheet' type='text/css'>
</head>
<body>

	Hello <strong><?= $username ?>,</strong>
	<p>
		An account has been created with this email on 'collection App'.Please verify
		the link to confirm and activate your account.
	</p>
	<a style="padding: 5px 10px;border: 1px solid rgba(0,0,0,0.1);background-color: #4d90fe;background-image: -moz-linear-gradient(center top , #4d90fe, #4787ed);border-color: #3079ed;display: inline-block;margin: 10px auto;text-decoration: none;color: #fff;font-weight: 600;font-size: 20px;border-radius: 2px;box-shadow: 1px 3px 7px 0px rgba(0, 0, 0, 0.2);text-shadow: 1px 3px 7px rgba(0, 0, 0, 0.2);" href="<?= $activation_link ?>">Activate your account</a>
	<p>
		If your button doesn'nt work copy and paste below link on your browser<br />
		<a href="<?=$activation_link ?>"><?=$activation_link ?></a><br />
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