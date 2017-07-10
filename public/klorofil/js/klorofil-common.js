
$('.destroy').submit(function(evt){
		if (!confirm('Desea Eliminar')) {
			evt.preventDefault()
		}
   
})

// Validates that the input string is a valid date formatted as "mm/dd/yyyy"
function isValidDate(dateString){
  // First check for the pattern
  if(!/^\d{1,2}\/\d{1,2}\/\d{4}$/.test(dateString))
      return false;

  // Parse the date parts to integers
  var parts = dateString.split("/");
  var day = parseInt(parts[0], 10);
  var month = parseInt(parts[1], 10);
  var year = parseInt(parts[2], 10);

  // Check the ranges of month and year
  if(year < 2017 || year > 2050 || month == 0 || month > 12)
      return false;

  var monthLength = [ 31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31 ];

  // Adjust for leap years
  if(year % 400 == 0 || (year % 100 != 0 && year % 4 == 0))
      monthLength[1] = 29;

  // Check the range of the day
  return day > 0 && day <= monthLength[month - 1];
}


var toast_message=function(type,message){
		$().toastmessage('showToast', {
	    text     : "<p class='white-text'>"+message+"<p>",
	    stayTime : 7000,
	    sticky   : false,
	    type     : type
		});
}


$(document).ready(function() {

	$('.summernote').summernote({
		height: 300
	});



	/*-----------------------------------/
	/*	NEW PAY FOR PREMIUM POST
	/*----------------------------------*/

	if ($("#only-post-pay-edit").length > 0){
		axios.defaults.headers.common['X-CSRF-TOKEN'] = document.querySelector('#token').getAttribute('content')
		Vue.prototype.$http = axios
		url_ = document.querySelector('#url').getAttribute('content')
		url_pr = document.querySelector('#url-pr').getAttribute('content')
		url_py = document.querySelector('#url-py').getAttribute('content')
		
		new Vue({
			el:"#only-post-pay-edit",
			data:{
				post_id:null,
				post_once_price_id:null,
				once_prices:[],
				finish:null,
				price:null,
				status:null,
				method_payment:'cash',
				bank_deposit:null,
				account_deposit:null,
				number_deposit:null,
			},
			methods:{
				searchPayment(){
					var $post_once_price_id = null
					var $post_id = null
					this.$http.post(url_py)
					.then(response => {
						this.post_id = response.data.post_id
						this.price = response.data.price
						this.finish = response.data.finish
						this.price = response.data.price
						this.status = response.data.status
						this.method_payment = response.data.method_payment
						$post_once_price_id = response.data.post_once_price_id
						$post_id = response.data.post_id
						if(response.data.method_payment == 'deposit'){
							this.bank_deposit = response.data.bank_deposit
							this.account_deposit = response.data.account_deposit
							this.number_deposit = response.data.number_deposit
						}
				  	}, response => {
				    	toast_message('error','Problemas con el servidor al buscar los detalles del pago')
				  	});

					this.$http.post(url_,{pID:document.querySelector('#p').getAttribute('content')})
					.then(response => {
						this.once_prices = response.data
						this.post_once_price_id = document.querySelector('#pop').getAttribute('content')
				  	}, response => {
				    	toast_message('error','Problemas con el servidor al buscar los precios del post')
				  	});

				},
				selectPost(){
					this.$http.post(url_,{pID:this.post_id})
					.then(response => {
						this.once_prices = response.data
				  	}, response => {
				    	toast_message('error','Problemas con el servidor al buscar los precios del post')
				  	});
				},
				selectPostOncePrice(){
					this.$http.post(url_pr,{popID:this.post_once_price_id})
					.then(response => {
						console.log(response.data)
						this.finish = response.data.finish
						this.price = response.data.price
				  	}, response => {
					    toast_message('error','Problemas con el servidor al buscar el premium requerido')
					});
				},
			},
			created(){
				this.searchPayment()
			}
		})
	}
	else if ($("#only-post-pay-new").length > 0){
		axios.defaults.headers.common['X-CSRF-TOKEN'] = document.querySelector('#token').getAttribute('content')
		Vue.prototype.$http = axios
		url_ = document.querySelector('#url').getAttribute('content')
		url_pr = document.querySelector('#url-pr').getAttribute('content')

		new Vue({
			el:"#only-post-pay-new",
			data:{
				post_id:null,
				post_once_price_id:null,
				once_prices:[],
				finish:null,
				price:null,
				method_payment:'cash',
			},
			methods:{
				selectPost(){
					this.$http.post(url_,{pID:this.post_id})
					.then(response => {
						this.once_prices = response.data
				  	}, response => {
				    	toast_message('error','Problemas con el servidor al buscar los precios del post')
				  	});
				},
				selectPostOncePrice(){
					this.$http.post(url_pr,{popID:this.post_once_price_id})
					.then(response => {
						console.log(response.data)
						this.finish = response.data.finish
						this.price = response.data.price
				  }, response => {
				    toast_message('error','Problemas con el servidor al buscar el premium requerido')
				  });
				},
			},
		})
	}
	else if ($("#pay-sponsor-create").length > 0){
		axios.defaults.headers.common['X-CSRF-TOKEN'] = document.querySelector('#token').getAttribute('content')
		Vue.prototype.$http = axios
		url_ = document.querySelector('#url').getAttribute('content')

		new Vue({
			el:"#pay-sponsor-create",
			data:{
            	sponsor_price_id:null,
            	finish_date :null,
            	prints :null,
            	price_month :null,
			},
			methods:{
				selectSponsorPrice(){
					this.$http.post(url_,{spID:this.sponsor_price_id})
					.then(response => {
						this.finish_date = response.data.finish_date
						this.prints = response.data.prints
						this.price_month = response.data.price_month
				  }, response => {
				    toast_message('error','Problemas con el servidor al buscar el premium requerido')
				  });
						// toast_message('success','Nuevo cliente guardado satisfactoriamente satisfctoriamente')
				},
			},
		})
	}
	else if ($("#post-pay-create").length > 0){
		axios.defaults.headers.common['X-CSRF-TOKEN'] = document.querySelector('#token').getAttribute('content')
		Vue.prototype.$http = axios
		url_ = document.querySelector('#url').getAttribute('content')

		new Vue({
			el:"#post-pay-create",
			data:{
				post_price_id: null,
				price: '',
				role_id: null,
				method_payment: 'cash',
				finish: '',
			},
			methods:{
				selectPostPrice(){
					this.$http.post(url_,{ppID:this.post_price_id})
					.then(response => {
						this.price = response.data.price
						this.role_id = response.data.role_id
						this.finish = response.data.finish
				  }, response => {
				    toast_message('error','Problemas con el servidor al buscar el premium requerido')
				  });
						// toast_message('success','Nuevo cliente guardado satisfactoriamente satisfctoriamente')
				},
				save(evt){
					if(!isValidDate(this.finish)){
						evt.preventDefault()
				    toast_message('error','La fecha es incorrecta debe ser mayor a la fecha actual')
					}
				}
			},
		})
	}




	$('.select2').select2()

	/*-----------------------------------/
	/*	TOP NAVIGATION AND LAYOUT
	/*----------------------------------*/

	$('.btn-toggle-fullwidth').on('click', function() {
		if(!$('body').hasClass('layout-fullwidth')) {
			$('body').addClass('layout-fullwidth');

		} else {
			$('body').removeClass('layout-fullwidth');
			$('body').removeClass('layout-default'); // also remove default behaviour if set
		}

		$(this).find('.lnr').toggleClass('lnr-arrow-left-circle lnr-arrow-right-circle');

		if($(window).innerWidth() < 1025) {
			if(!$('body').hasClass('offcanvas-active')) {
				$('body').addClass('offcanvas-active');
			} else {
				$('body').removeClass('offcanvas-active');
			}
		}
	});

	$(window).on('load', function() {
		if($(window).innerWidth() < 1025) {
			$('.btn-toggle-fullwidth').find('.icon-arrows')
			.removeClass('icon-arrows-move-left')
			.addClass('icon-arrows-move-right');
		}

		// adjust right sidebar top position
		$('.right-sidebar').css('top', $('.navbar').innerHeight());

		// if page has content-menu, set top padding of main-content
		if($('.has-content-menu').length > 0) {
			$('.navbar + .main-content').css('padding-top', $('.navbar').innerHeight());
		}

		// for shorter main content
		if($('.main').height() < $('#sidebar-nav').height()) {
			$('.main').css('min-height', $('#sidebar-nav').height());
		}
	});


	/*-----------------------------------/
	/*	SIDEBAR NAVIGATION
	/*----------------------------------*/

	$('.sidebar a[data-toggle="collapse"]').on('click', function() {
		if($(this).hasClass('collapsed')) {
			$(this).addClass('active');
		} else {
			$(this).removeClass('active');
		}
	});

	if( $('.sidebar-scroll').length > 0 ) {
		$('.sidebar-scroll').slimScroll({
			height: '95%',
			wheelStep: 2,
		});
	}


	/*-----------------------------------/
	/*	PANEL FUNCTIONS
	/*----------------------------------*/

	// panel remove
	$('.panel .btn-remove').click(function(e){

		e.preventDefault();
		$(this).parents('.panel').fadeOut(300, function(){
			$(this).remove();
		});
	});

	// panel collapse/expand
	var affectedElement = $('.panel-body');

	$('.panel .btn-toggle-collapse').clickToggle(
		function(e) {
			e.preventDefault();

			// if has scroll
			if( $(this).parents('.panel').find('.slimScrollDiv').length > 0 ) {
				affectedElement = $('.slimScrollDiv');
			}

			$(this).parents('.panel').find(affectedElement).slideUp(300);
			$(this).find('i.lnr-chevron-up').toggleClass('lnr-chevron-down');
		},
		function(e) {
			e.preventDefault();

			// if has scroll
			if( $(this).parents('.panel').find('.slimScrollDiv').length > 0 ) {
				affectedElement = $('.slimScrollDiv');
			}

			$(this).parents('.panel').find(affectedElement).slideDown(300);
			$(this).find('i.lnr-chevron-up').toggleClass('lnr-chevron-down');
		}
	);


	/*-----------------------------------/
	/*	PANEL SCROLLING
	/*----------------------------------*/

	if( $('.panel-scrolling').length > 0) {
		$('.panel-scrolling .panel-body').slimScroll({
			height: '430px',
			wheelStep: 2,
		});
	}

	if( $('#panel-scrolling-demo').length > 0) {
		$('#panel-scrolling-demo .panel-body').slimScroll({
			height: '175px',
			wheelStep: 2,
		});
	}

	/*-----------------------------------/
	/*	TODO LIST
	/*----------------------------------*/

	$('.todo-list input').change( function() {
		if( $(this).prop('checked') ) {
			$(this).parents('li').addClass('completed');
		}else {
			$(this).parents('li').removeClass('completed');
		}
	});


	/*-----------------------------------/
	/* TOASTR NOTIFICATION
	/*----------------------------------*/

	if($('#toastr-demo').length > 0) {
		toastr.options.timeOut = "false";
		toastr.options.closeButton = true;
		toastr['info']('Hi there, this is notification demo with HTML support. So, you can add HTML elements like <a href="#">this link</a>');

		$('.btn-toastr').on('click', function() {
			$context = $(this).data('context');
			$message = $(this).data('message');
			$position = $(this).data('position');

			if($context == '') {
				$context = 'info';
			}

			if($position == '') {
				$positionClass = 'toast-left-top';
			} else {
				$positionClass = 'toast-' + $position;
			}

			toastr.remove();
			toastr[$context]($message, '' , { positionClass: $positionClass });
		});

		$('#toastr-callback1').on('click', function() {
			$message = $(this).data('message');

			toastr.options = {
				"timeOut": "300",
				"onShown": function() { alert('onShown callback'); },
				"onHidden": function() { alert('onHidden callback'); }
			}

			toastr['info']($message);
		});

		$('#toastr-callback2').on('click', function() {
			$message = $(this).data('message');

			toastr.options = {
				"timeOut": "10000",
				"onclick": function() { alert('onclick callback'); },
			}

			toastr['info']($message);

		});

		$('#toastr-callback3').on('click', function() {
			$message = $(this).data('message');

			toastr.options = {
				"timeOut": "10000",
				"closeButton": true,
				"onCloseClick": function() { alert('onCloseClick callback'); }
			}

			toastr['info']($message);
		});
	}
});

// toggle function
$.fn.clickToggle = function( f1, f2 ) {
	return this.each( function() {
		var clicked = false;
		$(this).bind('click', function() {
			if(clicked) {
				clicked = false;
				return f2.apply(this, arguments);
			}

			clicked = true;
			return f1.apply(this, arguments);
		});
	});

}


