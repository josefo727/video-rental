@php $editing = isset($rentals) @endphp

<div class="row">
    <x-inputs.group class="col-sm-12">
        <x-inputs.select name="user_id" label="User" required>
            @php $selected = old('user_id', ($editing ? $rentals->user_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the User</option>
            @foreach($users as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.select name="video_id" label="Video" required>
            @php $selected = old('video_id', ($editing ? $rentals->video_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Video</option>
            @foreach($videos as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="type"
            label="Type"
            :value="old('type', ($editing ? $rentals->type : ''))"
            maxlength="255"
            placeholder="Type"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.number
            name="total_value"
            label="Total Value"
            :value="old('total_value', ($editing ? $rentals->total_value : ''))"
            max="255"
            step="0.01"
            placeholder="Total Value"
            required
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.number
            name="view_limit"
            label="View Limit"
            :value="old('view_limit', ($editing ? $rentals->view_limit : ''))"
            max="255"
            placeholder="View Limit"
            required
        ></x-inputs.number>
    </x-inputs.group>
</div>
