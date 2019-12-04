<html>
<body style="background-color:#EEE; padding: 30px 0px 30px 0px;">
<div style="width:90%; margin: 20px auto 0px auto; background-color:#FFF; padding: 20px; border-radious: 5px;">
    <p style="text-align: center;">
    <h1 style="text-align: center;">CANDONGA SHOPSTORE</h1>
    </p>
    <div>
        <h4>There are {{ $products->count() }} product(s) pending before {{ $weeks }} week(s)</h4>
        <table width="100%">
            <thead>
            <tr>
                <th>Name</th>
                <th>Issn</th>
                <th>Status</th>
                <th>Created at</th>
            </thead>
            <tbody>
            @foreach($products as $product)
            <tr>
                <td style="text-align: center">{{ $product->name }}</td>
                <td style="text-align: center">{{ $product->issn }}</td>
                <td style="text-align: center">{{ $product->status }}</td>
                <td style="text-align: center">{{ $product->created_at->format('Y-m-d H:i') }}</td>
            </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
</body>
</html>