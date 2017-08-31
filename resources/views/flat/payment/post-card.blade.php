@include('flat.payment.template',[
'url'=>['post.payment-card',$post_slug,'pp'=>$price->id.'.'.str_random(16)],
'price'=>$price->price*100])
