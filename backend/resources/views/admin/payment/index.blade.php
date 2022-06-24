@php
    $total =  $data['countPayment'];
    $payments = $data['payments'];
@endphp

<x-manage.payment.index guard="admin" :payments="$payments" :total="$total" />
