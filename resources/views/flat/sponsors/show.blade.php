@extends('flat.layout')

@section('title')
    {{ $sponsor->name }}
@endsection

@section('container')
    <div class="container">

        <div class="gap"></div>
        <h1 class="center">{{ $sponsor->name }}</h1>
        {{-- <p class="lead center">Los campos con " * " Son obligatorios.</p> --}}
        <div class="gap"></div>

            <div class="row">
                <div class="col-md-5">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <dl class="dl-horizontal">
                                <dt></dt>
                                <dd><img class="img-fluid max-100-100" src="{{ url('/storage/'.$sponsor->image) }}"  alt="{{ $sponsor->excerpt }}"></dd>
                            </dl>

                            <dl class="dl-horizontal">
                                <dt>Descripción</dt>
                                <dd>{{ $sponsor->excerpt }}</dd>
                            </dl>

                            <dl class="dl-horizontal">
                                <dt>Sitio Web</dt>
                                <dd><a href="http://{{ $sponsor->web }}">{{ $sponsor->web }}</a></dd>
                            </dl>

                            <dl class="dl-horizontal">
                                <dt>Teléfono</dt>
                                <dd>{{ $sponsor->phone }}</dd>
                            </dl>

                            <dl class="dl-horizontal">
                                <dt>Dirección</dt>
                                <dd>{{ $sponsor->address }}</dd>
                            </dl>

                            <dl class="dl-horizontal">
                                <dt>Facebook</dt>
                                <dd>
                                    <a href="https://www.facebook.com/{{ $sponsor->url_facebook }}">
                                            https://www.facebook.com/<u>{{ $sponsor->url_facebook }}</u>
                                    </a>
                                </dd>
                            </dl>

                            <dl class="dl-horizontal">
                                <dt>Instagram</dt>
                                <dd>
                                    <a href="https://www.instagram.com/{{ $sponsor->url_instagram }}">
                                            https://www.instagram.com/<u>{{ $sponsor->url_instagram }}</u>
                                    </a>
                                </dd>
                            </dl>

                            <dl class="dl-horizontal">
                                <dt>Twitter</dt>
                                <dd>
                                    <a href="https://www.twitter.com/{{ $sponsor->url_twitter }}">
                                            https://www.twitter.com/<u>{{ $sponsor->url_twitter }}</u>
                                    </a>
                                </dd>
                            </dl>

                            <dl class="dl-horizontal">
                                <dt>Youtube</dt>
                                <dd>
                                    <a href="https://www.youtube.com/{{ $sponsor->url_youtube }}">
                                            https://www.youtube.com/<u>{{ $sponsor->url_youtube }}</u>
                                    </a>
                                </dd>
                            </dl>
                        </div>
                        <div class="panel-body">
                            <dl class="dl-horizontal">
                                <dt></dt>
                                <dd>
                                    <a href="{{ route('sponsor.edit-user',['sID'=>$sponsor->id]) }}" class="btn btn-primary btn-md">Editar</a>
                                </dd>
                            </dl>
                                
                        </div>
                    </div>
                    

                </div>
                <div class="col-md-7 text-center concept" >
                    <div class="panel panel-primary">
                        <div class="panel-heading"><h3>Historial de pagos</h3></div>
                        <div class="panel-body">
                            @if($sponsor->pays->count() > 0)
                                <div class="table-responsive">
                                    <table class="table table-compact">
                                        <thead>
                                            <tr>
                                                <th>Precio</th>
                                                <th>Disponible</th>
                                                <th>Paga con</th>
                                                <th>Inicio</th>
                                                <th>Finaliza</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($sponsor->pays as $pay)
                                                <tr>
                                                    <td>{{ $pay->price_month }}</td>
                                                    <td>{{ $pay->prints - $pay->print_count }} impresiones</td>
                                                    <td>
                                                        @if($pay->method_payment == 'card')
                                                            Tarjeta
                                                        @elseif($pay->method_payment == 'paypal')
                                                            Paypal
                                                        @endif
                                                    </td>
                                                    <td>{{ $pay->created_at }}</td>
                                                    <td>{{ $pay->finish_date }}</td>
                                                    <td>
                                                        @if(Shinobi::can('sponsor.pay.cancel') && $pay->status == 'active')
                                                            <a href="{{ route('sponsor.cancel-pay',['sID'=>$sponsor->id,'pID'=>$pay->id]) }}" class="btn btn-danger btn-sm">Cancelar</a>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="panel panel-primary">
                        
                        <div class="panel-body">
                            
                            @if(count($sponsor->payActive)>0)
                                Tiene pagos activos, no puede realizar otro pago a menos que cancele los pagos activos
                            @else
                                <h4>No tiene pagos activos</h4>
                                <a href="{{ route('sponsor.list',['sp'=>$sponsor->id]) }}" class="btn btn-info">Realizar pago</a>
                            @endif
                            <br>    
                        </div>
                    </div>
                

                </div>
            </div>

    </div>
@endsection