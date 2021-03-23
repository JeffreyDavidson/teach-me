<h3 class="font-size-lg text-dark font-weight-bold mb-6">1. Student Info:</h3>
<div class="row">
    <x-input.group class="col-lg-2" label="Title" for="title" :error="$errors->first('title')">
        <x-input.text id="title" placeholder="Enter title" name="title" value="{{ old('title', $student->exists ? $student->title : null) }}" />
    </x-input.group>

    <x-input.group class="col-lg-4" label="First Name" for="first_name" :error="$errors->first('first_name')">
        <x-input.text id="first_name" placeholder="Enter first name" name="first_name" value="{{ old('first_name', $student->exists ? $student->first_name : null) }}" />
    </x-input.group>

    <x-input.group class="col-lg-4" label="Last Name" for="last_name" :error="$errors->first('last_name')">
        <x-input.text id="last_name" placeholder="Enter last name" name="last_name" value="{{ old('last_name', $student->exists ? $student->last_name : null) }}" />
    </x-input.group>

    <x-input.group class="col-lg-2" label="Suffix" for="suffix" :error="$errors->first('suffix')">
        <x-input.text id="suffix" placeholder="Enter suffix" name="suffix" value="{{ old('suffix', $student->exists ? $student->suffix : null) }}" />
    </x-input.group>
</div>

<div class="row">
    <x-input.group class="col-lg-6" label="Secondary Email Address" for="email" :error="$errors->first('email')" helpText="We will create a new school email for you.">
        <x-input.text id="email" placeholder="Enter email address" name="email" value="{{ old('email', $student->exists ? $student->email : null) }}" />
    </x-input.group>

    <x-input.group class="col-lg-6" label="Phone Number" for="phone" :error="$errors->first('phone')" helpText="Phone number format: (999) 999-9999">
        <x-input.phone name="phone" value="{{ old('phone', $student->exists ? $student->formatted_phone : null) }}" />
    </x-input.group>
</div>

<h3 class="font-size-lg text-dark font-weight-bold mb-6">2. Address:</h3>

<x-input.group label="Street" for="street" :error="$errors->first('street')">
    <x-input.text id="street" placeholder="Enter street" name="street" value="{{ old('street', $student->exists ? $student->street : null) }}" />
</x-input.group>

<div class="row">
    <x-input.group class="col-lg-4" label="City" for="city" :error="$errors->first('city')">
        <x-input.text id="city" placeholder="Enter city" name="city" value="{{ old('city', $student->exists ? $student->city : null) }}" />
    </x-input.group>

    <x-input.group class="col-lg-4" label="State" for="state" :error="$errors->first('state')">
        <x-input.text id="state" placeholder="Enter state" name="state" value="{{ old('state', $student->exists ? $student->state : null) }}" />
    </x-input.group>

    <x-input.group class="col-lg-4" label="Zip" for="zip" :error="$errors->first('zip')">
        <x-input.text id="zip" placeholder="Enter zip" name="zip" value="{{ old('zip', $student->exists ? $student->zip : null) }}" />
    </x-input.group>
</div>
