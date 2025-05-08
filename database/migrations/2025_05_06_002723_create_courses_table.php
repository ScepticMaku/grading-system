<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Course;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('course_description');
            $table->timestamps();
        });

        $courses = [
            ['name' => 'GE3', 'course_description' => 'Reading in Philippine History'],
            ['name' => 'MATH3', 'course_description'=> 'Probability & Statistics'],
            ['name' => 'PGC', 'course_description'=> 'Phil. Governance and Constitution'],
            ['name' => 'REED3', 'course_description'=> 'Sacraments, Church and Christian Morality'],
            ['name' => 'PATHFIT4', 'course_description'=> 'Team Sports/Games'],
            ['name'=> 'PF205', 'course_description'=> 'Object Oriented Programming 2'],
            ['name'=> 'IM207', 'course_description'=> 'Fundamentals of Database System'],
            ['name'=> 'NET208', 'course_description'=> 'Networking'],
            ['name'=> 'IPT209', 'course_description' => 'Integratiive Programming and Technology'],
        ];

        foreach( $courses as $course ) {
            Course::create($course);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
