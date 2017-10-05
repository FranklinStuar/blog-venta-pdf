var toast_message=function(type,message){
    $().toastmessage('showToast', {
      text     : "<p class='white-text'>"+message+"<p>",
      stayTime : 7000,
      sticky   : false,
      type     : type
    });
}

$(function(){
	ajax="ajax"
	axios.defaults.headers.common['X-CSRF-TOKEN'] = document.querySelector('#token').getAttribute('content')
	Vue.prototype.$http = axios

	if (($("#category_vue").length > 0)){
		newPost = new Vue({
			el:'#category_vue',
			data:{
				category:"",
				subcategories_list:[],
			},
			methods:{
				select_category(){
					if(this.category!= null && this.category!=""){

						axios.post($("body" ).data( "u")+'/neuro-admin/subcategories/'+this.category)
						.then(response => {
						  this.subcategories_list = response.data
						}, error => {
						  swal(
							'¡Problemas!',
							'Hubo un error a obtener lista de subcategorías, por favor contacte con soporte técnico para corregir el error',
							'error',
						  )
						});
					}
				},
			},
		})
	}
})