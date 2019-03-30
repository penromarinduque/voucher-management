<option value=""> Select All Travel Order</option>
@foreach($order as $id => $col)
    <option value="{{ $col['order_no'] }}" @if(old('order_from') == $col['order_no']) selected @endif >{{ $col['order_no'] }}</option>
@endforeach