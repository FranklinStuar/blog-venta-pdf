<?php

return array(
	# Account credentials from developer portal
	'Account' => array(
		'ClientId' => env('PAYPAL_CLIENT_ID', 'AcC8mRJlk11crulA1H-x4lsWycK3l2xuk6FYqAHT90Yj18SVDzZ_2dCa3ZOn17D2-HoxweoyUlGHz6MG'),
		'ClientSecret' => env('PAYPAL_CLIENT_SECRET', 'EP8aAt2PX9gC4976hU7vmUO84g_mm1SrTBYzhjdzd-n96DvEf0knXNUkdgseSDJCvqeIbdP_8iRvpVRw'),
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
		// 'EndPoint' => 'https://api.paypal.com',
		'EndPoint' => env('PAYPAL_END_POINT','https://paypal.al.com')
	),


	# Logging Information
	'Log' => array(
		//'LogEnabled' => true,

		# When using a relative path, the log file is created
		# relative to the .php file that is the entry point
		# for this request. You can also provide an absolute
		# path here
		// 'FileName' => '../PayPal.log',

		# Logging level can be one of FINE, INFO, WARN or ERROR
		# Logging is most verbose in the 'FINE' level and
		# decreases as you proceed towards ERROR
		//'LogLevel' => 'FINE',
	),

	# Define your application mode here
	'mode' => env('PAYPAL_MODE','live')
);
