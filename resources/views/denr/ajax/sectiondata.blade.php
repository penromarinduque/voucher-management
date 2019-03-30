<option value=""> Select All Section</option>
@foreach($section as $id => $col)
    <option value="{{ $col['id'] }}" @if(old('section') == $col['id']) selected @endif >{{ $col['section'] }}</option>
@endforeach