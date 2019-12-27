<?php
$options = ['all' => 'All', 'academic' => 'Academic', 'semester' => 'Semester', 'course_name' => 'Course Name', 'course_code' => 'Course Code', 'course_group' => 'Course Group', 'course_desc' => 'Course Description', 'author' => 'Author'];
?>

<div class="form">
    <form action="" method="GET">
        <label>Sort by:</label>
        <select name="sort_by" id="sort_by">
            <?php
            foreach ($options as $key => $val) {
                if($key == 'all') continue;

                $selected = (isset($sort_by) and $sort_by == $key) ? 'selected' : '';
                echo "<option value='$key' $selected>$val</option>";
            }
            ?>
        </select>

        <input type="text" name="keyword" id="keyword" placeholder="Enter keyword to search..." size="70%" required value="<?php if (isset($keyword)) echo $keyword ?>">

        <select name="option" id="option">
            <?php
            foreach ($options as $key => $val) {
                $selected = (isset($option) and $option == $key) ? 'selected' : '';
                echo "<option value='$key' $selected>$val</option>";
            }
            ?>
        </select>

        <button type="submit">
            Search
        </button>
    </form>
</div>