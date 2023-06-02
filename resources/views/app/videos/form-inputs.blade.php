@php $editing = isset($video) @endphp

<div class="row">
    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="title"
            label="Title"
            :value="old('title', ($editing ? $video->title : ''))"
            maxlength="255"
            placeholder="Title"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="attributes"
            label="Attributes"
            :value="old('attributes', ($editing ? $video->attributes : ''))"
            maxlength="255"
            placeholder="Attributes"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="original_language"
            label="Original Language"
            :value="old('original_language', ($editing ? $video->original_language : ''))"
            maxlength="255"
            placeholder="Original Language"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="classification"
            label="Classification"
            :value="old('classification', ($editing ? $video->classification : ''))"
            maxlength="255"
            placeholder="Classification"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.select name="series_id" label="Series">
            @php $selected = old('series_id', ($editing ? $video->series_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Series</option>
            @foreach($allSeries as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>
</div>
