ph<?php

use App\Models\Job;

it(' belongs to employer', function () {
//    expect(true)->toBeTrue();
//    Arrange Act Asert

//    Arrange
        $employer = \App\Models\Employer::factory()->create();
        $job = \App\Models\Job::factory()->create([
            'employer_id' => $employer->id,
        ]);

//    Act and Assert
       expect($job->employer->is($employer))->toBeTrue();
});

it('can have tags', function () {
    $job = Job::factory()->create();
    $job->tag('Frontend');
    expect($job->tags)->toHaveCount(1);
});
