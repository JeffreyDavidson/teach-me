<h3 class="font-size-lg text-dark font-weight-bold mb-6">1. Teacher Info:</h3>
<div class="row">
    <x-input.group class="col-lg-2" label="Title" for="title" :error="$errors->first('title')">
        <x-input.text id="title" placeholder="Enter title" name="title" value="{{ old('title', $teacher->exists ? $teacher->title : null) }}" />
    </x-input.group>

    <x-input.group class="col-lg-4" label="First Name" for="first_name" :error="$errors->first('first_name')">
        <x-input.text id="first_name" placeholder="Enter first name" name="first_name" value="{{ old('first_name', $teacher->exists ? $teacher->first_name : null) }}" />
    </x-input.group>

    <x-input.group class="col-lg-4" label="Last Name" for="last_name" :error="$errors->first('last_name')">
        <x-input.text id="last_name" placeholder="Enter last name" name="last_name" value="{{ old('last_name', $teacher->exists ? $teacher->last_name : null) }}" />
    </x-input.group>

    <x-input.group class="col-lg-2" label="Suffix" for="suffix" :error="$errors->first('suffix')">
        <x-input.text id="suffix" placeholder="Enter suffix" name="suffix" value="{{ old('suffix', $teacher->exists ? $teacher->suffix : null) }}" />
    </x-input.group>
</div>

<div class="row">
    <x-input.group class="col-lg-6" label="Secondary Email Address" for="email" :error="$errors->first('email')" helpText="We will create a new school email for you.">
        <x-input.text id="email" placeholder="Enter email address" name="email" value="{{ old('email', $teacher->exists ? $teacher->email : null) }}" />
    </x-input.group>

    <x-input.group class="col-lg-6" label="Phone Number" for="phone" :error="$errors->first('phone')" helpText="Phone number format: (999) 999-9999">
        <x-input.phone name="phone" value="{{ old('phone', $teacher->exists ? $teacher->formatted_phone : null) }}" />
    </x-input.group>
</div>

<h3 class="font-size-lg text-dark font-weight-bold mb-6">2. Address:</h3>

<x-input.group label="Street" for="street" :error="$errors->first('street')">
    <x-input.text id="street" placeholder="Enter street" name="street" value="{{ old('street', $teacher->exists ? $teacher->street : null) }}" />
</x-input.group>

<div class="row">
    <x-input.group class="col-lg-4" label="City" for="city" :error="$errors->first('city')">
        <x-input.text id="city" placeholder="Enter city" name="city" value="{{ old('city', $teacher->exists ? $teacher->city : null) }}" />
    </x-input.group>

    <x-input.group class="col-lg-4" label="State" for="state" :error="$errors->first('state')">
        <x-input.text id="state" placeholder="Enter state" name="state" value="{{ old('state', $teacher->exists ? $teacher->state : null) }}" />
    </x-input.group>

    <x-input.group class="col-lg-4" label="Zip" for="zip" :error="$errors->first('zip')">
        <x-input.text id="zip" placeholder="Enter zip" name="zip" value="{{ old('zip', $teacher->exists ? $teacher->zip : null) }}" />
    </x-input.group>
</div>
