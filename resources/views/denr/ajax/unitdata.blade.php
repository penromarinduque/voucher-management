<option value=""> Select All Unit</option>
@foreach($unit as $id => $col)
    <option value="{{ $col['id'] }}" @if(old('unit') == $col['id']) selected @endif >{{ $col['unit'] }}</option>
@endforeach