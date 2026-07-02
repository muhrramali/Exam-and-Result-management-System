<div class="form-grid">
    <div class="form-group">
        <label class="label">Exam name</label>
        <input type="text" name="Exam_Name" value="{{ old('Exam_Name', $exam->Exam_Name ?? '') }}" class="input" required>
    </div>
    <div class="form-group">
        <label class="label">Academic year</label>
        <select name="Academic_Year_ID" class="input" required>
            <option value="">Select year</option>
            @foreach ($academicYears as $year)
                <option value="{{ $year->Year_ID }}" @selected(old('Academic_Year_ID', $exam->Academic_Year_ID ?? '') == $year->Year_ID)>
                    {{ $year->Session }}
                </option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label class="label">Start date</label>
        <input type="date" name="Start_Date" value="{{ old('Start_Date', isset($exam) ? $exam->Start_Date?->format('Y-m-d') : '') }}" class="input" required>
    </div>
    <div class="form-group">
        <label class="label">End date</label>
        <input type="date" name="End_Date" value="{{ old('End_Date', isset($exam) ? $exam->End_Date?->format('Y-m-d') : '') }}" class="input" required>
    </div>
</div>
