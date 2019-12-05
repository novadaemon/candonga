<tr>
    <td>
        <input type="hidden" name="products[{{ $product['id'] }}][id]" value="{{ $product['id'] }}">
        <input type="text" class="form-control form-control-sm @if($errors->has('products.'.$product['id'].'.issn')) is-invalid @endif" name="products[{{ $product['id'] }}][issn]" value="{{ $product['issn'] }}">
    </td>
    <td>
        <input type="text" class="form-control form-control-sm @if($errors->has('products.'.$product['id'].'.name')) is-invalid @endif" name="products[{{ $product['id'] }}][name]" value="{{ $product['name'] }}">
    </td>
    <td>
        <select name="products[{{ $product['id'] }}][status]" class="form-control form-control-sm @if($errors->has('products.'.$product['id'].'.status')) is-invalid @endif">
            <option value="new" @if($product['status'] == 'new') selected @endif>new</option>
            <option value="pending" @if($product['status'] == 'pending') selected @endif>pending</option>
            <option value="in review" @if($product['status'] == 'in review') selected @endif>in review</option>
            <option value="approved" @if($product['status'] == 'approved') selected @endif>approved</option>
            <option value="inactive" @if($product['status'] == 'inactive') selected @endif>inactive</option>
            <option value="deleted" @if($product['status'] == 'deleted') selected @endif>deleted</option>
        </select>
    </td>
    <td>
        <input type="text" name="products[{{ $product['id'] }}][created_at]" class="form-control form-control-sm" readonly value="{{ substr($product['created_at'],0,10) }}">
    </td>
    <td style="text-align: right;">
        <a href="" class="btn btn-danger btn-sm btn-product-delete" title="Delete">
            <i class="fa fa-trash"></i>
        </a>
    </td>
</tr>