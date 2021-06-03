<div class="card">
    <h5 class="text-green-600">Endereço de Entrega</h5>
    <ul class="list-unstyled mb-0">
        <li>
            {{ $customer->name }}
        </li>
        <li>
            {{ $customer_address->address }}, {{ $customer_address->number }}
        </li>
        <li>
            {{ $customer_address->complement }}
        </li>
        <li>
            {{ $customer_address->neighbourhood }}
        </li>
        <li>
            {{ $customer_address->state }} - {{ $customer_address->city }}
        </li>
        <li>
            {{ $customer_address->zipcode }}
        </li>
    </ul>
</div>
