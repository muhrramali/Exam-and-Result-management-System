<div class="form-grid">
    <div>
        <label class="label">Account name</label>
        <input type="text" name="name" value="{{ old('name', $student?->user?->name ?? '') }}" required class="input">
    </div>
    <div>
        <label class="label">Email</label>
        <input type="email" name="email" value="{{ old('email', $student?->user?->email ?? '') }}" required class="input">
    </div>
    <div>
        <label class="label">Password {{ isset($student) ? '(optional)' : '' }}</label>
        <input type="password" name="password" {{ isset($student) ? '' : 'required' }} class="input">
    </div>
    <div>
        <label class="label">Roll no</label>
        <input type="text" name="Roll_No" value="{{ old('Roll_No', $student?->Roll_No ?? '') }}" required class="input">
    </div>
    <div>
        <label class="label">Full name</label>
        <input type="text" name="Full_Name" value="{{ old('Full_Name', $student?->Full_Name ?? '') }}" required class="input">
    </div>
    <div>
        <label class="label">Date of birth</label>
        <input type="date" name="Date_Of_Birth" value="{{ old('Date_Of_Birth', $student?->Date_Of_Birth?->format('Y-m-d') ?? '') }}" class="input">
    </div>
    <div>
        <label class="label">Gender</label>
        <select name="Gender" class="select">
            <option value="">Select</option>
            @foreach (['Male', 'Female', 'Other'] as $g)
                <option value="{{ $g }}" @selected(old('Gender', $student?->Gender ?? '') === $g)>{{ $g }}</option>
            @endforeach
        </select>
    </div>
    <div>
        <label class="label">Contact</label>
        <input type="text" name="Contact" value="{{ old('Contact', $student?->Contact ?? '') }}" class="input">
    </div>
    <div class="md:col-span-2">
        <label class="label">Section</label>
        <select name="Section_ID" class="select">
            <option value="">Unassigned</option>
            @foreach ($sections as $section)
                <option value="{{ $section->Section_ID }}" @selected(old('Section_ID', $student?->Section_ID ?? '') == $section->Section_ID)>
                    {{ $section->schoolClass->Class_Name }} — {{ $section->Section_Name }}
                </option>
            @endforeach
        </select>
    </div>
</div>
