<?php

use App\Enums\DayType;
use App\Models\Day;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

beforeEach(function () {
    Day::create([
        'date' => '2025-11-17',
        'type' => DayType::HOMEROOM
    ]);
    Day::create([
        'date' => '2025-11-18',
        'type' => DayType::WIN
    ]);
    Day::create([
        'date' => '2025-11-24',
        'type' => DayType::NO_CLASS,
    ]);
});

test('it can return the type for a day', function () {
    $date = '2025-11-17';
    $type = Day::date($date);
    expect($type)->toBe('Homeroom');
    $date = '2025-11-18';
    $type = Day::date($date);
    expect($type)->toBe('WIN');
    $date = '2025-11-24';
    $type = Day::date($date);
    expect($type)->toBe('No Class')
        ->and(Day::count())->toBe(3);
});

it('assigns a default if we attempt to get a day that does not exist', function () {
    $date = '2025-12-13';
    $type = Day::date($date);
    expect($type)->toBe('No Class');
    $date = '2025-12-14';
    $type = Day::date($date);
    expect($type)->toBe('No Class');
    $date = '2025-12-15';
    $type = Day::date($date);
    expect($type)->toBe('Homeroom');
    $date = '2025-12-16';
    $type = Day::date($date);
    expect($type)->toBe('WIN');
    $date = '2025-12-17';
    $type = Day::date($date);
    expect($type)->toBe('WIN');
    $date = '2025-12-18';
    $type = Day::date($date);
    expect($type)->toBe('WIN');
    $date = '2025-12-19';
    $type = Day::date($date);
    expect($type)->toBe('WIN');
    $date = '2025-12-20';
    $type = Day::date($date);
    expect($type)->toBe('No Class')
        ->and(Day::count())->toBe(11);
});

test('setDate function chan change an existing type', function () {
    $date = '2025-11-17';
    $type = Day::date($date);
    expect($type)->toBe('Homeroom');
    Day::setDate($date, 'no_school');
    $type = Day::date($date);
    expect($type)->toBe('No Class');
});
