<?php

class CourseUtil
{
    private string $address;
    private string $currentLine;
    private array $lines = [];

    public function set_file(string $address): void
    {
        $this->address = $address;
    }

    public function load(string $line_number): Grade
    {
        $userData = $this->getLine($line_number)->transform();
        return new Grade(
            (int)trim($userData[0]),
            (int)trim($userData[1]),
            (float)trim($userData[2])
        );
    }

    public function transform(): array
    {
        return explode(' ', $this->currentLine);
    }

    private function getLine($index): static
    {
        $this->currentLine = $this->getLines()[$index];
        return $this;
    }

    private function getLines(): array
    {
        $lines = [];
        if ($file = fopen($this->address, "r")) {
            while (!feof($file)) {
                $line = fgets($file);
                if ($line !== false) {
                    $lines[] = trim($line);
                }
            }
            fclose($file);
        }
        return $lines;
    }

    public function save(Grade $grade): void
    {
        $oldLines = $this->getLines();
        $oldLines[] = "{$grade->getStudentId()} {$grade->getCourseCode()} {$grade->getScore()}";

        $stringFile = '';
        foreach ($oldLines as $oldLine) {
            $stringFile .= $oldLine;
            $stringFile .= "\n";
        }

        file_put_contents($this->address, $stringFile);
    }

    public function calc_course_average($course_code): float
    {
        $lines = $this->getLines();
        $totalScore = 0;
        $count = 0;

        foreach ($lines as $line) {
            list($studentId, $courseCode, $score) = explode(' ', $line);
            if ((int)$courseCode === (int)$course_code) {
                $totalScore += (float)$score;
                $count++;
            }
        }

        return $count > 0 ? $totalScore / $count : 0;
    }

    public function calc_student_average($student_id): float
    {
        $lines = $this->getLines();
        $totalScore = 0;
        $count = 0;

        foreach ($lines as $line) {
            list($studentId, $courseCode, $score) = explode(' ', $line);
            if ((int)$studentId === (int)$student_id) {
                $totalScore += (float)$score;
                $count++;
            }
        }

        return $count > 0 ? $totalScore / $count : 0;
    }

    public function count(): int
    {
        return count($this->getLines());
    }
}

readonly class Grade
{
    public function __construct(
        private int $student_id,
        private int $course_code,
        private float $score
    )
    {
    }

    public function getStudentId(): int
    {
        return $this->student_id;
    }

    public function getScore(): float
    {
        return $this->score;
    }

    public function getCourseCode(): int
    {
        return $this->course_code;
    }
}

// Usage Example:

$util = new CourseUtil();
$util->set_file(__DIR__.'/data.txt');
$grade = new Grade(445612, 1234, 85.5);
$util->save($grade);
echo "Total Records: " . $util->count() . "\n";
echo "Course 1234 Average: " . $util->calc_course_average(1234) . "\n";
echo "Student 445612 Average: " . $util->calc_student_average(445612) . "\n";
