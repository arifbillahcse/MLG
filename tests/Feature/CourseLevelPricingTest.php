<?php

namespace Tests\Feature;

use App\Models\Course;
use App\Models\CourseLevel;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * The final price is derived, never typed. These tests pin that down, since
 * a wrong number here is a wrong number on an invoice.
 */
class CourseLevelPricingTest extends TestCase
{
    use RefreshDatabase;

    private function course(): Course
    {
        return Course::create(['slug' => 'japanese-test', 'name' => 'Japanese', 'sort' => 1]);
    }

    public function test_final_price_is_regular_minus_discount(): void
    {
        $level = $this->course()->levels()->create([
            'code' => 'N5', 'label' => 'Beginner',
            'fee_before' => 20000, 'discount' => 5000,
        ]);

        $this->assertSame(15000, $level->final_fee);
        $this->assertSame(15000, $level->fresh()->fee_in_class, 'the stored final price must match what is shown');
        $this->assertTrue($level->hasDiscount());
    }

    public function test_editing_the_discount_recalculates_the_final_price(): void
    {
        $level = $this->course()->levels()->create([
            'code' => 'N4', 'label' => 'Elementary',
            'fee_before' => 25000, 'discount' => 5000,
        ]);

        $level->update(['discount' => 2000]);

        $this->assertSame(23000, $level->fresh()->fee_in_class);
    }

    public function test_a_discount_larger_than_the_price_cannot_produce_a_negative_fee(): void
    {
        $level = $this->course()->levels()->create([
            'code' => 'N3', 'label' => 'Intermediate',
            'fee_before' => 10000, 'discount' => 99000,
        ]);

        $this->assertSame(0, $level->fresh()->fee_in_class);
        $this->assertSame(10000, $level->fresh()->discount, 'the discount is clamped to the price');
    }

    public function test_a_negative_discount_is_treated_as_no_discount(): void
    {
        $level = $this->course()->levels()->create([
            'code' => 'N2', 'label' => 'Upper',
            'fee_before' => 12000, 'discount' => -500,
        ]);

        $this->assertSame(0, $level->fresh()->discount);
        $this->assertSame(12000, $level->fresh()->fee_in_class);
        $this->assertFalse($level->fresh()->hasDiscount());
    }

    public function test_no_offer_means_one_price_and_no_strikethrough(): void
    {
        $level = $this->course()->levels()->create([
            'code' => 'TOPIK I', 'label' => 'Beginner',
            'fee_before' => 11000, 'discount' => 0,
        ]);

        $this->assertFalse($level->hasDiscount());
        $this->assertSame(11000, $level->regular_fee);
        $this->assertSame(11000, $level->final_fee);
    }

    public function test_half_months_survive_the_round_trip(): void
    {
        $level = $this->course()->levels()->create([
            'code' => 'N4', 'label' => 'Elementary',
            'months' => 3.5, 'days_per_week' => 4, 'hours_per_day' => 2,
        ]);

        $this->assertSame(3.5, $level->fresh()->months);
        $this->assertSame('3.5', $level->fresh()->months_label);
        $this->assertSame('4 days a week · 2 hours a day', $level->fresh()->schedule_label);
    }

    public function test_course_price_from_follows_the_cheapest_visible_level(): void
    {
        $course = $this->course();

        $course->levels()->create(['code' => 'N5', 'label' => 'A', 'fee_before' => 20000, 'discount' => 5000]);
        $course->levels()->create(['code' => 'N4', 'label' => 'B', 'fee_before' => 25000, 'discount' => 5000]);

        $this->assertSame(15000, $course->fresh()->price_from);

        // Hiding the cheapest level must move the headline, not strand it.
        $course->levels()->where('code', 'N5')->first()->update(['is_active' => false]);

        $this->assertSame(20000, $course->fresh()->price_from);
    }

    public function test_the_course_page_shows_the_discounted_price(): void
    {
        $course = $this->course();
        $course->levels()->create([
            'code' => 'N5', 'label' => 'Beginner',
            'fee_before' => 20000, 'discount' => 5000, 'months' => 3,
            'days_per_week' => 4, 'hours_per_day' => 2,
        ]);

        $response = $this->get(route('courses.show', $course));

        $response->assertOk();
        $response->assertSee('20,000');          // regular, struck through
        $response->assertSee('15,000');          // what they pay
        $response->assertSee('4 days a week');
    }
}
