<!DOCTYPE html>
<html>
<head>
	<title>Nuevo Pedido</title>
</head>
<body>
	<p>Se ha realizado un nuevo pedido</p>
	<p>Datos del cliente que realizó el pedido</p>
	<ul>
		<li><strong>Nombre:</strong>{{ $user->name }} </li>
		<li><strong>E-mail:</strong>{{ $user->email }}</li>
		<li><strong>Fecha del Pedido:</strong>{{ $cart->order_date }}</li>
	</ul>
	<hr>
		<p>Detalles del pedido</p>
		<ul>
			@foreach ($cart->details as $detail)
	<li>{{ $detail->product->name}} X {{ $detail->quantity }}
		($ {{ $detail->quantity * $detail->product->price }})
	</li>
			@endforeach
		</ul>
		<p>
			<strong>Importe a pagar</strong>{{ $cart->total }}
		</p>
	<hr>

	<p>
		<a href="{{url('/admin/orders/'.$cart->id)}}">Haz click aquí</a> para ver mas Información
	</p>
</body>
</html>