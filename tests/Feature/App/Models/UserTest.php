<?php

use App\Models\TeacherAvailability;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

describe('User relationship tests', function () {
    beforeEach(function () {
        $this->teacher      = User::factory(['role' => 'teacher'])->create();
        $this->teacher2     = User::factory(['role' => 'teacher'])->create();
        $this->student      = User::factory(['role' => 'student', 'homeroom' => $this->teacher->id])->create();
        $this->student2     = User::factory(['role' => 'student', 'homeroom' => $this->teacher2->id])->create();
        $this->student3     = User::factory(['role' => 'student', 'homeroom' => $this->teacher->id])->create();
        $this->admin        = User::factory(['role' => 'admin'])->create();
        $this->availability = TeacherAvailability::create([
            'user_id' => $this->teacher->id,
            'M6'      => true,
            'T6'      => true,
            'W6'      => true,
            'R6'      => true,
            'F6'      => true,
        ]);
    });

    test('A student can get their homeroom teacher', function () {
        $homeroomTeacher = $this->student->homeroomTeacher;
        expect($homeroomTeacher)->toBeInstanceOf(User::class)
            ->and($homeroomTeacher->id)->toBe($this->teacher->id);
    });

    test('A teacher can get their homeroom students', function () {
        $students = $this->teacher->homeroomStudents;
        expect($students->pluck('id')->toArray())
            ->toContain($this->student->id)
            ->toContain($this->student3->id);
    });

    test('A teacher can get their availability', function () {
        expect($this->teacher->availability)->toBeInstanceOf(TeacherAvailability::class)
            ->and($this->teacher->availability->M6)->toBeTrue()
            ->and($this->teacher->availability->T7)->toBeFalse();
    });
});
