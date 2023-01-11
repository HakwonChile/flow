# Laravel Flow Chile

Con este paquete podrás conectarte fácilmente a la API de Flow Chile para recibir pagos.

## Installación

Via Composer

``` bash
$ composer require haneul-chile/flow
```

Publicar el archivo de configuración
```
$ php artisan vendor:publish --provider="HaneulChile\Flow\FlowServiceProvider" --force
```

## Uso

Para realizar una llamada GET debes usar el siguiente código.

```
$params = [
    'date' => '2023-01-10'
];

$response = Flow::getFlow('/payment/getPayments', $params);
```

Para realizar una llamada Post (por ejemplo para crear un pago) debes usar el siguiente código

```
$params = [
    'commerceOrder' => 151,
    'subject' => 'test de pago',
    'amount' => '10000',
    'email' => 'a@gmail.com',
    'urlConfirmation' => Flow::getUrlConfirmation(),
    'urlReturn' => Flow::getUrlReturn(),
    'paymentMethod' => '9'
];

$response = Flow::postFlow('/payment/create', $params);

return redirect($response->url . "?token=" . $response->token);
```

En las funciones de retorno donde necesitas usar el token para obtener la info puedes usar este código

```
public function return(Request $request)
{
    $token = $request->token;
    $params = [
        'token' => $token
    ];

    $response = Flow::getFlow('/payment/getStatus', $params);

    if ($response->status == 1) {
        //Acá el cliente volvió a tu sitio web
        return 'back';
    }
    if ($response->status == 2) {
        //Acá el cliente realizo el pago exitosamente
        return 'exito';
    }
    //Acá el pago del cliente fue rechazado
    return 'fracaso';
}
```

La función de confirmación puede tener esta forma

```
public function confirmation(Request $request)
{
    $token = $request->token;
    $params = [
        'token' => $token
    ];

    $response = Flow::getFlow('/payment/getStatus', $params);

    //Acá debes actualizar el pago en tu web como "pagado"
}
```

## Créditos

- Javier Cabrera Villegas

## Licencia

MIT.
