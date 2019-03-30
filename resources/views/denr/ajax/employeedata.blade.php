<option value=""> Select All Employee</option>
@foreach($employee as $id => $col)
    <option value="{{ $col['id'] }}" @if(old('employee') == $col['id']) selected @endif >{{ $col['fname'] }} {{ $col['mname'] }} {{ $col['lname'] }}</option>
@endforeach