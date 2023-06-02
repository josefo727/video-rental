@php $editing = isset($series) @endphp

<div class="row">
    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="name"
            label="Name"
            :value="old('name', ($editing ? $series->name : ''))"
            maxlength="255"
            placeholder="Name"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.select name="main_person_id" label="People" required>
            @php $selected = old('main_person_id', ($editing ? $series->main_person_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the People</option>
            @foreach($allPeople as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>
</div>
