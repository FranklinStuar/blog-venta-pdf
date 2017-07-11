<?php

return array(
	# Account credentials from developer portal
	'Account' => array(
		'ClientId' => env('PAYPAL_CLIENT_ID', 'AS5KH5wQ2W1txXFHo7RecAwZR3B0M_wa9AJbF2fj8iPIvKeBzcQziqE4R1EnJBgjBlSHPfeQGehRjSha'),
		'ClientSecret' => env('PAYPAL_CLIENT_SECRET', 'EBvSqnpdWzD9TlFFsiSTk4o5Gafr28ktExutfvwY-en3_9SEup27itD-RtGjnb-6075weI60D_VPq5SI'),
	),

	# Connection Information
	'Http' => array(
		// 'ConnectionTimeOut' => 30,
		'Retry' => 1,
		//'Proxy' => 'http://[username:password]@hostname[:port][/path]',
	),

	# Service Configuration
	'Service' => array(
		# For integrating with the live endpoint,
		# change the URL to https://api.paypal.com!
		'EndPoint' => 'https://api.sandbox.paypal.com',
	),


	# Logging Information
	'Log' => array(
		//'LogEnabled' => true,

		# When using a relative path, the log file is created
		# relative to the .php file that is the entry point
		# for this request. You can also provide an absolute
		# path here
		'FileName' => '../PayPal.log',

		# Logging level can be one of FINE, INFO, WARN or ERROR
		# Logging is most verbose in the 'FINE' level and
		# decreases as you proceed towards ERROR
		//'LogLevel' => 'FINE',
	),

	# Define your application mode here
	'mode' => 'sandbox'
);
