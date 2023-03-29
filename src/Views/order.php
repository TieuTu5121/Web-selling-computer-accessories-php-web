<div class="container-fluid pt-5">
        <div class="col">
            <div>
                <table class="table table-hover">
                    <tr>
                        <th>#</th>

                        <th>status</th>
                        <th>total</th>
                        <th>ship</th>
                        <th>customer_name</th>
                        <th>customer_email</th>
                        <th>customer_phone</th>
                        <th>customer_address</th>
                        
                        <th>note</th>
                        <th>payment</th>


                    </tr>

                    @foreach ($orders as $item)
                        <tr>
                            <td>{{ $item->id }}</td>

                            <td>{{ $item->status }}</td>
                            <td>{{ $item->total }}VNĐ</td>

                            <td>{{ $item->ship }}VNĐ</td>
                            <td>{{ $item->customer_name }}</td>
                            <td>{{ $item->customer_email }}</td>
                            <td>{{ $item->customer_email }}</td>
                            <td>{{ $item->customer_address }}</td>
                            <td>{{ $item->note }}</td>
                            <td>{{ $item->payment }}</td>
                            <td>
                                @if ($item->status == 'pending')
                                    <form action="{{ route('client.orders.cancel', $item->id) }}"
                                        id="form-cancel{{ $item->id }}" method="post">

                                        <button class="btn btn-cancel btn-danger" data-id={{ $item->id }}>Cancle
                                            Order</button>
                                    </form>
                                @endif

                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>

    </div>